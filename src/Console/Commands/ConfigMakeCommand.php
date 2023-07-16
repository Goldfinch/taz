<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:config')]
class ConfigMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:config';

    protected $description = 'Create config';

    protected $path = 'app/_config';

    protected $type = 'config';

    protected $stub = 'config.stub';

    protected $extension = '.yml';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
