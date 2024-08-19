<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Imports\ApplicationImport;
use App\Models\Activity;
use App\Models\Application;
use App\Models\Batch;
use App\Models\Country;
use App\Models\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Filemanager\Entities\Files;

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

    public function import()
    {
        return view('admin.applications.import');
    }

    public function importPost(Request $request)
    {
        $request->validate([
            'file_id' => 'required|integer'
        ]);

        $file = Files::findOrFail($request->get('file_id'));
        $src = '/'.$file->folder.'/'.$file->file;

        DB::beginTransaction();
        try {
            Excel::import(new ApplicationImport(2), $src, 'static');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }

        return redirect()->route('admin.applications.index')->with(['success'=>'Успешно импортирована заявки']);
    }
}
