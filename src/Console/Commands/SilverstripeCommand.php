<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:dev-build')]
class SilverstripeCommand extends GeneratorCommand
{
    protected static $defaultName = 'app:dev-build';

    protected $description = 'Silverstripe commands';

    protected function execute($input, $output): int
    {
        parent::execute($input, $output);

        echo shell_exec(
            'php vendor/silverstripe/framework/cli-script.php dev/build "flush=1"',
        );

        return Command::SUCCESS;
    }
}
