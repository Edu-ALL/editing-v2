<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayFeedbacks;
use App\Models\EssayTags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Exception;

class EssaysMenu extends Controller
{
    public function ongoingEssay(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');

        $essays = EssayClients::where('status_essay_clients', '!=', 7)->
        whereHas('client_by_id', function ($query) use ($mentor) {
            $query->where('id_mentor', $mentor->id_mentors);
        })->when($keyword, function ($query) use ($keyword) {
            $query->where(function($query1) use ($keyword) {
                $query1->whereHas('client_by_id', function ($query_client) use ($keyword) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')
                    ->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                        $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                ->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);
        
        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
            
        return view('user.mentor.essay-ongoing', ['essays' => $essays]);
    }

    public function completedEssay(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');

        $essays = EssayEditors::where('status_essay_editors', 7)
        ->whereHas('essay_clients', function ($query) use ($mentor) {
            $query->whereHas('client_by_id', function ($query) use ($mentor) {
                $query->where('id_mentor', $mentor->id_mentors);
            });
        })->when($keyword, function ($query) use ($keyword) {
            $query->whereHas('essay_clients', function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query) use ($keyword) {
                    $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')
                    ->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                        $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                ->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);

        return view('user.mentor.essay-completed', ['essays' => $essays]);
    }


    
    public function detailOngoingEssay($id)
    {
        if (!$essay = EssayClients::find($id)) {
            return Redirect::to('mentor/essay-list/ongoing');
        }
        
        return view('user.mentor.essay-list-ongoing-detail', [
            'essay' => $essay
        ]);
        
    }

    public function detailCompletedEssay($id)
    {

        if (!$essay = EssayEditors::where('id_essay_clients', $id)->first()) {
            return Redirect::to('mentor/essay-list/completed');
        }
        
        $essay_client = EssayClients::where('id_essay_clients', $id)->first();
        if ($essay_client->essay_deadline > $essay->uploaded_at) {
            $status_essay = 'On Time';
        } else {
            $status_essay = 'Late';
        }
        
        return view('user.mentor.essay-list-completed-detail', [
            'essay' => $essay,
            'tags' => EssayTags::where('id_essay_clients', $id)->get(),
            'feedback' => EssayFeedbacks::where('id_essay_clients', $id)->first(),
            'status_essay' => $status_essay
        ]);
        
    }

    public function deletEssay($id)
    {
        // $essay = EssayClients::find($id);
        // $delete = EssayEditors::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();

        // $fileName = $request->attached_of_clients->getClientOriginalName();
        // $filePath = 'uploads/essay/mentor/'.$fileName;
        // Storage::disk('public')->put($filePath, file_get_contents($request->attached_of_clients));

        $essay = EssayClients::find($id);
        
        $file_path = app_path("uploaded_files/program/essay/mentors/{$essay->attached_of_clients}");
        
        // dd($essay);
        if (File::exists($file_path)) {
            //File::delete($file_path);
            File::delete($file_path);
        }
        // EssayClients::where($id)->delete();
        $essay->delete();
        
        return redirect('mentor/essay-list/ongoing')->with('delete-essay-successful', 'Essay has been deleted');
        
    }

    public function feedback(Request $request, $id)
    {
        $rate_1 = $request->rating_1;
        $rate_2 = $request->rating_2;
        $rate_3 = $request->rating_3;
        $rate_4 = $request->rating_4;
        $rate_5 = $request->rating_5;
        $rate_6 = $request->rating_6;

        DB::beginTransaction();
        try {
            $essay_feedback = new EssayFeedbacks;
            $essay_feedback->id_essay_clients = $id;
            $essay_feedback->option1 = $rate_1;
            $essay_feedback->option2 = $rate_2;
            $essay_feedback->option3 = $rate_3;
            $essay_feedback->option4 = $rate_4;
            $essay_feedback->option5 = $rate_5;
            $essay_feedback->option6 = $rate_6;
            $essay_feedback->add_comments = $request->comment;
            $essay_feedback->save();

            $essay = EssayClients::find($id);
            $essay->essay_rating = ($rate_1 + $rate_2 + $rate_3 + $rate_4 + $rate_5 + $rate_6)/6;
            $essay->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('mentor/essay-list/completed/detail/'.$id);
    }
}