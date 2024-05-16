<?php

namespace Goldfinch\Taz\Console\Suppliers;

use Goldfinch\CLISupplier\CLISupplier;
use SilverStripe\Admin\CMSMenu;

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
