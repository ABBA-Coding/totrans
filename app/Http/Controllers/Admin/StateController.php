<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * @group States
 *
 */
class StateController extends CrudController
{
    public $modelClass = State::class;

    public $dbName = 'states';

    public function index(Request $request)
    {
        $data = $this->modelClass::with('children')->whereNull('parent_id')->orderBy('sort', 'ASC')->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data'));
    }
}
