<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:command-template')]
class CommandTemplateMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:command-template';

    protected $description = 'Create Taz command template';

    protected $path = '[psr4]/Commands/stubs';

    protected $type = 'command template';

    protected $stub = 'command-template.stub';

    protected $prefix = '';

    protected $extension = '.stub';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
