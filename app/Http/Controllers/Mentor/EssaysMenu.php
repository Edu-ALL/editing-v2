<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EssaysMenu extends Controller
{
    public function ongoingEssay(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');
        $essays = EssayClients::where('mentors_mail', '=', $mentor->email)->with(['status', 'editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '!=', 7)->when($keyword, function ($query_) use ($keyword) {
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
        })->orderBy('uploaded_at', 'desc')->paginate(10);
        
        // $essays = EssayClients::where('mentors_mail', '=', $mentor->email)->with(['status', 'editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '!=', 7)->paginate(10);
        // dd($essays);
        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        return view('user.mentor.essay-list-ongoing', ['essays' => $essays]);
    }

    public function completedEssay(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');

        $essays = EssayEditors::where('mentors_mail', '=', $mentor->email)->where('status_essay_editors', 7)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%'.$keyword.'%');
                    })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                    ->orWhereHas('status', function ($query_status) use ($keyword) {
                        $query_status->where('status_title', 'like', '%'.$keyword.'%');
                    });
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);


        // $essays = EssayClients::where('mentors_mail', '=', $mentor->email)->with(['status', 'editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '=', 7)->paginate(10);
// dd($essays);
        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        return view('user.mentor.essay-completed', ['essays' => $essays]);
    }


    
    public function detailOngoingEssay($id)
    {
        $essay = EssayClients::find($id);
        
        return view('user.mentor.essay-list-ongoing-detail', [
            'essay' => $essay
        ]);
        
    }

}