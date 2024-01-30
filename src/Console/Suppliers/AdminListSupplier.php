<?php

namespace Goldfinch\Taz\Console\Suppliers;

use SilverStripe\Admin\CMSMenu;
use Goldfinch\CLISupplier\CLISupplier;

class AdminListSupplier implements CLISupplier
{
    public static function run(...$args)
    {
        $list = [];

        foreach (CMSMenu::get_menu_items() as $admin) {
                $list[] = [$admin->title, $admin->priority, $admin->url, $admin->controller];
        }

        return $list;
    }
}
