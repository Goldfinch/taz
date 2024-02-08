<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:service')]
class ServiceMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:service';

    protected $description = 'Create service';

    protected $path = '[psr4]/Services';

    protected $type = 'service';

    protected $stub = 'service.stub';

    protected $suffix = 'Service';
}
