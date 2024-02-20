<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryInclude extends Model
{
    protected $table = 'country_include';

    protected $fillable = ['country_id', 'include_id'];

    public static function rules()
    {
        return [
            'country_id' => 'integer|required',
            'include_id' => 'integer|required',
        ];
    }
}
