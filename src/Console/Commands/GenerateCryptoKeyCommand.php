<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'generate:crypto-key')]
class GenerateCryptoKeyCommand extends GeneratorCommand
{
    protected static $defaultName = 'generate:crypto-key';

    protected $description = 'Generate bin2hex key';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $io = new InputOutput($input, $output);
        $io->display($this->generateKey());

        return Command::SUCCESS;
    }

    public function generateKey()
    {
        return bin2hex(random_bytes(16));
    }
}
