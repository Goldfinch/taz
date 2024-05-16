<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Goldfinch\Taz\Services\InputOutput;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'generate:password')]
class GeneratePasswordCommand extends GeneratorCommand
{
    protected static $defaultName = 'generate:password';

    protected $description = 'Generate password';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $generator = new ComputerPasswordGenerator();

        $generator
            ->setUppercase()
            ->setLowercase()
            ->setNumbers()
            ->setSymbols(true)
            ->setLength(16);

        $password = $generator->generatePasswords(1);

        $io = new InputOutput($input, $output);
        $io->display($password[0]);

        return Command::SUCCESS;
    }
}
