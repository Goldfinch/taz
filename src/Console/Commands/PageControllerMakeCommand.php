<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'make:page-controller')]
class PageControllerMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:page-controller';

    protected $description = 'Create a new page controller class';

    protected $path = '[psr4]/Controllers';

    protected $type = 'page-controller';

    protected $stub = 'page-controller.stub';

    protected $prefix = 'Controller';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        return Command::SUCCESS;
    }
}
