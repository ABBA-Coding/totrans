<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use ModelHelperTrait;

    protected $table = 'activities';

    protected $fillable = ['title_uz', 'title_ru', 'title_en', 'status', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'title_uz' => 'string|required',
            'title_ru' => 'string|required',
            'title_en' => 'string|required',
            'status' => 'nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }
}
