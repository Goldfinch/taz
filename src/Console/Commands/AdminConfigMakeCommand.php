<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:adminconfig')]
class AdminConfigMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:adminconfig';

    protected $description = 'Create admin config [SomeConfig]';

    protected $path = '[psr4]/Configs';

    protected $type = 'admin config';

    protected $stub = 'adminconfig.stub';

    protected $suffix = 'Config';
}
