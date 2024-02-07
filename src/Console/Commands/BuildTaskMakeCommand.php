<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:task')]
class BuildTaskMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:task';

    protected $description = 'Create build task [BuildTask]';

    protected $path = '[psr4]/Tasks';

    protected $type = 'build task';

    protected $stub = 'buildtask.stub';

    protected $prefix = 'BuildTask';
}
