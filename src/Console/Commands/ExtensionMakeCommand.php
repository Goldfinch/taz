<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:extension')]
class ExtensionMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:extension';

    protected $description = 'Create extensions [Extensions]';

    protected $path = '[psr4]/Extensions';

    protected $type = 'extension';

    protected $stub = 'extension.stub';

    protected $prefix = 'Extension';
}
