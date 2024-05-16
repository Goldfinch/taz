<?php

namespace Goldfinch\Taz\Console\Commands;

use Composer\InstalledVersions;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Question\ChoiceQuestion;

#[AsCommand(name: 'make:extension')]
class ExtensionMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:extension';

    protected $description = 'Create extensions [Extensions]';

    protected $path = '[psr4]/Extensions';

    protected $type = 'extension';

    protected $stub = 'extension.stub';

    protected $suffix = 'Extension';

    protected function configure(): void
    {
        parent::configure();

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
            'Which type?',
            ['Extension', 'DataExtension'],
            0,
        );
        $this->questions['extensionType'] = $helper->ask($input, $output, $question);

        if (InstalledVersions::isInstalled('goldfinch/fielder') || $input->getOption('fielder') !== false) {
            $this->stub = 'extension-fielder.stub';
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $nameInput = $this->getAttrName($input);

        $registerExtension = $this->askStringQuestion('Do you want to register this extension in Yaml config? [y/n]', $input, $output, 'y');

        if ($registerExtension == 'y' || $registerExtension == 'Y') {

            $recognizedClasses = [
                'SilverStripe\SiteConfig\SiteConfig' => 'siteconfig',
            ];

            $suggestClasses = array_filter($recognizedClasses, function ($i) use ($nameInput) {
                if (strpos($i, strtolower($nameInput)) === false) {
                    return;
                }

                return $i;
            });

            if (! empty($suggestClasses)) {
                $suggestClasses = ['no (skip)' => 'no'] + $suggestClasses;
                $helper = $this->getHelper('question');
                $question = new ChoiceQuestion(
                    'Any of these?',
                    array_keys($suggestClasses),
                    0,
                );
                $className = $helper->ask($input, $output, $question);
            }

            if (! isset($className)) {

                $className = $this->askClassNameQuestion('What class are we extending? (eg: Page, App\Models\Member)', $input, $output);
            }

            // find config
            $config = $this->findYamlConfigFileByName('app-extensions');

            // create new config if not exists
            if (! $config) {

                $command = $this->getApplication()->find('make:config');
                $command->run(new ArrayInput([
                    'name' => 'extensions',
                    '--plain' => true,
                    '--nameprefix' => 'app-',
                ]), $output);

                $config = $this->findYamlConfigFileByName('app-extensions');
            }

            // update config
            $this->updateYamlConfig(
                $config,
                $className.'.extensions',
                [$this->getNamespaceClass($input)],
            );
        }

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        $questions = $this->questions;

        if ($questions && is_array($questions) && ! empty($questions)) {

            $class = $questions['extensionType'] ?? 'Extension';

            if ($class == 'Extension') {
                $useClass = 'SilverStripe\Core\Extension';
            } elseif ($class == 'DataExtension') {
                $useClass = 'SilverStripe\ORM\DataExtension';
            }

            return [
                [true, '{{ __use_pagetype }}', $useClass],
                [true, '{{ __pagetype }}', $class],
            ];
        }
    }
}
