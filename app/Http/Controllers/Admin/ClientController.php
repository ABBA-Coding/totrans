<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Manager;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public $modelClass = User::class;

    public function index(Request $request)
    {
        $_q = $request->_q;

        $data = $this->modelClass::whereHas('role', function ($role) {
            $role->where('role', User::ROLE_CLIENT);
        })
            ->when(!empty($_q), function ($query) use ($_q){
                $query->where('name', 'like', '%'.$_q.'%')
                ->orWhere('phone', 'like', '%'.$_q.'%')
                ->orWhere('email', 'like', '%'.$_q.'%')
                ->orWhere('login', 'like', '%'.$_q.'%');
            })
            ->with('activity', 'manager')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.clients.index', compact('data'));
    }

    public function form(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->get('user_id');

            if ($id) {
                $data = $this->modelClass::findOrFail($id);
            } else {
                $data = new $this->modelClass;
            }

            $activities = Activity::active()->get();

            $managers = Manager::all();

            $view = view('admin.clients.form', compact('data', 'activities', 'managers'))->render();

            return response()->json(['view'=>$view]);
        }

        return response()->json(['errorMessage'=>'error'], 422);
    }

    public function post(Request $request, $id = null)
    {
        $data = $request->only(['name', 'email', 'phone', 'activity_id', 'manager_id', 'company_name']);

        $password = $request->get('password');

        DB::beginTransaction();
        try {
            if ($id) {

                $request->validate([
                    'name' => 'string|required',
                    'email' => 'nullable|email|unique:users,email,'.$id,
                    'phone' => 'string|nullable',
                    'activity_id' => 'integer|nullable',
                    'manager_id' => 'integer|nullable',
                ]);

                if (!empty($password)) {
                    $data['password'] = bcrypt($password);
                }

                $user = $this->modelClass::findOrFail($id);

                $user->update($data);
            } else {
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                    'phone' => 'string|nullable',
                    'activity_id' => 'integer|nullable',
                    'manager_id' => 'integer|nullable',
                ]);

                $data['password'] = bcrypt($password);
                $data['login'] = Str::random(9);

                $user = $this->modelClass::create($data);

                DB::table('roles')->insert([
                    'user_id' => $user->id,
                    'role' => User::ROLE_CLIENT
                ]);
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('success', 'Успешно сохранено');
    }

    public function destroy($id)
    {
        $model = $this->modelClass::findOrFail($id);

        $model->delete();
        return redirect()->back()->with(['success'=>'Успешно удалено']);
    }
}
