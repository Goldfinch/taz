<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Goldfinch\Taz\Services\InputOutput;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'generate:base64-key')]
class GenerateBase64KeyCommand extends GeneratorCommand
{
    protected static $defaultName = 'generate:base64-key';

    protected $description = 'Generate base64 key';

    protected function execute($input, $output): int
    {
        // parent::execute($input, $output);

        $key = substr(base64_encode(random_bytes(32)), 0, 32) . "\n";

        $io = new InputOutput($input, $output);
        $io->text($key);

        return Command::SUCCESS;
    }
}
