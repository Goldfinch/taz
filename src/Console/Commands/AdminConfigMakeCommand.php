<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

#[AsCommand(name: 'make:adminconfig')]
class AdminConfigMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:adminconfig';

    protected $description = 'Create admin config [SomeConfig]';

    protected $path = '[psr4]/Configs';

    protected $type = 'admin config';

    protected $stub = 'adminconfig.stub';

    protected $suffix = 'Config';

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
        if ($input->getOption('fielder') !== false) {
            $this->stub = 'adminconfig-fielder.stub';
        }

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
