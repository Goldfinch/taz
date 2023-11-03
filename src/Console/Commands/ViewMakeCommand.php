<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:view')]
class ViewMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:view';

    protected $description = 'Create a viewable data class';

    protected $path = '[psr4]/Views';

    protected $type = 'view';

    protected $stub = 'viewabledata.stub';

    protected $prefix = '';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
