<?php

namespace App;

use NumberFormatter;

class Helper
{

    /**
     * @param int|float $money Money to format
     */
    public static function GTMoney($money)
    {
        return NumberFormatter::create('es_GT', NumberFormatter::CURRENCY)
            ->format($money);
    }
}
