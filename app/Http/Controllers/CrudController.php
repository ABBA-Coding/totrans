<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{
    public $dbName;

    public function index(Request $request)
    {
        $data = $this->modelClass::filter($request->input())->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data'));
    }

    public function create(Request $request)
    {
        $data = $this->modelClass;
        return view('admin.'.$this->dbName.'.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::create($request->all());

        return redirect()->route('admin.'.$this->dbName.'.edit', ['id'=>$model->id])->with(['success'=>'Успешно сохранено']);
    }

    public function edit($id, Request $request)
    {
        $data = $this->modelClass::findOrFail($id);
        return view('admin.'.$this->dbName.'.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->modelClass::rules());

        $model = $this->modelClass::findOrFail($id);
        $model->update($request->all());

        return redirect()->back()->with(['success'=>'Успешно обновлено']);
    }

    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->delete();

        return redirect()->back()->with(['success'=>'Успешно удалено']);
    }
}
