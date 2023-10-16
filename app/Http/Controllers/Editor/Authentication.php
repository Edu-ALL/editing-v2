<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\Token;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

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
            Log::notice("Login was fails for " . $request->email. " email, the password is wrong.");
            return Redirect::back()->withErrors("Your password is wrong.");
        }

        $currentEditor = Auth::guard('web-editor')->user();

        if (!$currentEditor->status == 1) {
            Log::notice("Login was fails " . $request->email . " has not been activated.");
            return Redirect::back()->withErrors("This email has not been activated.");
        }

        Log::notice("Login was successful for " . $request->email);
        if ($currentEditor->position != 3) {
            return redirect('editors/dashboard')->with('login-successful', 'Signed in successfully');
        } else if ($currentEditor->position == 3) {
            return redirect('editor/dashboard')->with('login-successful', 'Signed in successfully');
        }
        // return redirect('editors/dashboard')->with('login-successful', 'Signed in successfully');
    }

    public function logout()
    {
        $currentEditor = Auth::guard('web-editor')->user();
        Auth::guard('web-editor')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        Log::notice("Logout was successful for ".$currentEditor->email." logout is successfully.");
        return redirect('login/editor');
    }


    public function send_reset_password(Request $request)
    {
        $validatedEmail = $request->validate([
            'email' => 'required|exists:tbl_editors,email',
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
        Mail::send('mail.forgot-password.editor.send-reset-password', $user_token, function ($mail) use ($email) {
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->to($email);
            $mail->subject('Reset Password');
        });

        if (Mail::failures()) {
            Log::error("Send email reset password was failed for " . $email . " email.");
            return redirect('/login/editor')->with('send-email-error', 'Email not sent, Try again!');
        }

        Log::notice("Send email reset password was successful for " . $email . " email.");
        return redirect('/login/editor')->with('send-email-success', 'Email has been send, please check your email!');
    }

    public function form_reset_password(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');
        $role = $request->get('role');

        if ($user_token = Token::where('token', $token)->first()) {
            if (!$user_token) {
                Log::error("Send reset password was failed for " . $email . " email. Token not found!");
                return redirect('/login/editor')->with('token-not-found', 'Token not found, request again!');
            }
        }

        if (!in_array($role, ['admin', 'editor', 'mentor'])) {
            Log::error("Send reset password was failed for " . $email . " email. Role not found!");
            return redirect('/login/editor')->with('role-not-found', 'Role is not found');
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

        // DD($request);

        DB::beginTransaction();
        try {
            $editor = Editor::where('email', $request->email)->first();
            $editor->password = Hash::make($request->password);
            $editor->save();

            $token = Token::where('token', $request->reset_token)->first();
            $token->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Reset password was failed ". $e->message());
            return Redirect::back()->with('error-reset-password', "Failed to update password!");
        }

        Log::notice("Reset password was successful for " . $request->email . " email.");
        return redirect('login/editor')->with('success-reset-password', "Password has been updated!");
    }

    public function delete_token(Request $request)
    {
        DB::beginTransaction();

        try {
            $token = Token::where('token', $request->token)->first();
            $token->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return response()->json(["success" => "Token has been deleted!"]);
    }
}
