<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Manager;

/**
 * @group Manager
 *
 */
class ManagerController extends CrudController
{
    public $modelClass = Manager::class;

    public $dbName = 'managers';
}
