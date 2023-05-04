<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayFeedbacks;
use App\Models\EssayRevise;
use App\Models\EssayStatus;
use App\Models\EssayTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class Essays extends Controller
{
    public function index(Request $request)
    {
        return view('user.admin.essay-list.essay-ongoing');
    }

    public function getEssayOngoing(Request $request)
    {
        if ($request->ajax()) {
            $data = EssayClients::with(['status', 'mentor', 'editor', 'essay_editors.editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '!=', 7)->orderBy('essay_deadline', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($essay) {
                    $result = isset($essay->client_by_id) ? $essay->client_by_id->first_name . ' ' . $essay->client_by_id->last_name : $essay->client_by_email->first_name . ' ' . $essay->client_by_email->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($essay) {
                    $result = isset($essay->mentor) ? $essay->mentor->first_name . ' ' . $essay->mentor->last_name : '-';
                    return $result;
                })
                ->editColumn('editor_name', function ($essay) {
                    if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5) {
                        $result = '-';
                    } else {
                        $result = $essay->essay_editors->editor->first_name . ' ' . $essay->essay_editors->editor->last_name;
                    }

                    return $result;
                })
                ->editColumn('essay_title', function ($essay) {
                    $result = $essay->essay_title;
                    return $result;
                })
                ->editColumn('essay_deadline', function ($essay) {
                    $result = date('D, d M Y', strtotime($essay->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($essay) {
                    $result = '<div style="color: var(--red)">' . (isset($essay->status) ? $essay->status->status_title : null) . '</div>';
                    return $result;
                })
                ->rawColumns(['student_name', 'mentor_name', 'editor_name', 'essay_title', 'essay_deadline', 'status'])
                ->make();
        }
    }

    public function detailEssayOngoing($id_essay, Request $request)
    {
        $essay = EssayClients::find($id_essay);
        if ($essay) {
            $editors = Editor::paginate(10);
            $essay = EssayClients::find($id_essay);

            if ($essay->status_read_editor == 0) {
                DB::beginTransaction();
                $essay->status_read_editor = 1;
                $essay->save();
                DB::commit();
            }

            if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5) {
                return view('user.admin.essay-list.essay-ongoing-detail', [
                    'ongoing' => $essay,
                    'editors' => $editors
                ]);
            } else if ($essay->status_essay_clients == 1 || $essay->status_essay_clients == 2) {
                return view('user.admin.essay-list.essay-ongoing-assign', [
                    'essay' => $essay
                ]);
            } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8) {
                return view('user.admin.essay-list.essay-ongoing-submitted', [
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            }
        } else {
            return redirect('admin/essay-list/ongoing')->with('isEssay', 'Essay not found');
        }
    }

    public function assignEditor($id_essay, Request $request)
    {
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

    public function cancel($id_essay)
    {
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
        return redirect('admin/essay-list/ongoing/detail/' . $id_essay);
    }

    // public function verifyEssay($id_essay, Request $request){
    //     DB::beginTransaction();
    //     try {
    //         $essay = EssayClients::find($id_essay);
    //         $essay->status_essay_clients = 7;
    //         $essay->completed_at = date('Y-m-d H:i:s');
    //         $essay->save();

    //         $essay_status = new EssayStatus;
    //         $essay_status->id_essay_clients = $essay->id_essay_clients;
    //         $essay_status->status = 7;
    //         $essay_status->save();

    //         $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
    //         $essay_editor->status_essay_editors = 7;
    //         $essay_editor->save();

    //         DB::commit();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Redirect::back()->withErrors($e->getMessage());
    //     }
    //     return redirect('admin/essay-list/completed');
    // }

    // public function reviseEssay($id_essay, Request $request){
    //     DB::beginTransaction();
    //     try {
    //         $essay = EssayClients::find($id_essay);
    //         $essay->status_essay_clients = 6;
    //         $essay->save();

    //         $essay_status = new EssayStatus;
    //         $essay_status->id_essay_clients = $essay->id_essay_clients;
    //         $essay_status->status = 6;
    //         $essay_status->save();

    //         $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
    //         $essay_editor->status_essay_editors = 6;
    //         $essay_editor->notes_editors = $request->notes;
    //         $essay_editor->save();

    //         $essay_revise = new EssayRevise;
    //         $essay_revise->id_essay_clients = $id_essay;
    //         $essay_revise->editors_mail = $essay_editor->editors_mail;
    //         $essay_revise->admin_mail = $essay_editor->editors_mail;
    //         dd($essay_revise->editors_mail);
    //         $essay_revise->save();

    //         DB::commit();
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return Redirect::back()->withErrors($e->getMessage());
    //     }
    //     return redirect('admin/essay-list/ongoing/detail/'.$id_essay);
    // }

    // Essay Completed
    public function essayCompleted(Request $request)
    {
        return view('user.admin.essay-list.essay-completed');
    }


    public function getEssayCompleted(Request $request)
    {
        if ($request->ajax()) {

            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')
                ->with(['status', 'essay_clients.mentor', 'editor', 'essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.client_by_id.mentors', 'essay_clients.client_by_email.mentors'])
                ->where('status_essay_editors', 7)
                ->orderBy('essay_deadline', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($essay) {
                    $result = isset($essay->essay_clients->client_by_id) ? $essay->essay_clients->client_by_id->first_name . ' ' . $essay->essay_clients->client_by_id->last_name : $essay->essay_clients->client_by_email->first_name . ' ' . $essay->essay_clients->client_by_email->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($essay) {
                    $result = $essay->essay_clients->mentor->first_name . ' ' . $essay->essay_clients->mentor->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($essay) {
                    $result = $essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('essay_title', function ($essay) {
                    $result = $essay->essay_clients->essay_title;
                    return $result;
                })
                ->editColumn('essay_deadline', function ($essay) {
                    $result = date('D, d M Y', strtotime($essay->essay_clients->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($essay) {
                    $result = '<div style="color: var(--green)">' . ($essay->status->status_title) . '</div>';
                    return $result;
                })
                ->rawColumns(['student_name', 'mentor_name', 'editor_name', 'essay_title', 'essay_deadline', 'status'])
                ->make();
        }
    }

    public function detailEssayCompleted($id)
    {
        $essay = EssayEditors::where('id_essay_clients', $id)->first();
        if ($essay) {
            $essay = EssayEditors::where('id_essay_clients', $id)->first();
            $essay_client = EssayClients::where('id_essay_clients', $id)->first();
            if ($essay_client->essay_deadline > $essay->uploaded_at) {
                $status_essay = 'On Time';
            } else {
                $status_essay = 'Late';
            }

            return view('user.admin.essay-list.essay-completed-detail', [
                'essay' => $essay,
                'tags' => EssayTags::where('id_essay_clients', $id)->get(),
                'feedback' => EssayFeedbacks::where('id_essay_clients', $id)->first(),
                'status_essay' => $status_essay
            ]);
        } else {
            return redirect('admin/essay-list/completed')->with('isEssay', 'Essay not found');
        }
    }
}
