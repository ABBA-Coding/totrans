<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use ModelHelperTrait;

    protected $table = 'states';

    protected $fillable = ['title_uz', 'title_ru', 'title_en', 'file_id', 'parent_id', 'sort', 'status', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'title_uz' => 'string|required',
            'title_ru' => 'string|required',
            'title_en' => 'string|required',
            'file_id' => 'integer|nullable',
            'parent_id' => 'integer|nullable',
            'sort' => 'integer|nullable',
            'status' => 'nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(State::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(State::class, 'parent_id')->orderBy('sort');
    }
}
