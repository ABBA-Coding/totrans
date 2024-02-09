<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Includes;
use Illuminate\Http\Request;

/**
 * @group Includes
 *
 */
class IncludesController extends CrudController
{
    public $modelClass = Includes::class;

    public $dbName = 'includes';

    public function index(Request $request)
    {
        $data = $this->modelClass::filter($request->input())->orderBy('sort', 'ASC')->paginate(15);
        return view('admin.'.$this->dbName.'.index', compact('data'));
    }
}
