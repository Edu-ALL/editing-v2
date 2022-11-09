<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;

class AllEditorMenu extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            $query->whereHas('position', function ($query) use ($keyword) {
                $query->where('position_name', 'like', '%'.$keyword.'%');
            })
            ->orWhere(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%')
            ->orWhere('email', 'like', '%'.$keyword.'%');
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
        $essay = EssayClients::where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 4)->where('status_essay_clients', '!=', 5)->where('status_essay_clients', '!=', 7);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay->get();
    }

    public function detail($id, Request $request){
        if ($editor = Editor::find($id)) {
            $keyword1 = $request->get('keyword-ongoing');
            $keyword2 = $request->get('keyword-completed');
            $essay_ongoing = EssayClients::whereHas('essay_editors', function($query_essay_editor) use ($editor) {
                $query_essay_editor->where('editors_mail', $editor->email);
            })->with('client_by_id', 'program')->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 4)->where('status_essay_clients', '!=', 5)->where('status_essay_clients', '!=', 7)->when($keyword1, function ($query_) use ($keyword1) {
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
            $essay_completed = EssayClients::whereHas('essay_editors', function($query_essay_editor) use ($editor) {
                $query_essay_editor->where('editors_mail', $editor->email);
            })->with('client_by_id', 'program')->where('status_essay_clients', '=', 7)->when($keyword2, function ($query_) use ($keyword2) {
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

            $essay_completed_count = EssayClients::whereHas('essay_editors', function($query_essay_editor) use ($editor) {
                $query_essay_editor->where('editors_mail', $editor->email);
            })->where('status_essay_clients', '=', 7);

            // $editor = Editor::find($id);
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
                'essay_completed_count' => $essay_completed_count,
                'average_rating' => number_format($average_rating, 1, ".", ",")
            ]);
        } else {
            return redirect('editor/list')->with('isEditor', 'Editor not found');
        }
        
    }

    public function update($id_editors, Request $request){
        $rules = [
            'position' => 'nullable',
        ];

        $validator = Validator::make($request->all() + ['id_editors' => $id_editors], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $editor = Editor::find($id_editors);
            $editor->position = $request->position;
            $editor->save();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('editor/list/detail/'.$id_editors)->with('update-editor-successful', 'The Editor has been updated');
    }

    public function deactivate($id_editors){
        DB::beginTransaction();
        try {
            $editor = Editor::find($id_editors);
            $editor->status = 2;
            $editor->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('editor/list');
    }

    public function activate($id_editors){
        DB::beginTransaction();
        try {
            $editor = Editor::find($id_editors);
            $editor->status = 1;
            $editor->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('editor/list');
    }

}