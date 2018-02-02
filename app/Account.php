<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Account
 * @package App
 *
 * @property int $id
 * @property int $title
 */
class Account extends Model
{
    public function getActiveYears(string $sort = 'ASC')
    {
        $return = [];
        $records = DB::table('mutations')
            ->select(DB::raw('DISTINCT DATE_FORMAT(date, \'%Y\') as year'))
            ->where('account_id', $this->id)
            ->orderBy('year', $sort)
            ->get();

        foreach ($records as $record)
        {
            $return[] = $record->year;
        }

        return $return;
    }

    public function getCurrentBalance()
    {
        $currentBalanceRaw = DB::table('mutations')->select(DB::raw('SUM(amount) AS balance'))->where('account_id', $this->id)->get();
        return $currentBalanceRaw->first()->balance;
    }
}
