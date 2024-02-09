<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {
        $data = $request->except(['_token']);

        if (!$user = $this->getUserWiaEmail($data['email'])) {
            return redirect()->back()->withErrors(['Введен неверный логин или пароль']);
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->withErrors(['Введен неверный логин или пароль']);
        }
    }

    private function getUserWiaEmail($email) {
        return User::whereEmail($email)->first();
    }
}
