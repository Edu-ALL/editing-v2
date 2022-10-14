<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllEditorMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $editors->appends(['keyword' => $keyword]);

        $dueTomorrow = $this->dueEssay('0', '1');
        $dueThree = $this->dueEssay('1', '3');
        $dueFive = $this->dueEssay('3', '5');

        return view('user.editor.editor-list.editor-list', [
            'editors' => $editors,
            'dueTomorrow' => $dueTomorrow,
            'dueThree' => $dueThree,
            'dueFive' => $dueFive,
        ]);
    }

    public function dueEssay($start, $num){
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+'.$start.' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+'.$num.' days', strtotime($today)));
        $essay = EssayClients::where('status_essay_clients', '!=', 7);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay->get();
    }

    public function detail($id, Request $request){
        $keyword1 = $request->get('keyword-ongoing');
        $keyword2 = $request->get('keyword-completed');
        $essay_ongoing = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '!=', 7)->when($keyword1, function ($query_) use ($keyword1) {
            $query_->where(function ($query) use ($keyword1) {
                $query->orWhereHas('client_by_id', function ($query_client) use ($keyword1) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword1) {
                    $query_program->where('program_name', 'like', '%'.$keyword1.'%');
                })->orWhereHas('status', function ($query_status) use ($keyword1) {
                    $query_status->where('status_title', 'like', '%'.$keyword1.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword1.'%');
            });
        })->paginate(5);
        $essay_completed = EssayClients::with('client_by_id', 'program')->where('id_editors', '=', $id)->where('status_essay_clients', '=', 7)->when($keyword2, function ($query_) use ($keyword2) {
            $query_->where(function ($query) use ($keyword2) {
                $query->orWhereHas('client_by_id', function ($query_client) use ($keyword2) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword2) {
                    $query_program->where('program_name', 'like', '%'.$keyword2.'%');
                })->orWhereHas('status', function ($query_status) use ($keyword2) {
                    $query_status->where('status_title', 'like', '%'.$keyword2.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword2.'%');
            });
        })->paginate(5);

        $editor = Editor::find($id);
        $count_essay = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', '=', 'tbl_essay_editors.id_essay_clients')->where('editors_mail', $editor->email)->where('essay_rating', '!=', 0)->get();

        $rating = 0;
        $i = 0;
        foreach ($count_essay as $essay) {
            $rating += $count_essay[$i]->essay_rating;
            $i++;
        }

        $average_rating = 0;
        if ($rating != 0) {
            $average_rating = $rating / count($count_essay);
        }

        return view('user.editor.editor-list.editor-list-detail', [
            'editor' => $editor,
            'essay_ongoing' => $essay_ongoing,
            'essay_completed' => $essay_completed,
            'average_rating' => number_format($average_rating, 1, ".", ",")
        ]);
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