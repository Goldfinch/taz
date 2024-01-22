<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:routes')]
class RoutesCommand extends GeneratorCommand
{
    protected static $defaultName = 'app:routes';

    protected $description = 'Display current routes';

    protected function execute($input, $output): int
    {
        // $routes = Director::config()->get('rules');

        $io = new InputOutput($input, $output);
        $io->text('-');

        return Command::SUCCESS;
    }
}
