<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Batch;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * @group Batch
 *
 */
class BatchController extends CrudController
{
    public $dbName = 'batches';

    public $modelClass = Batch::class;

    public function index(Request $request)
    {
        $data = $this->modelClass::withCount('applications')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = $this->modelClass;
        $states = State::with('children')->whereNull('parent_id')->active()->get();

        return view('admin.'.$this->dbName.'.create', compact('data', 'states'));
    }

    public function edit($id, Request $request)
    {
        $data = $this->modelClass::findOrFail($id);
        $states = State::with('children')->whereNull('parent_id')->active()->get();

        return view('admin.'.$this->dbName.'.edit', compact('data', 'states'));
    }
}
