<?php

namespace Modules\Filemanager\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Filemanager\Entities\Files;
use Modules\Filemanager\Services\FileService;

class FilemanagerController extends Controller
{
    public function field(Request $request)
    {
        if ($request->ajax()) {
            $name = $request->get('name');
            $label = $request->get('label');
            $id = $request->get('id');
            $isMultiple = $request->get('isMultiple') === 'false' ? false : true;
            $files = $request->get('ids') ? Files::whereIn('id', $request->get('ids'))->get() : [];
            $value = $request->get('ids') ? implode(',', $request->get('ids')) : '';

            $html = view('filemanager::components.field', compact('name','label','id','isMultiple','files','value'))->render();
            return response()->json($html);
        }
    }

    public function upload(Request $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), ['file.*'=>'max:20000']);

            if ($validator->fails()) {
                return response()->json(['error'=>'Sorry! Maximum allowed size for an image is 2MB'], 422);
            }

            $files = $request->file('file');
            $folder_id = $request->get('folder_id') === 'null' ? null : $request->get('folder_id');
            try {
                if (count($files) > 0) {
                    $fileService = new FileService();
                    $fileService->uploadFiles($files, $folder_id);
                }
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                return response()->json(['error'=>$exception->getMessage()], 422);
            }

            return response()->json('success');
        }
    }
}
