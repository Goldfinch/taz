<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:dataextension')]
class DataExtensionMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:dataextension';

    protected $description = 'Create extension [DataExtension]';

    protected $path = '[psr4]/Extensions';

    protected $type = 'data extension';

    protected $stub = 'dataextension.stub';

    protected $prefix = 'Extension';
}
