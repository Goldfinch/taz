<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:command')]
class CommandMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:command';

    protected $description = 'Create Taz command';

    protected $path = '[psr4]/Commands';

    protected $type = 'command';

    protected $stub = 'command.stub';

    protected $prefix = 'Command';

    protected function execute($input, $output): int
    {
        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $nameInput = $this->getAttrName($input);

        // Create command template (.stub file)
        $command = $this->getApplication()->find('make:command-template');
        $command->run(new ArrayInput(['name' => strtolower($nameInput)]), $output);

        return Command::SUCCESS;
    }
}
