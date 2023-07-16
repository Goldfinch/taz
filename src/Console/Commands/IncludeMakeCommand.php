<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:include')]
class IncludeMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:include';

    protected $description = 'Create include template file';

    protected $path = 'themes/main/templates/Includes';

    protected $type = 'include';

    protected $stub = 'include.stub';

    protected $prefix = '';

    protected $extension = '.ss';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
