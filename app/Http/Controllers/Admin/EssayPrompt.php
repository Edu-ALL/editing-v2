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

class EssayPrompt extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $essay_prompts = EssayPrompts::with('university')->when($keyword, function($query) use ($keyword) {
            $query->where('title', 'like', '%'.$keyword.'%')->
            orWhereHas('university', function ($querym) use ($keyword) {
                $querym->where('university_name', 'like', '%'.$keyword.'%');
            });
        })->orderBy('title', 'asc')->paginate(10);

        if ($keyword)
            $essay_prompts->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-essay-prompt', ['essay_prompts' => $essay_prompts]);
    }

    public function detail($id){
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

        } catch (Exception $e) {
            
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/setting/essay-prompt/add')->with('add-prompt-successful', 'The new Essay Prompt has been saved');
    }

    public function delete($prompt_id)
    {
        if (!$prompt = EssayPrompts::find($prompt_id)) {
            return Redirect::back()->withErrors("Couldn't find the Essay Prompt");
        }

        DB::beginTransaction();
        try {

            $prompt->delete();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/setting/essay-prompt')->with('delete-essay-prompt-successful', 'The Essay Prompt has been deleted');
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

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/setting/essay-prompt')->with('update-prompt-successful', 'The Essay Prompt has been updated');
    }
}
