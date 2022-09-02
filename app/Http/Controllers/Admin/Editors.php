<?php

namespace App\Http\Controllers\Admin;

use App\Models\Editor;
use App\Models\EssayClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Editors extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $editors->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-editor', ['editors' => $editors]);
    }

    public function detail($id){
        $essay_ongoing = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '!=', 7)->paginate(5);
        $essay_completed = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '=', 7)->paginate(5);
        return view('user.admin.users.user-editor-detail', [
            'editor' => Editor::find($id),
            'essay_ongoing' => $essay_ongoing,
            'essay_completed' => $essay_completed,
        ]);
    }
}
