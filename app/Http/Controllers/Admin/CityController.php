<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

/**
 * @group City
 *
 */
class CityController extends Controller
{
    public $modelClass = City::class;

    public $dbName = 'cities';

    public function index($country_id)
    {
        $country = Country::findOrFail($country_id);
        $data = $this->modelClass::orderBy('created_at', 'DESC')->where('country_id', $country_id)->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data', 'country'));
    }

    public function create($country_id)
    {
        $country = Country::findOrFail($country_id);
        $data = $this->modelClass;
        return view('admin.'.$this->dbName.'.create', compact('data', 'country'));
    }

    public function store(Request $request, $country_id)
    {
        $request->validate($this->modelClass::rules());
        $model = $this->modelClass::create($request->all());

        return redirect()->route('admin.'.$this->dbName.'.edit', ['country_id' => $country_id, 'id'=>$model->id])->with(['success'=>'Успешно сохранено']);
    }

    public function edit($country_id, $id)
    {
        $country = Country::findOrFail($country_id);
        $data = $this->modelClass::findOrFail($id);
        return view('admin.'.$this->dbName.'.edit', compact('data', 'country'));
    }

    public function update(Request $request, $country_id, $id)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::findOrFail($id);
        $model->update($request->all());

        return redirect()->back()->with(['success'=>'Успешно обновлено']);
    }

    public function destroy($country_id, $id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->delete();

        return redirect()->back()->with(['success'=>'Успешно удалено']);
    }
}
