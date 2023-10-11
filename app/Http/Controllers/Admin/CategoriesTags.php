<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CategoriesTags extends Controller
{

    public function delete($tag_id)
    {
        if (!$tag = Tags::find($tag_id)) {
            return Redirect::back()->withErrors("Couldn't find the tag");
        }
        $tag_name = $tag->topic_name;

        DB::beginTransaction();
        try {
            $tag->delete();
            DB::commit();
            Log::notice('Categories/Tags : '.$tag_name.' has been successfully deleted');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Delete Categories/Tags failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('admin/setting/categories-tags')->with('delete-tag-successful', 'The tag has been deleted');
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
            Log::notice('Categories/Tags : '.$tag->topic_name.' has been successfully updated');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Update Categories/Tags failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('admin/setting/categories-tags')->with('update-tag-successful', 'The tag has been updated');
    }

    public function detail($tag_id, Request $request)
    {
        if (!$tag = Tags::find($tag_id)) {
            return abort(404);
            // return redirect('admin/setting/categories-tags')->withErrors('Couldn\'t find the tag');
        }

        $keyword = $request->get('keyword');
        $tags = Tags::orderBy('topic_name', 'asc')->when($keyword, function ($query) use ($keyword) {
            $query->where('topic_name', 'like', '%' . $keyword . '%');
        })->paginate(10);

        if ($keyword)
            $tags->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-detail-categories', ['tag' => $tag, 'tags' => $tags]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:150'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $new_tag = new Tags;
            $new_tag->topic_name = $request->title;
            $new_tag->save();
            DB::commit();
            Log::notice('Categories/Tags : '.$new_tag->topic_name.' has been successfully created');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Store Categories/Tags failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('admin/setting/categories-tags')->with('add-tag-successful', 'The new tag has been saved');
    }

    public function index()
    {
        return view('user.admin.settings.setting-categories');
    }

    public function getCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = Tags::orderBy('topic_name', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category_name', function ($tag) {
                    $result = $tag->topic_name;
                    return $result;
                })
                ->make();
        }
    }
}
