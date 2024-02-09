<?php

namespace App\Models;

use App\Traits\ModelHelperTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Filemanager\Entities\Files;

class Setting extends Model
{
    use ModelHelperTrait;

    protected $table = 'settings';

    protected $fillable = ['phone', 'phone2', 'meta_title', 'meta_description', 'meta_keywords', 'meta_tags',
        'slogan', 'address', 'email', 'email2', 'fax', 'instagram', 'twitter', 'vk', 'facebook', 'telegram',
        'linkedin', 'youtube', 'map_iframe', 'map_link', 'created_at', 'updated_at', 'logo_id', 'favicon_id', 'coming_soon'];

    protected $casts = [
        'meta_title' => 'json',
        'meta_description' => 'json',
        'meta_keywords' => 'json',
        'address' => 'json',
        'slogan' => 'json',
    ];

    public static function rules()
    {
        return [
            'meta_title' => 'array|nullable',
            'meta_description' => 'array|nullable',
            'meta_keywords' => 'array|nullable',
            'meta_tags' => 'string|nullable',
            'slogan' => 'array|nullable',
            'address' => 'array|nullable',
            'fax' => 'string|nullable',
            'phone' => 'string|nullable',
            'email' => 'string|nullable',
            'instagram' => 'string|nullable',
            'twitter' => 'string|nullable',
            'vk' => 'string|nullable',
            'facebook' => 'string|nullable',
            'telegram' => 'string|nullable',
            'linkedin' => 'string|nullable',
            'youtube' => 'string|nullable',
            'map_iframe' => 'string|nullable',
            'map_link' => 'string|nullable',
            'created_at' => 'date|nullable',
            'updated_at' => 'date|nullable',

        ];
    }

    public function logo(): BelongsTo
    {
        return $this->belongsTo(Files::class);
    }

    public function favicon(): BelongsTo
    {
        return $this->belongsTo(Files::class);
    }

    public function setComingSoonAttribute($value)
    {
        if (is_string($value)) {
            if ($value === 'on') {
                $this->attributes['coming_soon'] = 1;
            } else {
                $this->attributes['coming_soon'] = 0;
            }
        } else {
            $this->attributes['coming_soon'] = $value;
        }
    }
}
