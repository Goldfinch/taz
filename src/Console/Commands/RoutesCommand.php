<?php

namespace Goldfinch\Taz\Console\Commands;

use SilverStripe\Control\Director;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'app:routes')]
class RoutesCommand extends GeneratorCommand
{
    protected static $defaultName = 'app:routes';

    protected $description = 'Display current routes';

    protected function execute($input, $output): int
    {
        $routes = Director::config()->get('rules');
        $list = [];

        foreach ($routes as $key => $route) {
            $val = is_array($route) ? $route['Controller'] : $route;
            $list[] = [$key, $val];
        }

        $table = new Table($output);
        $table->setRows($list);
        $table->render();

        return Command::SUCCESS;
    }
}
