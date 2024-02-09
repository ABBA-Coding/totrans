<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use ModelHelperTrait;

    protected $table = 'cities';

    protected $fillable = ['country_id', 'name_uz', 'name_ru', 'name_en', 'status', 'transport_price', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'country_id' => 'integer|required',
            'name_uz' => 'string|required',
            'name_ru' => 'string|required',
            'name_en' => 'string|required',
            'transport_price' => 'integer|nullable',
            'status' => 'nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
