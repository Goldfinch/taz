<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:command')]
class CommandMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:command';

    protected $description = 'Create Taz command';

    protected $path = '[psr4]/Commands';

    protected $type = 'command';

    protected $stub = 'command.stub';

    protected $suffix = 'Command';

    protected function execute($input, $output): int
    {
        $this->questions['clicommand'] = $this->askStringQuestion('Command name for Taz [php taz ...]:', $input, $output, 'make:my_custom_command');
        $this->questions['path'] = $this->askStringQuestion('Where should the output files/classes of this command be stored?:', $input, $output, 'app/src/MyCommands');
        $this->questions['suffix'] = $this->askStringQuestion('Does the output files/classes need to have suffix?:', $input, $output, '');
        $this->questions['description'] = $this->askStringQuestion('Command description:', $input, $output, 'My command description');

        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $nameInput = $this->getAttrName($input);

        // Create command template (.stub file)
        $command = $this->getApplication()->find('make:command-template');
        $command->run(new ArrayInput(['name' => strtolower($nameInput)]), $output);

        return Command::SUCCESS;
    }

    protected function replacer()
    {
        $questions = $this->questions;

        if ($questions && is_array($questions) && !empty($questions)) {

            $clicommand = $questions['clicommand'];
            $path = $questions['path'];
            $suffix = $questions['suffix'];
            $description = $questions['description'];

            return [
                [$clicommand, '{{ __clicommand }}', $clicommand],
                [$path, '{{ __path }}', $path],
                [$suffix, '{{ __suffix }}', $suffix],
                [$description, '{{ __description }}', $description],
            ];
        }
    }
}
