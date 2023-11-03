<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:extension')]
class ExtensionMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:extension';

    protected $description = 'Create an extension class';

    protected $path = '[psr4]/Extensions';

    protected $type = 'extension';

    protected $stub = 'extension.stub';

    protected $prefix = 'Extension';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
