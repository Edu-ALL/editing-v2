<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Authentication extends Controller
{
    public function _loginEditor(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $messages = [
            "email.exists" => "This email has not been registered"
        ];

        $rules = [
            'email' => 'required|email|exists:tbl_editors,email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($credentials, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        if (!Auth::guard('web-editor')->attempt($credentials)) {
            return Redirect::back()->withErrors("Your password is wrong.");
        }

        $currentEditor = Auth::guard('web-managing-editor')->user();
        if (!$currentEditor->status == 1) {
            return Redirect::back()->withErrors("This email has not been activated.");
        }

        if ($currentEditor->position != 3){
            return redirect('editors/dashboard')->with('login-successful', 'Signed in successfully');
        } else if ($currentEditor->position == 3) {
            return redirect('editor/dashboard')->with('login-successful', 'Signed in successfully');
        }
        // return redirect('editors/dashboard')->with('login-successful', 'Signed in successfully');
    }

    public function logout()
    {
        Auth::guard('web-editor')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('login/editor');
    }
}