<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Profile extends Controller
{
    public function index(){
        $editor = Auth::guard('web-editor')->user();
        return view('user.per-editor.profile.profile', [
            'editor' => $editor
        ]);
    }

    public function update($id_editors, Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'graduated_from' => 'nullable',
            'major' => 'nullable',
            'address' => 'nullable',
            'uploaded_file' => 'mimes:jpeg,jpg,png,bmp,webp|max:2048',
            'password' => 'nullable|confirmed|min:6',
        ];

        $validator = Validator::make($request->all() + ['id_editors' => $id_editors], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $old_editor = Editor::find($id_editors);
            $editor = $old_editor;
            $editor->first_name = $request->first_name;
            $editor->last_name = $request->last_name;
            $editor->phone = $request->phone;
            $editor->email = $request->email;
            $editor->graduated_from = $request->graduated_from;
            $editor->major = $request->major;
            $editor->address = $request->address;
            $editor->about_me = $request->about_me;
            if ($request->password != null) {
                $editor->password = Hash::make($request->password);
            }

            $name = $request->first_name;
            $time = time();
            if ($request->hasFile('uploaded_file')) {
                if ($old_image_path = $editor->image) {
                    if ($old_image_path != 'default.png') {
                        $file_path = 'user/editors/'.$old_image_path;
                        if (Storage::disk('s3')->exists($file_path)) {
                            Storage::disk('s3')->delete($file_path);
                        }
                    }
                }
                $file_name = str_replace(' ', '-', strtolower($name));
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                // $med_file_path = $request->file('uploaded_file')->storeAs('user/editors', $time.'-'.$file_name.'.'.$file_format, ['disk' => 'public_assets']);
                $med_file_path = 'project/essay-editing/user/editors' . $time .'-'. $file_name . '.' . $file_format;
                Storage::disk('s3')->put($med_file_path, file_get_contents($request->uploaded_file));

                $editor->image = $time.'-'.$file_name.'.'.$file_format;
            }

            $editor->save();
            DB::commit();

            Log::notice("Editor : " . $old_editor->first_name . " " . $old_editor->last_name . " profile data was change to " . $editor);
        } catch (Exception $e) {

            DB::rollBack();
            Log::error($e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());

        }
        return redirect('editors/profile')->with('update-profile-successful', 'Profile editor has been updated');
    }
}
