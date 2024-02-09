<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

/**
 * @group Feedback
 *
 */
class FeedbackController extends Controller
{
    /**
     * @var Feedback $modelClass
     */
    public $modelClass = Feedback::class;

    public $dbName = 'feedback';

    public function index()
    {
        $data = $this->modelClass::orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data'));
    }

    public function show($id)
    {
        $data = $this->modelClass::findOrFail($id);
        if ($data->status === 0) {
            $data->status = 1;
            $data->save();
        }
        return view('admin.'.$this->dbName.'.show', compact('data'));
    }

    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);
        $model->delete();

        return redirect()->back()->with(['success'=>'Успешно удалено']);
    }
}
