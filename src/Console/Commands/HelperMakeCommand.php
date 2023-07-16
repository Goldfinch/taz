<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:helper')]
class HelperMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:helper';

    protected $description = 'Create service';

    protected $path = 'app/src/Helpers';

    protected $type = 'helper';

    protected $stub = 'helper.stub';

    protected $prefix = '';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
