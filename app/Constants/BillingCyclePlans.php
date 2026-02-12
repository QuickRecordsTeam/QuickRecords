<?php

namespace App\Constants;

class BillingCyclePlans
{
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';

    public static function getBillingCycles()
    {
        return [
            self::MONTHLY,
            self::YEARLY
        ];
    }
}
