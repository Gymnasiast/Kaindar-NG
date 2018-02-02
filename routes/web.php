<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Account;
use App\Setting;

Route::get('/', function ()
{
    $accounts = Account::all();
    $defaultYear = Setting::getValueByKey('defaultYear');

    return view('overview', compact('accounts', 'defaultYear'));
});

Route::get('/rekening/{account}', 'AccountController@indexAccount');
Route::get('/rekening/{account}/{year}', 'AccountController@indexAccountYear');

Route::get('/balances', 'BalancesController@index');
Route::get('/balances/{account}', 'BalancesController@indexAccount');


Route::get('/instellingen', 'SettingsController@index');

Route::post('/mutations', 'MutationController@store');