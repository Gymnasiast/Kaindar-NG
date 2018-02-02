<?php
namespace App;

class Util
{
    private static $months = ["", "januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december"];


    public static function monthNumberToFriendly(int $monthNumber)
    {
        return (static::$months[$monthNumber]);
    }

    public static function amountToEuro(float $amount)
    {
        return '&euro;&nbsp;' . number_format($amount, 2, ',', '.');
    }
}