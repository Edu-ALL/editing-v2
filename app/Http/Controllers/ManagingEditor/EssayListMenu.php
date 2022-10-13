<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EssayListMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $editor = Auth::guard('web-editor')->user();
        $keyword1 = $request->get('keyword-ongoing');
        $keyword2 = $request->get('keyword-completed');
        $ongoing_essay = EssayClients::where('id_editors', '=', $editor->id_editors)->where('status_essay_clients', '!=', 7)->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 5)->when($keyword1, function ($query_) use ($keyword1) {
            $query_->where(function ($query) use ($keyword1) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword1) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword1) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword1) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword1) {
                    $query_program->where('program_name', 'like', '%'.$keyword1.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword1.'%')
                ->orWhereHas('status', function ($query_status) use ($keyword1) {
                    $query_status->where('status_title', 'like', '%'.$keyword1.'%');
                });
            });
        })->orderBy('uploaded_at', 'asc')->paginate(10);
        $completed_essay = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 7)->when($keyword2, function ($query_) use ($keyword2) {
            $query_->where(function ($query) use ($keyword2) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword2) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword2) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword2) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword2) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%');
                    })->orWhereHas('program', function ($query_program) use ($keyword2) {
                        $query_program->where('program_name', 'like', '%'.$keyword2.'%');
                    })->orWhere('essay_title', 'like', '%'.$keyword2.'%')
                    ->orWhereHas('status', function ($query_status) use ($keyword2) {
                        $query_status->where('status_title', 'like', '%'.$keyword2.'%');
                    });
                });
            });
        })->orderBy('read', 'asc')->orderBy('uploaded_at', 'desc')->paginate(10);

        return view('user.editor.essay-list.editor-essay-list', [
            'ongoing_essay' => $ongoing_essay,
            'completed_essay' => $completed_essay,
        ]);
    }

    public function essayDeadline($start, $num){
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+'.$start.' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+'.$num.' days', strtotime($today)));
        $editor = Auth::guard('web-editor')->user();
        $essay = EssayEditors::where('editors_mail', '=', $editor->email)->where('status_essay_editors', '!=', 0)->where('status_essay_editors', '!=', 4)->where('status_essay_editors', '!=', 5)->where('status_essay_editors', '!=', 7);
        $essay->whereHas('essay_clients', function ($query) use ($start, $dueDate) {
            $query->where('essay_deadline', '>', $start)->where('essay_deadline', '<=', $dueDate);
        });
        return $essay;
    }

    public function dueTomorrow(Request $request){
        $keyword = $request->get('keyword');
        $essays = $this->essayDeadline('0', '1')->paginate(10);
        return view('user.editor.essay-list.editor-list-due-tomorrow', ['essays' => $essays]);
    }
    public function dueThree(Request $request){
        $keyword = $request->get('keyword');
        $essays = $this->essayDeadline('1', '3')->paginate(10);
        return view('user.editor.essay-list.editor-list-due-within-three', ['essays' => $essays]);
    }
    public function dueFive(Request $request){
        $keyword = $request->get('keyword');
        $essays = $this->essayDeadline('3', '5')->paginate(10);
        return view('user.editor.essay-list.editor-list-due-within-five', ['essays' => $essays]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}