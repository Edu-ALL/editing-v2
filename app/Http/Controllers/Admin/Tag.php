<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;

class Tag extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $tags = Tags::when($keyword, function($query) use ($keyword) {
            $query->where('topic_name', 'like', '%'.$keyword.'%');
        })->orderBy('topic_name', 'asc')->paginate(10);

        if ($keyword)
            $tags->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-categories', ['tags' => $tags]);
    }

    public function detail($id, Request $request){
        $keyword = $request->get('keyword');
        $tags = Tags::when($keyword, function($query) use ($keyword) {
            $query->where('topic_name', 'like', '%'.$keyword.'%');
        })->orderBy('topic_name', 'asc')->paginate(10);

        if ($keyword)
            $tags->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-detail-categories', ['tag' => Tags::find($id), 'tags' => $tags]);
    }

    public function store(Request $request){
        $rules = [
            'topic_name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $tag = new Tag;
            $tag->topic_name = $request->topic_name;

            $tag->save();
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors(['msg' => 'Something went wrong when processing the data.']);
        }

        return redirect('/admin/setting/categories-tags')->with('input-successful', 'New Tag has been added');
    }
}
