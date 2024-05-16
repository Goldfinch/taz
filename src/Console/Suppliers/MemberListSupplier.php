<?php

namespace Goldfinch\Taz\Console\Suppliers;

use Goldfinch\CLISupplier\CLISupplier;
use SilverStripe\Security\Member;

class MemberListSupplier implements CLISupplier
{
    public static function run(...$args)
    {
        $list = [];

        foreach (Member::get() as $member) {
            $groups = $member->Groups();

            if ($groups->Count()) {
                $groups = implode(', ', $groups->column('Title'));
            } else {
                $groups = '';
            }

            $list[] = [$member->FirstName, $member->Surname, $member->Email, $groups];
        }

        return $list;
    }
}
