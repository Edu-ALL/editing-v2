<?php

namespace App\Http\Controllers\Admin;

use App\Models\Editor;
use App\Models\EssayClients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Editors extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $editors->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-editor', ['editors' => $editors]);
    }

    public function detail($id, Request $request){
        $keyword1 = $request->get('keyword-ongoing');
        $keyword2 = $request->get('keyword-completed');
        $essay_ongoing = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '!=', 7)->when($keyword1, function ($query_) use ($keyword1) {
            $query_->where(function ($query) use ($keyword1) {
                $query->orWhereHas('client_by_id', function ($query_client) use ($keyword1) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword1) {
                    $query_program->where('program_name', 'like', '%'.$keyword1.'%');
                })->orWhereHas('status', function ($query_status) use ($keyword1) {
                    $query_status->where('status_title', 'like', '%'.$keyword1.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword1.'%');
            });
        })->paginate(5);
        $essay_completed = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '=', 7)->when($keyword2, function ($query_) use ($keyword2) {
            $query_->where(function ($query) use ($keyword2) {
                $query->orWhereHas('client_by_id', function ($query_client) use ($keyword2) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword2) {
                    $query_program->where('program_name', 'like', '%'.$keyword2.'%');
                })->orWhereHas('status', function ($query_status) use ($keyword2) {
                    $query_status->where('status_title', 'like', '%'.$keyword2.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword2.'%');
            });
        })->paginate(5);
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