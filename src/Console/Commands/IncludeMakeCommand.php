<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:include')]
class IncludeMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:include';

    protected $description = 'Create include template';

    protected $path = 'themes/[theme]/templates/Includes';

    protected $type = 'include';

    protected $stub = 'include.stub';

    protected $extension = '.ss';
}
