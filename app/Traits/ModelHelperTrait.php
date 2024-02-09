<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 25.08.2020
 * Time: 12:28
 */

namespace App\Traits;


use Modules\Filemanager\Entities\Files;

trait ModelHelperTrait
{
    public function file()
    {
        return $this->belongsTo(Files::class);
    }

    public function getStatusUIAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<span class="btn-status btn-status-warning">не активно</span>';
            case 1:
                return '<span class="btn-status btn-status-success">активно</span>';
            default:
                return '';
        }
    }

    public function getTopUIAttribute()
    {
        switch ($this->top) {
            case 1:
                return '<span class="btn-status btn-status-success">в топе</span>';
            default:
                return '';
        }
    }

    public function getMainUIAttribute()
    {
        switch ($this->main) {
            case 1:
                return '<span class="btn-status btn-status-success">главный</span>';
            default:
                return '';
        }
    }

    public function setStatusAttribute($value)
    {
        if (is_string($value)) {
            if ($value === 'on') {
                $this->attributes['status'] = 1;
            } else {
                $this->attributes['status'] = 0;
            }
        } else {
            $this->attributes['status'] = $value;
        }
    }

    public function setTopAttribute($value)
    {
        if (is_string($value)) {
            if ($value === 'on') {
                $this->attributes['top'] = 1;
            } else {
                $this->attributes['top'] = 0;
            }
        } else {
            $this->attributes['top'] = $value;
        }
    }

    public function setMainAttribute($value)
    {
        if (is_string($value)) {
            if ($value === 'on') {
                $this->attributes['main'] = 1;
            } else {
                $this->attributes['main'] = 0;
            }
        } else {
            $this->attributes['main'] = $value;
        }
    }

    public function getFile($field, $size, $default = null)
    {
        if ($this->$field) {
            return $this->$field->thumbnails[$size]['src'];
        } else {
            return $default ?: '/frontend/no-image.svg';
        }
    }

    public function scopeLang($q, $lang)
    {
        $q->where('lang', $lang);
    }

    public function scopeActive($q)
    {
        $q->where('status', 1);
    }

    public function scopeFilter($q)
    {
        if (request('name')) {
            $q->where('name', 'ILIKE', '%' . request('name') . '%');
        }

        if (request('sort_by')) {
            $sort = explode('/', request('sort_by'));
            $q->orderBy($sort[0], $sort[1]);
        }
    }
}
