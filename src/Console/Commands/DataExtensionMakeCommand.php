<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:dataextension')]
class DataExtensionMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:dataextension';

    protected $description = 'Create a data extension class';

    protected $path = 'app/src/Extensions';

    protected $type = 'data extension';

    protected $stub = 'dataextension.stub';

    protected $prefix = 'Extension';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
