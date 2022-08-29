<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Authentication extends Controller
{
    public function _loginAdmins(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $messages = [
            "email.exists" => "This email has not been registered"
        ];

        $rules = [
            'email' => 'required|email|exists:tbl_admins,email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($credentials, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        if (!Auth::guard('web-admin')->attempt($credentials)) {
            return Redirect::back()->withErrors("Your password is wrong.");
        }

        $currentAdmin = Auth::guard('web-admin')->user();
        if (!$currentAdmin->status == 1) {
            return Redirect::back()->withErrors("This email has not been activated.");
        }

        return redirect('admin/dashboard')->with('login-successful', 'Signed in successfully');
    }

    public function logout()
    {
        Auth::guard('web-admin')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('login/admin');
    }
}