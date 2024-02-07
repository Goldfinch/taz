<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:view')]
class ViewMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:view';

    protected $description = 'Create view [ViewableData]';

    protected $path = '[psr4]/Views';

    protected $type = 'view';

    protected $stub = 'viewabledata.stub';

    protected $prefix = '';
}
