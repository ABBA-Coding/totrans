<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role) {
            $role = $user->role->role;
            $unauthorized = false;

            if (in_array($role, [User::ROLE_ADMIN, User::ROLE_LOGIST, User::ROLE_SALES, User::ROLE_MANAGER])) {
                if($request->method() == 'GET') {

                    if ($role === User::ROLE_LOGIST) {
                        if (!$request->is('admin/feedback*') && !$request->is('admin/clients*') && !$request->is('admin/applications*') && !$request->is('admin/batches*')) {
                           $unauthorized = true;
                        }
                    } elseif ($role === User::ROLE_SALES) {
                        if (!$request->is('admin/feedback*') && !$request->is('admin/clients*') && !$request->is('admin/applications*')) {
                            $unauthorized = true;
                        }
                    } elseif ($role === User::ROLE_MANAGER) {
                        if ($request->is('admin/clients*') || $request->is('admin/users*')) {
                            $unauthorized = true;
                        }
                    }
                }

                if ($unauthorized) {
                    return redirect()->route('admin.feedback.index');
                }

                return $next($request);
            }
        }
        return redirect()->route('admin.login.show');
    }
}
