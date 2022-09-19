<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayStatus;
use Illuminate\Http\Request;
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
        if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5) {
            return view('user.admin.essay-list.essay-ongoing-detail', [
                'ongoing' => EssayClients::find($id_essay),
                'editors' => $editors
            ]);
        } else if ($essay->status_essay_clients == 1) {
            return view('user.admin.essay-list.essay-ongoing-assign', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 2) {
            return view('user.admin.essay-list.essay-ongoing-ongoing', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6) {
            return view('user.admin.essay-list.essay-ongoing-submitted', [
                'essay' => EssayClients::find($id_essay)
            ]);
        }
    }

    public function assignEditor($id_essay, Request $request){
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->id_editors = $request->id_editors;
            $essay->status_essay_clients = 1;
            $essay->save();

            $essay_editor = new EssayEditors;
            $essay_editor->id_essay_clients = $essay->id_essay_clients;
            $essay_editor->editors_mail = $essay->editor->email;
            $essay_editor->status_essay_editors = 1;
            $essay_editor->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 1;
            $essay_status->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json($e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/essay-list/ongoing');
    }

    public function cancel($id_essay){
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 4;
            $essay->save();
            
            EssayEditors::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 4;
            $essay_status->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/essay-list/ongoing/detail/'.$id_essay);
    }

    public function verifyEssay($id_essay, Request $request){
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 7;
            $essay->completed_at = date('Y-m-d H:i:s');
            $essay->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 7;
            $essay_status->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 7;
            $essay_editor->notes_editors = $request->notes;
            $essay_editor->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/essay-list/completed');
    }

    public function reviseEssay($id_essay, Request $request){
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 6;
            $essay->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 6;
            $essay_status->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 6;
            // $essay_editor->notes_editors = $request->notes;
            // dd($essay->status_essay_clients);
            $essay_editor->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
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