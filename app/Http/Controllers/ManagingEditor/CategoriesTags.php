<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CategoriesTags extends Controller
{
    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Tags::orderBy('topic_name', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'onclick' => function($d) {
                    return 'getCategoriesDetail('.$d->id_topic.')';
                },
            ])
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        return view('user.editor.settings.setting-categories');
    }

    public function detail($tag_id, Request $request)
    {
        if (!$tag = Tags::find($tag_id)) {
            return abort(404);
            // return redirect('editor/setting/categories-tags')->with('isTag', 'Categories / Tags not found');
        }

        $keyword = $request->get('keyword');
        $tags = Tags::orderBy('topic_name', 'asc')->when($keyword, function($query) use ($keyword) {
            $query->where('topic_name', 'like', '%'.$keyword.'%');
        })->paginate(10);

        if ($keyword)
            $tags->appends(['keyword' => $keyword]);

        return view('user.editor.settings.setting-detail-categories', ['tag' => $tag, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $new_tag = new Tags;
            $new_tag->topic_name = $request->title;
            $new_tag->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('editor/setting/categories-tags')->with('add-tag-successful', 'The new tag has been saved');
    }

    public function delete($tag_id)
    {
        if (!$tag = Tags::find($tag_id)) {
            return Redirect::back()->withErrors("Couldn't find the tag");
        }

        DB::beginTransaction();
        try {
            $tag->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('editor/setting/categories-tags')->with('delete-tag-successful', 'The tag has been deleted');
    }

    public function update($tag_id, Request $request)
    {
        $rules = [
            'id_topic' => 'required|exists:tbl_tags,id_topic',
            'title' => 'required'
        ];

        $validator = Validator::make($request->all() + ['id_topic' => $tag_id], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $tag = Tags::find($tag_id);
            $tag->topic_name = $request->title;
            $tag->save();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('editor/setting/categories-tags')->with('update-tag-successful', 'The tag has been updated');
    }
}