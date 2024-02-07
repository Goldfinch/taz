<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:helper')]
class HelperMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:helper';

    protected $description = 'Create helper';

    protected $path = '[psr4]/Helpers';

    protected $type = 'helper';

    protected $stub = 'helper.stub';
}
