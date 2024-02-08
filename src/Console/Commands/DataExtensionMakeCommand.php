<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

#[AsCommand(name: 'make:dataextension')]
class DataExtensionMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:dataextension';

    protected $description = 'Create extension [DataExtension]';

    protected $path = '[psr4]/Extensions';

    protected $type = 'data extension';

    protected $stub = 'dataextension.stub';

    protected $suffix = 'Extension';

    protected function execute($input, $output): int
    {
        if (parent::execute($input, $output) === false) {
            return Command::FAILURE;
        }

        $registerExtension = $this->askStringQuestion('Do you want to register this extension in Yaml config? [y/n]', $input, $output, 'y');

        if ($registerExtension == 'y' || $registerExtension == 'Y') {

            $className = $this->askClassNameQuestion('What class are we extending? (eg: Page, App\Models\Member)', $input, $output);

            // find config
            $config = $this->findYamlConfigFileByName('app-extensions');

            // create new config if not exists
            if (!$config) {

                $command = $this->getApplication()->find('make:config');
                $command->run(new ArrayInput([
                    'name' => 'extensions',
                    '--plain' => true,
                    '--nameprefix' => 'app-',
                ]), $output);

                $config = $this->findYamlConfigFileByName('app-extensions');
            }

            // update config
            $this->updateYamlConfig(
                $config,
                $className . '.extensions',
                [$this->getNamespaceClass($input)],
            );
        }

        return Command::SUCCESS;
    }
}
