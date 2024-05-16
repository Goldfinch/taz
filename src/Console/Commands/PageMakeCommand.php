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

    protected $stubTemplates = [
        'page.stub' => 'full',
        'page-plain.stub' => 'plain',
        'page-fielder.stub' => ['full-fielder', 'full (fielder)', 'goldfinch/fielder'],
        'page-plain-fielder.stub' => ['plain-fielder', 'plain (fielder)', 'goldfinch/fielder'],
    ];

    protected function configure(): void
    {
        parent::configure();

        $this->addOption('template', null, InputOption::VALUE_REQUIRED, 'Specify template');
    }

    protected function execute($input, $output): int
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion('Which class to inherit?', ['Page', 'SiteTree'], 0);
        $this->questions['parentPageType'] = $helper->ask($input, $output, $question);

        $this->chooseStubTemplate($input, $output);

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

        if ($questions && is_array($questions) && ! empty($questions)) {
            $class = $questions['parentPageType'] ?? 'Page';

            if ($class == 'Page') {
                $useClass = 'Page';
            } elseif ($class == 'SiteTree') {
                $useClass = 'SilverStripe\CMS\Model\SiteTree';
            }

            return [[true, '{{ __use_pagetype }}', $useClass], [true, '{{ __pagetype }}', $class]];
        }
    }
}
