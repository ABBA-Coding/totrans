<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Application;
use App\Models\Batch;
use App\Models\State;
use App\Services\BitrixService;
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

        $ownApplications = Application::where('batch_id', $id)->get();
        $otherApplications = Application::whereNull('batch_id')->get();
        return view('admin.'.$this->dbName.'.edit', compact('data', 'states', 'ownApplications', 'otherApplications'));
    }

    public function transfer($id, Request $request)
    {
        $ownIds = $request->get('own') ? array_keys($request->get('own')) : [];
        $otherIds = $request->get('other') ? array_keys($request->get('other')) : [];

        if (count($ownIds) > 0) {
            Application::whereIn('id', $ownIds)->update([
                'batch_id' => null
            ]);
        }

        if (count($otherIds) > 0) {
            $applications = Application::whereIn('id', $otherIds);
            $applications->update([
                'batch_id' => $id
            ]);
            $service = new BitrixService();
            $applications->each(function($application) use ($service, $id) {
                $service->assignBatch($application->bitrix_id, $id);
            });
        }

        return redirect()->back()->with(['success'=>'Успешно сохранено']);
    }
}
