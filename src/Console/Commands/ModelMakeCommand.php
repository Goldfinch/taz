<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:model')]
class ModelMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:model';

    protected $description = 'Create model [DataObject]';

    protected $path = '[psr4]/Models';

    protected $type = 'model';

    protected $stub = 'model.stub';

    protected $prefix = '';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
