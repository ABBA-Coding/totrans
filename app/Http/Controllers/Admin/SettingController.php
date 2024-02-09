<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Setting;

/**
 * @group Setting
 *
 */
class SettingController extends CrudController
{
    public $modelClass = Setting::class;

    public $dbName = 'settings';
}
