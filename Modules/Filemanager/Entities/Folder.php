<?php

namespace Modules\Filemanager\Entities;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = ['id','name','created_at','updated_at'];
}
