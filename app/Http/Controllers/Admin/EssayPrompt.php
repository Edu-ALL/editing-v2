<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EssayPrompts;
use Illuminate\Http\Request;

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
        return view('user.admin.settings.setting-detail-essay-prompt', ['essay_prompt' => EssayPrompts::find($id)]);
    }
}
