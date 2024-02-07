<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:controller')]
class ControllerMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:controller';

    protected $description = 'Create controller';

    protected $path = '[psr4]/Controllers';

    protected $type = 'controller';

    protected $stub = 'controller.stub';

    protected $suffix = 'Controller';
}
