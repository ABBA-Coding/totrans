<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use ModelHelperTrait;

    protected $table = 'managers';

    protected $fillable = ['file_id', 'name_ru', 'name_uz', 'name_en', 'phone', 'telegram', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'file_id' => 'integer|nullable',
            'name_ru' => 'string|nullable',
            'name_uz' => 'string|nullable',
            'name_en' => 'string|nullable',
            'phone' => 'string|nullable',
            'telegram' => 'string|nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }
}
