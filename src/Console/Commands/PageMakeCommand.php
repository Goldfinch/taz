<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;

#[AsCommand(name: 'make:page')]
class PageMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page';

    protected $description = 'Create page';

    protected $path = '[psr4]/Pages';

    protected $type = 'page';

    protected $stub = 'page.stub';

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'plain',
            null,
            InputOption::VALUE_NONE,
            'Plane model template'
        );

        $this->addOption(
            'fielder',
            null,
            InputOption::VALUE_NONE,
            'Fielder model template'
        );
    }

    protected function execute($input, $output): int
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Which class to inherit?',
            ['Page', 'SiteTree'],
            0,
        );
        $question->setErrorMessage('Page type %s is invalid.');
        $this->questions['parentPageType'] = $helper->ask($input, $output, $question);

        if ($input->getOption('fielder') !== false) {
            $this->stub = 'page-fielder.stub';
        } else if ($input->getOption('plain') !== false) {
            $this->stub = 'page-plain.stub';
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $nameInput = $this->getAttrName($input);

        // Create page controller
        $command = $this->getApplication()->find('make:page-controller');
        $command->run(new ArrayInput(['name' => $nameInput]), $output);

        // Create page template
        $command = $this->getApplication()->find('make:page-template');
        $command->run(new ArrayInput(['name' => $nameInput]), $output);

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        $questions = $this->questions;

        if ($questions && is_array($questions) && !empty($questions)) {

            $class = $questions['parentPageType'] ?? 'Page';

            if ($class == 'Page') {
                $useClass = 'Page';
            } else if ($class == 'SiteTree') {
                $useClass = 'SilverStripe\CMS\Model\SiteTree';
            }

            return [
                [true, '{{ __use_pagetype }}', $useClass],
                [true, '{{ __pagetype }}', $class],
            ];
        }
    }
}
