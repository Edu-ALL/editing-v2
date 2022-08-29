<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Authentication extends Controller
{
    public function _loginMentors(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $messages = [
            "email.exists" => "This email has not been registered"
        ];

        $rules = [
            'email' => 'required|email|exists:tbl_mentors,email',
            'password' => 'required|min:6',
        ];
// return "a";
        $validator = Validator::make($credentials, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        if (!Auth::guard('web-mentor')->attempt($credentials)) {
            return Redirect::back()->withErrors("Your password is wrong.");
        }
        // return $validator;
        $currentMentor = Auth::guard('web-mentor')->user();
        
        if (!$currentMentor->status == 1) {
            return Redirect::back()->withErrors("This email has not been activated.");
        }

        return redirect('mentor/dashboard')->with('login-successful', 'Signed in successfully');
    }

    public function logout()
    {
        Auth::guard('web-mentor')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('login/mentor');
    }
}