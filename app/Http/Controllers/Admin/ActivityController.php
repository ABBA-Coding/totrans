<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Activity;

/**
 * @group Activity
 *
 */
class ActivityController extends CrudController
{
    public $modelClass = Activity::class;

    public $dbName = 'activities';
}
