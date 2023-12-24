<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Goldfinch\Taz\Services\InputOutput;
use Symfony\Component\Console\Command\Command;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

#[AsCommand(name: 'generate:password')]
class GeneratePasswordCommand extends GeneratorCommand
{
    protected static $defaultName = 'generate:password';

    protected $description = 'Generate password';

    protected function execute($input, $output): int
    {
        // parent::execute($input, $output);

        $generator = new ComputerPasswordGenerator();

        $generator
            ->setUppercase()
            ->setLowercase()
            ->setNumbers()
            ->setSymbols(true)
            ->setLength(16);

        $password = $generator->generatePasswords(1);

        $io = new InputOutput($input, $output);
        $io->text($password);

        return Command::SUCCESS;
    }
}
