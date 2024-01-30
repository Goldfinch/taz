<?php

namespace Goldfinch\Taz\Console\Commands;

use SilverStripe\Control\Director;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'display:routes')]
class DisplayRoutesCommand extends GeneratorCommand
{
    protected static $defaultName = 'display:routes';

    protected $description = 'Display current routes';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $routes = Director::config()->get('rules');
        $list = [];

        foreach ($routes as $key => $route) {
            $val = is_array($route) ? $route['Controller'] : $route;
            $list[] = [$key, $val];
        }

        $table = new Table($output);
        $table
            ->setHeaders(['URL', 'Controller'])
            ->setRows($list);
        $table->render();

        return Command::SUCCESS;
    }
}
