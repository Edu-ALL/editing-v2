<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class Universities extends Controller
{
    public function getUniversity(Request $request)
    {
        if ($request->ajax()) {
            $data = University::orderBy('university_name', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'onclick' => function($d) {
                    return 'getUniversityDetail('.$d->id_univ.')';
                },
            ])
            ->editColumn('image', function($d){
                if ($d->photo) {
                    $path = asset('uploaded_files/univ/'.$d->photo);
                } else {
                    $path = asset('uploaded_files/univ/default.png');
                }
                $result = '
                    <img src="'.$path.'" alt="'.$d->photo.'" style="max-width:50px;" />
                ';
                return $result;
            })
            ->rawColumns(['image'])
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        return view('user.editor.settings.setting-universities');
    }

    public function detail($id){
        $university = University::find($id);
        if ($university) {
            return view('user.editor.settings.setting-detail-universities', ['university' => $university]);
        } else {
            return abort(404);
            // return redirect('editor/setting/universities')->with('isUniv', 'University not found');
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'university_name' => 'required|max:255|unique:tbl_universities,university_name',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'phone' => 'nullable',
            'country' => 'required',
            'address' => 'nullable',
            'uploaded_file' => 'required|mimes:jpeg,jpg,png,bmp,webp|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $university_name = $request->university_name;

            $university = new University;
            $university->university_name = $university_name;
            $university->website = $request->website;
            $university->univ_email = $request->email;
            $university->phone = $request->phone;
            $university->address = $request->address;
            $university->country = $request->country;
            $university->status = 1;

            if ($request->hasFile('uploaded_file')) {
                $file_name = str_replace(' ', '-', strtolower($university_name));
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('univ', $file_name.'.'.$file_format, ['disk' => 'public_assets']);

                $university->photo = $file_name.'.'.$file_format;
            }

            $university->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['msg' => 'Something went wrong when processing the data.']);
        }

        return redirect('editor/setting/universities')->with('input-successful', 'New university has been added');
    }

    public function update($id_univ, Request $request)
    {
        if (!$university = University::find($id_univ)) {
            return Redirect::back()->withErrors(['msg' => 'Couldn\'t find the university']);
        }
        $university_name = $request->university_name;
        
        $university->university_name = $university_name;
        $university->website = $request->website;
        $university->univ_email = $request->email;
        $university->phone = $request->phone;
        $university->address = $request->address;
        $university->country = $request->country;

        if ($request->hasFile('uploaded_file')) {
            if ($old_image_path = $university->photo) {
                $file_path = public_path('uploaded_files/univ/'.$old_image_path);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
            $file_name = str_replace(' ', '-', strtolower($university_name));
            $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
            $med_file_path = $request->file('uploaded_file')->storeAs('univ', $file_name.'.'.$file_format, ['disk' => 'public_assets']);

            $university->photo = $file_name.'.'.$file_format;
        }
        $university->save();

        return redirect('editor/setting/universities/detail/'.$id_univ)->with('update-successful', 'The university has been updated');
    }

    public function delete($id_univ, Request $request)
    {
        if (!$university = University::find($id_univ)) {
            return Redirect::back()->withErrors(['success' => false, 'message' => 'Couldn\'t find the university']);
        }

        //! tambahin hapus file sebelum delete data
        if ($old_image_path = $university->photo) {
            $file_path = public_path('uploaded_files/univ/'.$old_image_path);
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $university->delete();
        return redirect(route('list-university'))->with('delete-successful', 'The university has been deleted');
    }
}
