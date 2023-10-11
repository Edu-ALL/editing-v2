<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Token;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


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
            Log::error('Login failed : '.$request->email.' has not been registered');
            return Redirect::back()->withErrors($validator->messages());
        }

        if (!Auth::guard('web-admin')->attempt($credentials)) {
            return Redirect::back()->withErrors("Your password is wrong.");
        }

        $currentAdmin = Auth::guard('web-admin')->user();
        if (!$currentAdmin->status == 1) {
            return Redirect::back()->withErrors("This email has not been activated.");
        }
        Log::notice('Email : '.Auth::guard('web-admin')->user()->email.' has been successfully logged in');
        return redirect('admin/dashboard')->with('login-successful', 'Signed in successfully');
    }

    public function logout()
    {
        Log::notice('Email : '.Auth::guard('web-admin')->user()->email.' has been successfully logged out');
        Auth::guard('web-admin')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('login/admin');
    }

    public function send_reset_password(Request $request)
    {
        $validatedEmail = $request->validate([
            'email' => 'required|exists:tbl_admins,email',
        ]);

        $email = $validatedEmail['email'];
        $user_token = [
            'email' => $email,
            'token' => Crypt::encrypt(Str::random(32)),
            'activated_at' => time(),
        ];

        # save token
        Token::create($user_token);

        # send email to user
        Mail::send('mail.forgot-password.admin.send-reset-password', $user_token, function ($mail) use ($email) {
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->to($email);
            $mail->subject('Reset Password');
        });

        if (Mail::failures()) {
            Log::error($email.' : Email not sent. '.Mail::failures());
            return redirect('/login/admin')->with('send-email-error', 'Email not sent, Try again!');
        }

        Log::notice('Email : '.$email.' has been send');
        return redirect('/login/admin')->with('send-email-success', 'Email has been send, please check your email!');
    }

    public function form_reset_password(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');
        $role = $request->get('role');

        if ($user_token = Token::where('token', $token)->first()) {
            if (!$user_token) {
                return redirect('/login/admin')->with('token-not-found', 'Token not found, request again!');
            }
        }

        if (!in_array($role, ['admin', 'editor', 'mentor'])) {
            return redirect('/login/admin')->with('role-not-found', 'Role is not found');
        }

        DB::beginTransaction();
        try {
            # delete all token that expire in 1 hour
            $all_token = Token::where('activated_at', '<', time() - 3600)->get();
            foreach ($all_token as $token) {
                if ($user_token->activated_at < time() - 3600) {
                    $user_token->delete();
                    DB::commit();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
        }

        return view('forgot.reset-password', ['request' => $request]);
    }

    public function reset_password(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $admin = Admin::where('email', $request->email)->first();
            $admin->password = Hash::make($request->password);
            $admin->save();

            $token = Token::where('token', $request->reset_token)->first();
            $token->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return Redirect::back()->with('error-reset-password', $e->getMessage());
        }
        Log::notice($admin->email.' password has been updated');
        return redirect('login/admin')->with('success-reset-password', "Password has been updated!");
    }
}
