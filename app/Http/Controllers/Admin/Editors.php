<?php

namespace App\Http\Controllers\Admin;

use App\Models\Editor;
use App\Models\EssayClients;
use App\Http\Controllers\Controller;
use App\Models\EssayEditors;
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
use Yajra\DataTables\Facades\DataTables;

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
        Mail::send('mail.invite-editor', $user_token, function ($mail) use ($email) {
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->to($email);
            $mail->subject('Invitation To The Editor');
        });

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }

        if (Auth::guard('web-admin')->check())
            return redirect('admin/user/editor/invite')->with('invite-editor-successful', 'Invitation email has been sent');
        else
            return redirect('editor/invite')->with('invite-editor-successful', 'Invitation email has been sent');
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
            $file_name = str_replace(' ', '-', strtolower($request->first_name . ' ' . $request->last_name));
            $file_format = $request->file('img')->getClientOriginalExtension();
            $med_file_path = $request->file('img')->storeAs('user/editors', $time . '-' . $file_name . '.' . $file_format, ['disk' => 'public_assets']);
            $img = $time . '-' . $file_name . '.' . $file_format;
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
            $new_editor->image = isset($img) ? $img : "default.png";
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

    public function getEditor(Request $request){
        if ($request->ajax()) {
            $data = Editor::orderBy('first_name', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('fullname', function($d){
                $result = '
                    '.$d->first_name . ' ' . $d->last_name.'
                ';
                return $result;
            })
            ->editColumn('email', function($d){
                $result = '
                    '.$d->email ? $d->email : "-".'
                ';
                return $result;
            })
            ->editColumn('phone', function($d){
                $result = '
                    '.$d->phone ? $d->phone : "-".'
                ';
                return $result;
            })
            ->editColumn('address', function($d){
                $result = '
                    '.$d->address ? $d->address : "-".'
                ';
                return $result;
            })
            ->editColumn('position', function($d){
                if ($d->position == 1) {
                    $result = 'Associate';
                } else if ($d->position == 2) {
                    $result = 'Senior';
                } else if ($d->position == 3) {
                    $result = 'Managing';
                }
                return $result;
            })
            ->editColumn('status', function($d){
                if ($d->status == 1) {
                    $result = '
                        <div class="status-editor">
                            Active
                        </div>
                    ';
                } else {
                    $result = '
                        <div class="status-editor" style="background-color: var(--red)">
                            Deactive
                        </div>
                    ';
                }
                return $result;
            })
            ->rawColumns(['fullname', 'email', 'phone', 'address', 'position', 'status'])
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        return view('user.admin.users.user-editor');
    }

    public function detail($id, Request $request)
    {
        $keyword1 = $request->get('keyword-ongoing');
        $keyword2 = $request->get('keyword-completed');
        $essay_ongoing = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 4)->where('status_essay_clients', '!=', 5)->where('status_essay_clients', '!=', 7)->when($keyword1, function ($query_) use ($keyword1) {
            $query_->where(function ($query) use ($keyword1) {
                $query->orWhereHas('client_by_id', function ($query_client) use ($keyword1) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword1 . '%');
                })->orWhereHas('program', function ($query_program) use ($keyword1) {
                    $query_program->where('program_name', 'like', '%' . $keyword1 . '%');
                })->orWhereHas('status', function ($query_status) use ($keyword1) {
                    $query_status->where('status_title', 'like', '%' . $keyword1 . '%');
                })->orWhere('essay_title', 'like', '%' . $keyword1 . '%');
            });
        })->paginate(5);
        $essay_completed = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '=', 7)->when($keyword2, function ($query_) use ($keyword2) {
            $query_->where(function ($query) use ($keyword2) {
                $query->orWhereHas('client_by_id', function ($query_client) use ($keyword2) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword2 . '%');
                })->orWhereHas('program', function ($query_program) use ($keyword2) {
                    $query_program->where('program_name', 'like', '%' . $keyword2 . '%');
                })->orWhereHas('status', function ($query_status) use ($keyword2) {
                    $query_status->where('status_title', 'like', '%' . $keyword2 . '%');
                })->orWhere('essay_title', 'like', '%' . $keyword2 . '%');
            });
        })->paginate(5);

        $editor = Editor::find($id);
        $count_essay = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', '=', 'tbl_essay_editors.id_essay_clients')->where('editors_mail', $editor->email)->where('essay_rating', '!=', 0)->get();

        $rating = 0;
        $i = 0;
        foreach ($count_essay as $essay) {
            $rating += $count_essay[$i]->essay_rating;
            $i++;
        }

        $average_rating = 0;
        if ($rating != 0) {
            $average_rating = $rating / count($count_essay);
        }

        return view('user.admin.users.user-editor-detail', [
            'editor' => $editor,
            'essay_ongoing' => $essay_ongoing,
            'essay_completed' => $essay_completed,
            'average_rating' => number_format($average_rating, 1, ".", ",")
        ]);
    }

    public function store(Request $request)
    {
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
            $new_editor->image = "default.png";
            $new_editor->password = Hash::make(12345678);
            $new_editor->status = 1;
            $new_editor->save();
            DB::commit();
        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('admin/user/editor')->with('add-editor-successful', 'The new Editor has been saved');
    }

    public function update($id_editors, Request $request)
    {
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

        return redirect('admin/user/editor/detail/' . $id_editors)->with('update-editor-successful', 'The Editor has been updated');
    }

    public function deactivate($id_editors)
    {
        DB::beginTransaction();
        try {
            $editor = Editor::find($id_editors);
            $editor->status = 2;
            $editor->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/user/editor');
    }

    public function activate($id_editors)
    {
        DB::beginTransaction();
        try {
            $editor = Editor::find($id_editors);
            $editor->status = 1;
            $editor->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/user/editor');
    }
}
