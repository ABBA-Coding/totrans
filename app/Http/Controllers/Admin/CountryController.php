<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Country;
use App\Models\Includes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Country
 *
 */
class CountryController extends CrudController
{
    public $modelClass = Country::class;

    public $dbName = 'countries';

    public function index(Request $request)
    {
        $data = $this->modelClass::with('cities')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = $this->modelClass;
        $includes = Includes::all();
        return view('admin.'.$this->dbName.'.create', compact('data', 'includes'));
    }

    public function edit($id, Request $request)
    {
        $data = $this->modelClass::with('includes')->findOrFail($id);
        $includes = Includes::all();
        return view('admin.'.$this->dbName.'.edit', compact('data', 'includes'));
    }

    public function store(Request $request)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::create($request->all());

        if (isset($request->includes) && is_array($request->includes)) {
            foreach ($request->includes as $include) {
                DB::table('country_include')->insert([
                    'country_id' => $model->id,
                    'include_id' => $include
                ]);
            }
        }

        return redirect()->route('admin.'.$this->dbName.'.edit', ['id'=>$model->id])->with(['success'=>'Успешно сохранено']);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::findOrFail($id);
        $model->update($request->all());

        DB::table('country_include')->where('country_id', $model->id)->delete();
        if (isset($request->includes) && is_array($request->includes)) {
            foreach ($request->includes as $include) {
                DB::table('country_include')->insert([
                    'country_id' => $model->id,
                    'include_id' => $include
                ]);
            }
        }

        return redirect()->back()->with(['success'=>'Успешно обновлено']);
    }
}
