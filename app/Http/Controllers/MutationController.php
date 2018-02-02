<?php

namespace App\Http\Controllers;

use App\Code;
use App\Mutation;

class MutationController extends Controller
{
    public function edit()
    {
        $codes = Code::where('abbreviation', request('code'))->get();
        /** @var Code $code */
        $code = $codes->first();

        $amount = floatval(str_replace(',', '.', request('amount')));

        if (empty(request('year')))
        {
            $year = date('Y');
        }
        else
        {
            $year = request('year');
        }
        $date = sprintf('%s-%s-%s', $year, request('month'), request('day'));

        if (empty(request('vat')))
        {
            $vat = 0.00;
        }
        else
        {
            $vat = floatval(str_replace(',', '.', request('vat')));
        }

        $description = request('description') ?: '';

        /** @var Mutation $mutation */
        $mutation = Mutation::find(request('id'));

        $mutation->account_id = request('account_id');
        $mutation->code_id = $code->id;
        $mutation->description = $description;
        $mutation->date = $date;
        $mutation->amount = $amount;
        $mutation->vat = $vat;
        $mutation->save();


        return redirect('/rekening/' . request('account_id'));
    }

    public function store()
    {
        $codes = Code::where('abbreviation', request('code'))->get();
        /** @var Code $code */
        $code = $codes->first();

        $amount = floatval(str_replace(',', '.', request('amount')));

        if (empty(request('year')))
        {
            $year = date('Y');
        }
        else
        {
            $year = request('year');
        }
        $date = sprintf('%s-%s-%s', $year, request('month'), request('day'));

        if (empty(request('vat')))
        {
            $vat = 0.00;
        }
        else
        {
            $vat = floatval(str_replace(',', '.', request('vat')));
        }

        $description = request('description') ?: '';

        Mutation::create([
            'account_id' => request('account_id'),
            'code_id' => $code->id,
            'description' => $description,
            'date' => $date,
            'amount' => $amount,
            'vat' => $vat,
        ]);

        return redirect('/rekening/' . request('account_id'));
    }
}
