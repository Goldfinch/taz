<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:page-controller')]
class PageControllerMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page-controller';

    protected $description = 'Create page controller';

    protected $path = '[psr4]/Controllers';

    protected $type = 'page-controller';

    protected $stub = 'page-controller.stub';

    protected $suffix = 'Controller';
}
