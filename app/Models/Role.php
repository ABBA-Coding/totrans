<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'role'];

    public static function rules()
    {
        return [
            'user_id' => 'integer',
            'role' => 'string'
        ];
    }
}
