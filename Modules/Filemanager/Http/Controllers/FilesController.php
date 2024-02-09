<?php

namespace Modules\Filemanager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Filemanager\Entities\Files;
use Spatie\QueryBuilder\QueryBuilder;

class FilesController extends Controller
{
    public $modelClass = Files::class;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = QueryBuilder::for($this->modelClass);

            if ($request->has('search') && !empty($request->get('search'))) {
                $query->where('name', 'like', '%'.$request->get('search').'%');
            }

            if ($request->has('folder_id') && !empty($request->get('folder_id'))) {
                $query->where('folder_id', $request->get('folder_id'));
            }

            $query->orderBy('created_at', 'DESC');

            $files = $query->get();

            $files_html = view('filemanager::parts.files', compact('files'))->render();

            return response()->json(['files_html'=>$files_html]);
        }
        return view('filemanager::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('filemanager::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('filemanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('filemanager::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->update([
            'name' => $request->get('name')
        ]);
        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $model = $this->modelClass::findOrFail($id);
            $model->delete();

            return response()->json('success');
        }
    }
}
