<?php

namespace Goldfinch\Taz\Console\Commands;

use SilverStripe\Admin\CMSMenu;
use Goldfinch\CLISupplier\SupplyHelper;
use Goldfinch\Taz\Console\GeneratorCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;

#[AsCommand(name: 'display:admins')]
class DisplayModelAdminsCommand extends GeneratorCommand
{
    protected static $defaultName = 'display:admins';

    protected $description = 'Display registered ModelAdmin controllers';

    protected $no_arguments = true;

    protected function execute($input, $output): int
    {
        $response = SupplyHelper::supply('adminlist');

        if ($response) {

            $table = new Table($output);
            $table
                ->setHeaders(['Title', 'Priority', 'URL', 'Controller'])
                ->setRows($response)
            ;
            $table->render();
        }

        return Command::SUCCESS;
    }

    // protected function promptForMissingArgumentsUsing()
    // {
    //     return [];
    // }

    // protected function validationForMissingArgumentsUsing()
    // {
    //     return [];
    // }
}
