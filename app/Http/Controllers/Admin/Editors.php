<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Editors extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $editors->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-editor', ['editors' => $editors]);
    }

    public function detail($id){
        return view('user.admin.users.user-editor-detail', ['editor' => Editor::find($id)]);
    }
}
