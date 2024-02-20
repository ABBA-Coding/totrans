<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    const POINT_A = 1;
    const POINT_B = 2;
    const POINT_AB = 3;

    use ModelHelperTrait;

    protected $table = 'countries';

    protected $fillable = ['name_uz', 'name_ru', 'name_en', 'type', 'status', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'name_uz' => 'string|required',
            'name_ru' => 'string|required',
            'name_en' => 'string|required',
            'type' => 'integer|nullable',
            'status' => 'nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }

    public function includes(): BelongsToMany
    {
        return $this->belongsToMany(Includes::class, 'country_include','country_id','include_id');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
