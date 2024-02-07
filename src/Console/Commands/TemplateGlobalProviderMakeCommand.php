<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:provider')]
class TemplateGlobalProviderMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:provider';

    protected $description = 'Create provider [TemplateGlobalProvider]';

    protected $path = '[psr4]/Providers';

    protected $type = 'provider';

    protected $stub = 'template-global-provider.stub';

    protected $prefix = 'TemplateProvider';
}
