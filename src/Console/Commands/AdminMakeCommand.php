<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:admin')]
class AdminMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:admin';

    protected $description = 'Create admin model [ModelAdmin]';

    protected $path = '[psr4]/Admin';

    protected $type = 'admin';

    protected $stub = 'admin.stub';

    protected $prefix = 'Admin';
}
