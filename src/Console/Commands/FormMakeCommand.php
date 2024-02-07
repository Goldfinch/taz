<?php

namespace Goldfinch\Taz\Console\Commands;

use Goldfinch\Taz\Console\GeneratorCommand;

#[AsCommand(name: 'make:form')]
class FormMakeCommand extends GeneratorCommand
{
    protected static $defaultName = 'make:form';

    protected $description = 'Create form';

    protected $path = '[psr4]/Forms';

    protected $type = 'form';

    protected $stub = 'form.stub';
}
