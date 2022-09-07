<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;

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

    public function detailEssayOngoing($id_essay, Request $request)
    {
        $editors = Editor::paginate(10);
        $essay = EssayClients::find($id_essay);
        if ($essay->status_essay_clients == 0) {
            return view('user.admin.essay-list.essay-ongoing-detail', [
                'ongoing' => EssayClients::find($id_essay),
                'editors' => $editors
            ]);
        } else if ($essay->status_essay_clients == 1) {
            return view('user.admin.essay-list.essay-ongoing-assign', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6) {
            return view('user.admin.essay-list.essay-ongoing-submitted', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 4) {
            return view('user.admin.essay-list.essay-ongoing-detail', [
                'ongoing' => EssayClients::find($id_essay),
                'editors' => $editors
            ]);
        }
    }

    public function assignEditor($id_essay, Request $request){
        // $rules = [
        //     'id_editors' => 'nullable'
        // ];
        // $validator = Validator::make($request->all() + ['id_essay_clients' => $id_essay], $rules);
        // if ($validator->fails()) {
        //     return Redirect::back()->withErrors($validator->messages());
        // }
        DB::beginTransaction();
        try {

            $essay = EssayClients::find($id_essay);
            $essay->id_editors = 2;
            $essay->status_essay_clients = 1;
            $essay->save();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/essay-list/ongoing');
    }

    public function cancel($id_essay){
        
        DB::beginTransaction();
        $essay = EssayClients::find($id_essay);
        $essay->status_essay_clients = 4;
        $essay->save();
        DB::commit();
        // try {

        //     $essay = EssayClients::find($id_essay);
        //     $essay->status_essay_clients = 4;
        //     $essay->save();
        //     DB::commit();

        // } catch (Exception $e) {

        //     DB::rollBack();
        //     return Redirect::back()->withErrors($e->getMessage());

        // }

        return redirect('admin/essay-list/ongoing/detail/'.$id_essay);
    }

    // Essay Completed
    public function essayCompleted(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayClients::with(['status', 'editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '=', 7)->when($keyword, function ($query_) use ($keyword) {
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
        
        return view('user.admin.essay-list.essay-completed', ['essays' => $essays]);
    }
    public function detailEssayCompleted($id){
        return view('user.admin.essay-list.essay-completed-detail', ['essay' => EssayClients::find($id)]);
    }
}
