<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:adminconfig')]
class AdminConfigMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:adminconfig';

    protected $description = 'Create a new admin config';

    protected $path = 'app/src/Configs';

    protected $type = 'admin config';

    protected $stub = 'adminconfig.stub';

    protected $prefix = 'Config';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
