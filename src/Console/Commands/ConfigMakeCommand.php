<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:config')]
class ConfigMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:config';

    protected $description = 'Create YML config';

    protected $path = 'app/_config';

    protected $type = 'config';

    protected $stub = 'config.stub';

    protected $extension = '.yml';
}
