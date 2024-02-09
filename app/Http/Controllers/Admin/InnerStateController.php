<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;

/**
 * @group City
 *
 */
class InnerStateController extends Controller
{
    public $modelClass = State::class;

    public $dbName = 'states';

    public function index($parent_id)
    {
        $parent = State::findOrFail($parent_id);
        $data = $this->modelClass::orderBy('sort', 'ASC')->where('parent_id', $parent_id)->paginate(15);
        return view('admin.'.$this->dbName.'.inner.index', compact('data', 'parent'));
    }

    public function create($parent_id)
    {
        $parent = State::findOrFail($parent_id);
        $data = $this->modelClass;
        return view('admin.'.$this->dbName.'.inner.create', compact('data', 'parent'));
    }

    public function store(Request $request, $parent_id)
    {
        $request->validate($this->modelClass::rules());
        $model = $this->modelClass::create($request->all());

        return redirect()->route('admin.'.$this->dbName.'.inner.edit', ['parent_id' => $parent_id, 'id'=>$model->id])->with(['success'=>'Успешно сохранено']);
    }

    public function edit($parent_id, $id)
    {
        $parent = State::findOrFail($parent_id);
        $data = $this->modelClass::findOrFail($id);
        return view('admin.'.$this->dbName.'.inner.edit', compact('data', 'parent'));
    }

    public function update(Request $request, $parent_id, $id)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::findOrFail($id);
        $model->update($request->all());

        return redirect()->back()->with(['success'=>'Успешно обновлено']);
    }

    public function destroy($parent_id, $id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->delete();

        return redirect()->back()->with(['success'=>'Успешно удалено']);
    }
}
