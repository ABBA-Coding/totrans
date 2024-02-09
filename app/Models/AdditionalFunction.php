<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;

class AdditionalFunction extends Model
{
    use ModelHelperTrait;

    protected $table = 'additional_functions';

    protected $fillable = ['created_at', 'status', 'title_en', 'title_ru', 'title_uz', 'type', 'updated_at', 'value'];

    public static function rules()
    {
        return [
            'created_at' => 'datetime|nullable',
            'status' => 'nullable',
            'title_en' => 'string|nullable',
            'title_ru' => 'string|nullable',
            'title_uz' => 'string|nullable',
            'type' => 'integer|nullable',
            'updated_at' => 'datetime|nullable',
            'value' => 'integer|nullable',

        ];
    }
}
