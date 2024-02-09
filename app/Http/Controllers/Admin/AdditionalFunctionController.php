<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\AdditionalFunction;

/**
 * @group AdditionalFunction
 *
 */
class AdditionalFunctionController extends CrudController
{
    public $modelClass = AdditionalFunction::class;

    public $dbName = 'additional-functions';
}
