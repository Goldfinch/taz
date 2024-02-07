<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'dev/build')]
class SilverstripeCommand extends GeneratorCommand
{
    protected static $defaultName = 'dev/build';

    protected $description = 'Run dev/build';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        echo shell_exec(
            'php vendor/silverstripe/framework/cli-script.php dev/build "flush=1"',
        );

        return Command::SUCCESS;
    }
}
