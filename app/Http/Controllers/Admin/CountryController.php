<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CrudController;
use App\Models\Country;
use Illuminate\Http\Request;

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
}
