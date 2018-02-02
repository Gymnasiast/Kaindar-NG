<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 * @package App
 *
 * @property string $key
 * @property string $value
 */
class Setting extends Model
{
    public static function getValueByKey(string $key): string
    {
        $settings = static::where('key', $key)->get();
        return $settings->first()['value'];
    }

    public function getFriendlyName()
    {
        switch($this->key)
        {
            case 'defaultYear':
                return 'Standaardjaar';
            default:
                return $this->key;
        }
    }
}
