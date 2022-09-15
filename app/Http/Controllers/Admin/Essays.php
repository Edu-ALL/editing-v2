<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use Illuminate\Support\Facades\DB;

class Essays extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayClients::with(['status', 'editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '!=', 7)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('client_by_email', function ($query_by_email) use ($keyword) {
                    $query_by_email->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor_by_email) use ($keyword) {
                        $query_mentor_by_email->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        return view('user.admin.essay-list.essay-ongoing', ['essays' => $essays]);
    }
}