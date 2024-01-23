<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Services\InputOutput;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:generate-app-key')]
class EnvGenerateAppKeyCommand extends GeneratorCommand
{
    protected static $defaultName = 'app:generate-app-key';

    protected $description = 'Generate APP_KEY in .env';

    protected function execute($input, $output): int
    {
        $io = new InputOutput($input, $output);

        $envPath = BASE_PATH . '/.env';

        $file = file_get_contents($envPath);

        if ($file !== false) {

            if (strpos($file, PHP_EOL . 'APP_KEY=') === false && strpos($file, 'APP_KEY=') !== 0) {

                $command = $this->getApplication()->find('generate:crypto-key');

                $key = $command->generateKey();

                file_put_contents($envPath, 'APP_KEY="' . $key . '"'  . PHP_EOL . PHP_EOL . $file);
            } else {
                $io->wrong('APP_KEY already exists in .env');
                return Command::FAILURE;
            }
        } else {
            $io->wrong('.env file is not found in the root');
            return Command::FAILURE;
        }

        $io->right('APP_KEY has been generated and added to your .env');

        return Command::SUCCESS;
    }
}
