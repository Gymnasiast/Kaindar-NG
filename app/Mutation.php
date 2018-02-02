<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mutation
 * @package App
 *
 * @property int $id
 * @property int $account_id
 * @property int $code_id
 * @property string $date
 * @property string $description
 * @property double $amount
 * @property double $vat
 * @property string $created_at
 * @property string $updated_at
 */
class Mutation extends Model
{
    protected $fillable = ['account_id', 'code_id', 'description', 'date', 'amount', 'vat'];

    public function amountFriendly()
    {
        return Util::amountToEuro($this->amount);
    }

    public function dateFriendly()
    {
        return date('d-m-Y', strtotime($this->date));
    }

    public function vatFriendly()
    {
        return str_replace('.', ',', $this->vat);
    }

    public function getCodeName()
    {
        if (empty($this->code_id))
        {
            return 'Onbekend';
        }

        $code = Code::find($this->code_id);
        return $code->description;
    }
}
