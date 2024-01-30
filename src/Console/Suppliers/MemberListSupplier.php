<?php

namespace Goldfinch\Taz\Console\Suppliers;

use SilverStripe\Security\Member;
use Goldfinch\CLISupplier\CLISupplier;

class MemberListSupplier implements CLISupplier
{
    public static function run(...$args)
    {
        $list = [];

        foreach (Member::get() as $member) {
            $list[] = [$member->FirstName, $member->Surname, $member->Email];
        }

        return $list;
    }
}
