<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:model')]
class ModelMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:model';

    protected $description = 'Create model [DataObject]';

    protected $path = '[psr4]/Models';

    protected $type = 'model';

    protected $stub = 'model.stub';
}
