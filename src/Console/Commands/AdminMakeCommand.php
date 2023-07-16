<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:admin')]
class AdminMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:admin';

    protected $description = 'Create a new admin model class';

    protected $path = 'app/src/Admin';

    protected $type = 'admin';

    protected $stub = 'admin.stub';

    protected $prefix = '';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
