<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Includes extends Model
{
    use ModelHelperTrait;

    protected $table = 'includes';

    protected $fillable = ['title_ru', 'title_uz', 'title_en', 'description_ru', 'description_uz', 'description_en', 'sort', 'status', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'title_ru' => 'string|required',
            'title_uz' => 'string|nullable',
            'title_en' => 'string|nullable',
            'description_ru' => 'string|required',
            'description_uz' => 'string|nullable',
            'description_en' => 'string|nullable',
            'sort' => 'integer|nullable',
            'status' => 'nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'country_include','include_id','country_id');
    }
}
