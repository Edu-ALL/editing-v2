<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EssayPrompts;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class EssayPrompt extends Controller
{
    public function index()
    {
        return view('user.admin.settings.setting-essay-prompt');
    }

    public function getEssayPrompt(Request $request)
    {
        if ($request->ajax()) {
            $data = EssayPrompts::with('university')->orderBy('title', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('title', function ($essay_prompt) {
                    $result = $essay_prompt->title ?? "-";
                    return $result;
                })
                ->editColumn('university_name', function ($essay_prompt) {
                    $result = $essay_prompt->university->university_name ?? "-";
                    return $result;
                })
                ->editColumn('description', function ($essay_prompt) {
                    $result = $essay_prompt->description ?? "-";
                    return $result;
                })
                ->rawColumns(['title', 'university_name', 'description'])
                ->make();
        }
    }

    public function detail($id)
    {
        if (!EssayPrompts::find($id)) {
            return abort(404);
        }
        $univ = University::get();
        return view('user.admin.settings.setting-detail-essay-prompt', [
            'essay_prompt' => EssayPrompts::find($id),
            'univ' => $univ
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:150',
            'description' => 'nullable',
            'notes' => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $new_prompt = new EssayPrompts;
            $new_prompt->title = $request->title;
            $new_prompt->description = $request->description;
            $new_prompt->notes = $request->notes;
            $new_prompt->id_univ = $request->id_univ;
            $new_prompt->status = 1;
            $new_prompt->save();
            DB::commit();
            Log::notice('Essay prompt : '.$new_prompt->title.' has been successfully created');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Store Essay Prompt failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('admin/setting/essay-prompt')->with('add-prompt-successful', 'The new Essay Prompt has been saved');
    }

    public function delete($prompt_id)
    {
        if (!$prompt = EssayPrompts::find($prompt_id)) {
            return Redirect::back()->withErrors("Couldn't find the Essay Prompt");
        }
        $essay_prompt_title = $prompt->title;

        DB::beginTransaction();
        try {
            $prompt->delete();
            DB::commit();
            Log::notice('Essay prompt : '.$essay_prompt_title.' has been successfully deleted');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Delete Essay Prompt failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/setting/essay-prompt')->with('delete-prompt-successful', 'The Essay Prompt has been deleted');
    }

    public function update($prompt_id, Request $request)
    {
        $rules = [
            'title' => 'required|max:150',
            'description' => 'nullable',
            'notes' => 'nullable',
        ];

        $validator = Validator::make($request->all() + ['id_essay_prompt' => $prompt_id], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $prompt = EssayPrompts::find($prompt_id);
            $prompt->title = $request->title;
            $prompt->description = $request->description;
            $prompt->notes = $request->notes;
            $prompt->id_univ = $request->id_univ;
            $prompt->status = 1;
            $prompt->save();
            DB::commit();
            Log::notice('Essay prompt : '.$prompt->title.' has been successfully updated');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Update Essay Prompt failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/setting/essay-prompt/detail/' . $prompt_id)->with('update-prompt-successful', 'The Essay Prompt has been updated');
    }
}
