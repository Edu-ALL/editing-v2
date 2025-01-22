<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Universities extends Controller
{
    public function index()
    {
        return view('user.admin.settings.setting-universities');
    }

    public function getUniversities(Request $request)
    {
        if ($request->ajax()) {
            $data = University::orderBy('university_name', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('university_name', function ($university) {
                    $result = $university->university_name;
                    return $result;
                })
                ->editColumn('website', function ($university) {
                    $result = $university->website;
                    return $result;
                })
                ->editColumn('country', function ($university) {
                    $result = $university->country;
                    return $result;
                })
                ->editColumn('phone', function ($university) {
                    $result = $university->phone;
                    return $result;
                })
                ->editColumn('address', function ($university) {
                    $result = $university->address;
                    return $result;
                })
                ->editColumn('image', function ($university) {
                    if ($university->photo) {
                        $result = '<img src="' .
                            (Storage::url('univ/' . $university->photo)) .
                            '" alt="' . ($university->photo) . '" style="max-width:50px;" />';
                    } else {
                        $result = '<img src="' .
                            (Storage::url('univ/default.png')) .
                            '" alt="' . ($university->photo) . '" style="max-width:50px;" />';
                    }

                    return $result;
                })
                ->rawColumns(['university_name', 'website', 'country', 'phone', 'address', 'image'])
                ->make();
        }
    }

    public function detail($id)
    {
        if (!University::find($id)) {
            return abort(404);
        }
        return view('user.admin.settings.setting-detail-universities', ['university' => University::find($id)]);
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
                // $med_file_path = $request->file('uploaded_file')->storeAs('univ', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $med_file_path = 'project/essay-editing/univ/' . $file_name . '.' . $file_format;
                Storage::disk('s3')->put($med_file_path, file_get_contents($request->uploaded_file));


                $university->photo = $file_name . '.' . $file_format;
            }

            $university->save();
            DB::commit();
            Log::notice($university->university_name.' has been successfully added');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Store University failed : '.$e->getMessage());
            return Redirect::back()->withErrors(['msg' => 'Something went wrong when processing the data.']);
        }
        return redirect('admin/setting/universities/add')->with('input-successful', 'New university has been added');
    }

    public function update($id_univ, Request $request)
    {
        if (!$university = University::find($id_univ)) {
            return Redirect::back()->withErrors(['msg' => 'Couldn\'t find the university']);
        }

        $rules = [
            'university_name' => 'required|max:255',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'phone' => 'nullable',
            'country' => 'nullable',
            'address' => 'nullable',
            'uploaded_file' => 'nullable|mimes:jpeg,jpg,png,bmp,webp|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $university_name = $request->university_name;

            $university->university_name = $university_name;
            $university->website = $request->website;
            $university->univ_email = $request->email;
            $university->phone = $request->phone;
            $university->address = $request->address;
            $university->country = $request->country;

            if ($request->hasFile('uploaded_file')) {
                if ($old_image_path = $university->photo) {
                    $file_path = 'univ/' . $old_image_path;
                    if (Storage::disk('s3')->exists($file_path)) {
                        Storage::disk('s3')->delete($file_path);
                    }
                }
                $file_name = str_replace(' ', '-', strtolower($university_name));
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                // $med_file_path = $request->file('uploaded_file')->storeAs('univ', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
    
                $med_file_path = 'project/essay-editing/univ/' . $file_name . '.' . $file_format;
                Storage::disk('s3')->put($med_file_path, file_get_contents($request->uploaded_file));

                $university->photo = $file_name . '.' . $file_format;
            }

            $university->save();
            DB::commit();
            Log::notice($university->university_name.' has been successfully updated');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Update University failed : '.$e->getMessage());
            return Redirect::back()->withErrors(['msg' => 'Something went wrong when processing the data.']);
        }
        return redirect('admin/setting/universities/detail/' . $id_univ)->with('update-successful', 'The university has been updated');
    }

    public function delete($id_univ, Request $request)
    {
        if (!$university = University::find($id_univ)) {
            return Redirect::back()->withErrors(['success' => false, 'message' => 'Couldn\'t find the university']);
        }
        $university_name = $university->university_name;

        //! tambahin hapus file sebelum delete data
        if ($old_image_path = $university->photo) {
            $file_path = 'univ/' . $old_image_path;
            if (Storage::disk('s3')->exists($file_path)) {
                Storage::disk('s3')->delete($file_path);
            }
        }
        $university->delete();
        Log::notice($university_name.' has been successfully deleted');
        return redirect(route('list-university'))->with('delete-successful', 'The university has been deleted');
    }
}
