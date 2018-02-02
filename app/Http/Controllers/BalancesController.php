<?php

namespace App\Http\Controllers;

use App\Account;
use App\Mutation;
use Illuminate\Support\Facades\DB;

class BalancesController extends Controller
{
    public function index()
    {
        $title = 'Maandsaldi (alle rekeningen)';

        $currentBalanceRaw = DB::table('mutations')->select(DB::raw('SUM(amount) AS balance'))->get();
        $currentBalance = $currentBalanceRaw->first()->balance;

        $balances = DB::table('mutations')
            ->select(DB::raw('SUM(amount) AS cashflow, DATE_FORMAT(date,\'%Y\') AS year, DATE_FORMAT(date,\'%m\') AS month'))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view ('accounts.balances', compact('balances', 'currentBalance', 'title'));
    }

    public function indexAccount(Account $account)
    {
        $title = sprintf('Maandsaldi (%s)', $account->title);

        $currentBalance = $account->getCurrentBalance();

        $balances = DB::table('mutations')
            ->select(DB::raw('SUM(amount) AS cashflow, DATE_FORMAT(date,\'%Y\') AS year, DATE_FORMAT(date,\'%m\') AS month'))
            ->where('account_id', $account->id)
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view ('accounts.balances', compact('balances', 'currentBalance', 'title'));
    }
}
