<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:trait')]
class TraitMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:trait';

    protected $description = 'Create trait';

    protected $path = '[psr4]/Traits';

    protected $type = 'trait';

    protected $stub = 'trait.stub';

    protected $prefix = 'Trait';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
