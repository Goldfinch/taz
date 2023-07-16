<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:controller')]
class ControllerMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:controller';

    protected $description = 'Create a new controller class';

    protected $path = 'app/src/Controllers';

    protected $type = 'controller';

    protected $stub = 'controller.stub';

    protected $prefix = 'Controller';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
