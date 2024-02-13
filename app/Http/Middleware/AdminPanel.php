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

            if (in_array($role, ['admin', 'manager'])) {
                if($request->method() == 'GET') {
                    if ($role === User::ROLE_MANAGER) {
                        if (!$request->is('admin/feedback*')) {
                            return redirect()->route('admin.feedback.index');
                        }
                    }
                }

                return $next($request);
            }
        }
        return redirect()->route('admin.login.show');
    }
}
