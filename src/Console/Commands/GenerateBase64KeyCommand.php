<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'generate:base64-key')]
class GenerateBase64KeyCommand extends GeneratorCommand
{
    protected static $defaultName = 'generate:base64-key';

    protected $description = 'Generate base64 key';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $key = substr(base64_encode(random_bytes(32)), 0, 32) . "\n";

        $io = new InputOutput($input, $output);
        $io->display($key);

        return Command::SUCCESS;
    }
}
