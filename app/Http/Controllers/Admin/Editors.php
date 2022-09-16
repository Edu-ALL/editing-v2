<?php

namespace App\Http\Controllers\Admin;

use App\Models\Editor;
use App\Models\EssayClients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class Editors extends Controller
{
    public function invite(Request $request)
    {
        $email = $request->email;
        $user_token = [
            'email' => $email,
            'token' => Crypt::encrypt(Str::random(32)),
            'activated_at' => time()
        ];

        # save token
        Token::create($user_token);

        # send email to user
        Mail::send('mail.invite-editor', $user_token, function($mail) use ($email) {
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->to($email);
            $mail->subject('Invitation To The Editor');
        });

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }

        return redirect('admin/user/editor/invite')->with('invite-editor-successful', 'Invitation email has been sent');
    }

    public function join_editor(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');

        if (Auth::guard("web-admin")->check()) {
            return redirect('/')->with('accept-editor-invitation-error', 'You need to log out');
        }

        if (!$user_token = Token::where('token', $token)->first()) {
            return redirect('/')->with('accept-editor-invitation-error', 'Token is not found');
        }

        return view('register-editor', ['request' => $request]);
    }

    public function selfAddEditor(Request $request)
    {
        $rules = [
            'img' => 'nullable|max:2048',
            'first_name' => 'required',
            'last_name' => 'nullable',
            'phone' => 'required',
            'email' => 'required|email',
            'graduated_from' => 'required',
            'major' => 'required',
            'address' => 'required',
            'password' => 'required|min:6|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        if ($request->hasFile('img')) {        

            $time = date("His");
            $file_name = str_replace(' ', '-', strtolower($request->first_name.' '.$request->last_name));
            $file_format = $request->file('img')->getClientOriginalExtension();
            $med_file_path = $request->file('img')->storeAs('user/editors', $time.'-'.$file_name.'.'.$file_format, ['disk' => 'public_assets']);
            $img = $time.'-'.$file_name.'.'.$file_format;
        }

        DB::beginTransaction();
        try {
            $new_editor = new Editor;
            $new_editor->first_name = $request->first_name;
            $new_editor->last_name = $request->last_name;
            $new_editor->phone = $request->phone;
            $new_editor->email = $request->email;
            $new_editor->graduated_from = $request->graduated_from;
            $new_editor->major = $request->major;
            $new_editor->address = $request->address;
            $new_editor->position = 1;
            $new_editor->image = $img;
            $new_editor->status = 1;
            $new_editor->password = Hash::make($request->password);
            $new_editor->save();

            $token = Token::where('token', $request->editorToken)->first();
            $token->delete();

            DB::commit();

        } catch (Exception $e) {
            
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('/login/editor')->with('add-editor-successful', 'Editors has been created');
    }

    public function index(Request $request){
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $editors->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-editor', ['editors' => $editors]);
    }

    public function detail($id){
        $essay_ongoing = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '!=', 7)->paginate(5);
        $essay_completed = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '=', 7)->paginate(5);
        return view('user.admin.users.user-editor-detail', [
            'editor' => Editor::find($id),
            'essay_ongoing' => $essay_ongoing,
            'essay_completed' => $essay_completed,
        ]);
    }

    public function store(Request $request){
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'graduated_from' => 'nullable',
            'major' => 'nullable',
            'address' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $new_editor = new Editor;
            $new_editor->first_name = $request->first_name;
            $new_editor->last_name = $request->last_name;
            $new_editor->phone = $request->phone;
            $new_editor->email = $request->email;
            $new_editor->graduated_from = $request->graduated_from;
            $new_editor->major = $request->major;
            $new_editor->address = $request->address;
            $new_editor->position = $request->position;
            $new_editor->status = 1;
            $new_editor->save();
            DB::commit();

        } catch (Exception $e) {
            
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/user/editor')->with('add-editor-successful', 'The new Editor has been saved');
    }

    public function update($id_editors, Request $request){
        $rules = [
            'position' => 'nullable',
        ];

        $validator = Validator::make($request->all() + ['id_editors' => $id_editors], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $editor = Editor::find($id_editors);
            $editor->position = $request->position;
            $editor->save();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/user/editor/detail/'.$id_editors)->with('update-editor-successful', 'The Editor has been updated');
    }
}
