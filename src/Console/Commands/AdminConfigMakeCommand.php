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

    protected $stubTemplates = [
        'adminconfig.stub' => 'full',
        'adminconfig-fielder.stub' => ['full-fielder', 'full (fielder)', 'goldfinch/fielder'],
    ];

    protected $suffix = 'Config';

    protected function configure(): void
    {
        parent::configure();

        $this->addOption(
            'template',
            null,
            InputOption::VALUE_REQUIRED,
            'Specify template'
        );
    }

    protected function execute($input, $output): int
    {
        $this->chooseStubTemplate($input, $output);

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
