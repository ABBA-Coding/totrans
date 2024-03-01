<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = ['name_uz', 'name_ru', 'name_en', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'name_uz' => 'string|required',
            'name_ru' => 'string|required',
            'name_en' => 'string|required',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }
}
