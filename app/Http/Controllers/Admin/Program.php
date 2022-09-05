<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Program extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $programs = Programs::when($keyword, function($query) use ($keyword) {
            $query->where('program_name', 'like', '%'.$keyword.'%');
        })->orderBy('program_name', 'asc')->paginate(10);

        if ($keyword)
            $programs->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-programs', ['programs' => $programs]);
    }

    public function detail($id){
        return view('user.admin.settings.setting-detail-programs', ['program' => Programs::find($id)]);
    }

    public function store(Request $request)
    {
        $rules = [
            'program_name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable',
            'discount' => 'nullable',
            'minimum_word' => 'nullable',
            'maximum_word' => 'nullable',
            'completed_within' => 'nullable',
            'uploaded_file' => 'required|mimes:jpeg,jpg,png,bmp,webp|max:2048'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            
            $program_name = $request->program_name;

            $program = new Programs;
            $program->program_name = $request->program_name;
            $program->description = $request->description;
            $program->price = $request->price;
            $program->discount = $request->discount;
            $program->minimum_word = $request->minimum_word;
            $program->maximum_word = $request->maximum_word;
            $program->completed_within = $request->completed_within;
            $program->id_category = $request->id_category;
            $program->status = 1;

            if ($request->hasFile('uploaded_file')) {
                $file_name = str_replace(' ', '-', strtolower($program_name));
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('programs', $file_name.'.'.$file_format, ['disk' => 'public_assets']);

                $program->photo = $file_name.'.'.$file_format;
            }

            $program->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['msg' => 'Something went wrong when processing the data.']);
        }

        return redirect('admin/setting/programs/add')->with('add-program-successful', 'New Program has been added');
    }
}
