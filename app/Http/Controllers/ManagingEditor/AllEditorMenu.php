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
use Yajra\DataTables\Facades\DataTables;

class AllEditorMenu extends Controller
{
    public function getEditor(Request $request){
        if ($request->ajax()) {
            $data = Editor::orderBy('first_name', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'onclick' => function($d) {
                    return 'getDetail('.$d->id_editors.')';
                },
            ])
            ->editColumn('fullname', function($d){
                $result = $d->first_name . ' ' . $d->last_name;
                return $result;
            })
            ->editColumn('email', function($d){
                $result = $d->email ? $d->email : "-";
                return $result;
            })
            ->editColumn('dueTomorrow', function($d){
                $result = $this->dueEssay('0', '1', $d->email).' Essays';
                return $result;
            })
            ->editColumn('dueThree', function($d){
                $result = $this->dueEssay('2', '3', $d->email).' Essays';
                return $result;
            })
            ->editColumn('dueFive', function($d){
                $result = $this->dueEssay('4', '5', $d->email).' Essays';
                return $result;
            })
            ->editColumn('position', function($d){
                if ($d->position == 1) {
                    $result = 'Associate';
                } else if ($d->position == 2) {
                    $result = 'Senior';
                } else if ($d->position == 3) {
                    $result = 'Managing';
                }
                return $result;
            })
            ->editColumn('status', function($d){
                if ($d->status == 1) {
                    $result = '
                        <div class="status-editor">
                            Active
                        </div>
                    ';
                } else {
                    $result = '
                        <div class="status-editor" style="background-color: var(--red)">
                            Deactive
                        </div>
                    ';
                }
                return $result;
            })
            ->rawColumns(['fullname', 'email', 'dueTomorrow', 'dueThree', 'dueFive', 'position', 'status'])
            ->make(true);
        }
    }

    public function index(Request $request){
        return view('user.editor.editor-list.editor-list');
    }

    public function dueEssay($start, $num, $email){
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $essay = EssayEditors::whereHas('essay_clients', function ($query) use ($start, $dueDate, $email) {
            $query->whereBetween('essay_deadline', [$start, $dueDate]);
        })->whereIn('status_essay_editors', ['1', '2', '3', '6', '8'])->where('editors_mail', $email)->count();
        return $essay;
    }

    public function getEditorEssayOngoing(Request $request, $id){
        if ($request->ajax()) {
            $editor = Editor::find($id);
            $data = EssayClients::join('tbl_essay_editors', 'tbl_essay_editors.id_essay_clients', 'tbl_essay_clients.id_essay_clients')->where('editors_mail', $editor->email)->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 4)->where('status_essay_clients', '!=', 5)->where('status_essay_clients', '!=', 7)->orderBy('essay_deadline', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'style' => function($d) {
                    return 'cursor: default';
                },
            ])
            ->editColumn('student_name', function($d){
                $result = $d->client_by_id->first_name.' '.$d->client_by_id->last_name;
                return $result;
            })
            ->editColumn('program_name', function($d){
                $result = $d->program->program_name;
                return $result;
            })
            ->editColumn('essay_title', function($d){
                $result = $d->essay_title;
                return $result;
            })
            ->editColumn('essay_deadline', function($d){
                $result = date('D, d M Y', strtotime($d->essay_deadline));
                return $result;
            })
            ->editColumn('status', function($d){
                $result = '
                    <span style="color: var(--blue)">
                        '.$d->status->status_title.'
                    </span>
                ';
                return $result;
            })
            ->rawColumns(['status'])
            ->make(true);
        }
    }

    public function getEditorEssayCompleted(Request $request, $id){
        if ($request->ajax()) {
            $editor = Editor::find($id);
            $data = EssayClients::join('tbl_essay_editors', 'tbl_essay_editors.id_essay_clients', 'tbl_essay_clients.id_essay_clients')->where('editors_mail', $editor->email)->where('status_essay_clients', '=', 7)->orderBy('completed_at', 'desc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'style' => function($d) {
                    return 'cursor: default';
                },
            ])
            ->editColumn('student_name', function($d){
                $result = $d->client_by_id->first_name.' '.$d->client_by_id->last_name;
                return $result;
            })
            ->editColumn('program_name', function($d){
                $result = $d->program->program_name;
                return $result;
            })
            ->editColumn('essay_title', function($d){
                $result = $d->essay_title;
                return $result;
            })
            ->editColumn('essay_deadline', function($d){
                $result = date('D, d M Y', strtotime($d->essay_deadline));
                return $result;
            })
            ->editColumn('status', function($d){
                $result = '
                    <span style="color: var(--green)">
                        '.$d->status->status_title.'
                    </span>
                ';
                return $result;
            })
            ->rawColumns(['status'])
            ->make(true);
        }
    }

    public function detail($id, Request $request){
        if ($editor = Editor::find($id)) {
            $essay_completed_count = EssayClients::whereHas('essay_editors', function($query_essay_editor) use ($editor) {
                $query_essay_editor->where('editors_mail', $editor->email);
            })->where('status_essay_clients', '=', 7);

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
        return redirect('editor/list')->with('deactive-editor-successful', $editor->first_name.' has been deactive');
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
        return redirect('editor/list')->with('active-editor-successful', $editor->first_name.' has been active');
    }
}