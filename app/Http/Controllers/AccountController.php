<?php

namespace App\Http\Controllers;

use App\Account;
use App\Mutation;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        return view ('overview', $accounts);
    }

    public function indexAccount(Account $account)
    {
        $years = $account->getActiveYears();
        $currentBalance = $account->getCurrentBalance();
        $mutations = Mutation::where('account_id', $account->id)->orderBy('date', 'desc')->orderBy('created_at', 'desc')->get();

        return view('accounts.show', compact('account', 'mutations', 'years', 'currentBalance'));
    }

    public function indexAccountYear(Account $account, $year)
    {
        $years = $account->getActiveYears();
        $currentBalance = $account->getCurrentBalance();
        $mutations = Mutation::where('account_id', $account->id)->whereYear('date', '=', $year)->orderBy('date', 'desc')->orderBy('created_at', 'desc')->get();

        return view('accounts.show', compact('account', 'mutations', 'years', 'currentBalance'));
    }
}
