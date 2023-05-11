<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Programs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class Program extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $programs = Programs::when($keyword, function ($query) use ($keyword) {
            $query->where('program_name', 'like', '%' . $keyword . '%');
        })->orderBy('program_name', 'asc')->paginate(10);

        if ($keyword)
            $programs->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-programs', ['programs' => $programs]);
    }

    public function getPrograms(Request $request)
    {
        if ($request->ajax()) {
            $data = Programs::orderBy('program_name', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('program_name', function ($program) {
                    $result = $program->program_name;
                    return $result;
                })
                ->editColumn('description', function ($program) {
                    $result = $program->description;
                    return $result;
                })
                ->editColumn('price', function ($program) {
                    $result = $program->price;
                    return $result;
                })
                ->editColumn('maximum_word', function ($program) {
                    $result = $program->maximum_word;
                    return $result;
                })
                ->editColumn('completed_within', function ($program) {
                    $result = $program->completed_within;
                    return $result;
                })
                ->editColumn('image', function ($program) {
                    if ($program->images) {
                        $result = '<img src="' .
                            (asset('uploaded_files/univ/' . $program->images)) .
                            '" alt="' . ($program->images) . '" style="max-width:50px;" />';
                    } else {
                        $result = '<img src="' .
                            (asset('uploaded_files/univ/default.png')) .
                            '" alt="' . ($program->images) . '" style="max-width:50px;" />';
                    }
                    return $result;
                })
                ->rawColumns(['program_name', 'description', 'price', 'maximum_word', 'completed_within', 'image'])
                ->make();
        }
    }

    public function detail($id)
    {
        $category = Category::get();
        return view('user.admin.settings.setting-detail-programs', [
            'program' => Programs::find($id),
            'category' => $category
        ]);
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
            $program->program_name = $program_name;
            $program->description = $request->description;
            $program->price = $request->price;
            $program->discount = $request->discount;
            $program->minimum_word = $request->minimum_word;
            $program->maximum_word = $request->maximum_word;
            $program->completed_within = $request->completed_within;
            $program->id_category = $request->id_category;
            $program->status = 1;

            $time = time();
            if ($request->hasFile('uploaded_file')) {
                $file_name = str_replace(' ', '-', strtolower($program_name));
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('programs', $time . '-' . $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $program->images = $time . '-' . $file_name . '.' . $file_format;
            }

            $program->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['msg' => 'Something went wrong when processing the data.']);
        }

        return redirect('admin/setting/programs')->with('add-program-successful', 'New Program has been added');
    }

    public function update($id_program, Request $request)
    {
        if (!$program = Programs::find($id_program)) {
            return Redirect::back()->withErrors(['msg' => 'Couldn\'t find the program']);
        }

        $program_name = $request->program_name;

        $program->program_name = $program_name;
        $program->description = $request->description;
        $program->price = $request->price;
        $program->discount = $request->discount;
        $program->minimum_word = $request->minimum_word;
        $program->maximum_word = $request->maximum_word;
        $program->completed_within = $request->completed_within;
        $program->id_category = $request->id_category;
        $program->status = 1;

        $time = time();
        if ($request->hasFile('uploaded_file')) {
            if ($old_image_path = $program->images) {
                $file_path = public_path('uploaded_files/programs/' . $old_image_path);
                if (File::exists($file_path)) {
                    File::delete($file_path);
                }
            }
            $file_name = str_replace(' ', '-', strtolower($program_name));
            $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
            $med_file_path = $request->file('uploaded_file')->storeAs('programs', $time . '-' . $file_name . '.' . $file_format, ['disk' => 'public_assets']);

            $program->images = $time . '-' . $file_name . '.' . $file_format;
        }
        $program->save();

        return redirect('admin/setting/programs/detail/' . $id_program)->with('update-program-successful', 'The Program has been updated');
    }

    public function delete($id_program, Request $request)
    {
        if (!$program = Programs::find($id_program)) {
            return Redirect::back()->withErrors(['success' => false, 'message' => 'Couldn\'t find the program']);
        }

        //! tambahin hapus file sebelum delete data
        if ($old_image_path = $program->images) {
            $file_path = public_path('uploaded_files/programs/' . $old_image_path);
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $program->delete();
        return redirect(route('list-program'))->with('delete-program-successful', 'The program has been deleted');
    }
}
