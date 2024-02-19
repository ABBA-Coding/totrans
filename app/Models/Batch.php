<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    const STATUS_WAITING = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_REJECTED = 3;

    use ModelHelperTrait;

    protected $table = 'batches';

    protected $fillable = ['batch_number', 'state_id', 'status', 'created_at', 'updated_at'];

    public static function rules()
    {
        return [
            'batch_number' => 'string|required',
            'state_id' => 'integer|required',
            'status' => 'integer|nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }

    public function setBatchNumberAttribute($value)
    {
        $this->attributes['batch_number'] = str_replace('_', '', $value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = (int)$value;
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'batch_id', 'id');
    }
}
