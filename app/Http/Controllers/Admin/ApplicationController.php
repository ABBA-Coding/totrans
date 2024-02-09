<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Activity;
use App\Models\Application;
use App\Models\Batch;
use App\Models\Country;
use App\Models\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group Application
 *
 */
class ApplicationController extends CrudController
{
    public $modelClass = Application::class;

    public $dbName = 'applications';

    public function create(Request $request)
    {
        $data = $this->modelClass;
        $countries = Country::with('cities')->active()->get();
        $activities = Activity::active()->get();
        $batches = Batch::all();

        $users = User::whereHas('role', function ($role) {
            $role->where('role', User::ROLE_CLIENT);
        })->get();

        return view('admin.'.$this->dbName.'.create', compact('data', 'users', 'countries', 'activities', 'batches'));
    }

    public function store(Request $request)
    {
        $request->validate($this->modelClass::rules());

        $data = $request->all();
        $data['application_number'] = Str::random(6);
        $data['order_date'] = Carbon::now()->unix();

        $model = $this->modelClass::create($data);

        return redirect()->route('admin.'.$this->dbName.'.edit', ['id'=>$model->id])->with(['success'=>'Успешно сохранено']);
    }

    public function edit($id, Request $request)
    {
        $data = $this->modelClass::findOrFail($id);

        $countries = Country::with('cities')->active()->get();
        $activities = Activity::active()->get();
        $batches = Batch::all();

        $users = User::whereHas('role', function ($role) {
            $role->where('role', User::ROLE_CLIENT);
        })->get();

        return view('admin.'.$this->dbName.'.edit', compact('data', 'users', 'countries', 'activities', 'batches'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::findOrFail($id);
        $model->update($request->all());

        return redirect()->back()->with(['success'=>'Успешно обновлено']);
    }
}
