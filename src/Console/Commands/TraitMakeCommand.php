<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:trait')]
class TraitMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:trait';

    protected $description = 'Create trait';

    protected $path = '[psr4]/Traits';

    protected $type = 'trait';

    protected $stub = 'trait.stub';

    protected $suffix = 'Trait';
}
