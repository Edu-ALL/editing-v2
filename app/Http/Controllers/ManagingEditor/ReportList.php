<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReportList extends Controller
{
    public function index(Request $request)
    {       
        $essay_editors = NULL;
        $editors = Editor::with('position')->orderBy('first_name', 'asc')->get();
        $status = Status::orderBy('status_title', 'asc')->get();

        if ($request->all()) {
            $f_token = $request->get('_token');
            $f_month = $request->get('f-month');
            $f_year = $request->get('f-year');
            $f_editor = $request->get('f-editor-name');
            $f_essay_type = $request->get('f-essay-type');
            $f_status = $request->get('f-status');
            $essay_editors = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')->with(['essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.university', 'essay_clients.program', 'status', 'editor'])->whereMonth('tbl_essay_editors.uploaded_at', $f_month)->whereYear('tbl_essay_editors.uploaded_at', $f_year)
                ->when($f_status != "all", function($query) use ($f_status) {
                    // $query->where('status_essay_editors', $f_status)->orWhere('status_essay_clients', $f_status);
                    $query->where('status_essay_editors', $f_status)->where('status_essay_clients', $f_status);
                })->when($f_editor != "all", function($query) use ($f_editor) {
                    $query->where('tbl_essay_editors.editors_mail', $f_editor);
                })->when($f_essay_type != "all", function($query) use ($f_essay_type) {
                    $query->whereHas('essay_clients', function ($query1) use ($f_essay_type) {
                        $query1->where('essay_title', 'like', '%'.$f_essay_type.'%');
                    });
                })->orderBy('tbl_essay_editors.uploaded_at', 'desc');

            $essay_editors = $request->get('f-download') != 1 
            ? $essay_editors->paginate(10)->appends([
                '_token' => $f_token,
                'f-month' => $f_month,
                'f-year' => $f_year,
                'f-editor-name' => $f_editor,
                'f-essay-type' => $f_essay_type,
                'f-status' => $f_status,
            ]) : $essay_editors->get();
        }

        $response = [
            'editors' => $editors,
            'status' => $status,
            'results' => $essay_editors != NULL ? $essay_editors : NULL,
            'request' => $request
        ];

        return view('user.editor.report-list.report-list', $response);
    }

    public function getReportList(Request $request)
    {
        if ($request->ajax()) {
            $f_token = $request->get('_token');
            $f_month = $request->get('f-month');
            $f_year = $request->get('f-year');
            $f_editor = $request->get('f-editor-name');
            $f_essay_type = $request->get('f-essay-type');
            $f_status = $request->get('f-status');
            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')->with(['essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.university', 'essay_clients.program', 'status', 'editor'])->whereMonth('tbl_essay_editors.uploaded_at', $f_month)->whereYear('tbl_essay_editors.uploaded_at', $f_year)
                ->when($f_status != "all", function($query) use ($f_status) {
                    $query->where('status_essay_editors', $f_status)->where('status_essay_clients', $f_status);
                })->when($f_editor != "all", function($query) use ($f_editor) {
                    $query->where('tbl_essay_editors.editors_mail', $f_editor);
                })->when($f_essay_type != "all", function($query) use ($f_essay_type) {
                    $query->whereHas('essay_clients', function ($query1) use ($f_essay_type) {
                        $query1->where('essay_title', 'like', '%'.$f_essay_type.'%');
                    });
                })
                ->orderBy('tbl_essay_editors.uploaded_at', 'desc')
                ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'style' => function($d) {
                    return 'cursor: default';
                },
            ])
            ->editColumn('student_name', function($d){
                if ($d->essay_clients->client_by_id == null) {
                    $result = $d->essay_clients->client_by_email->first_name . ' ' .$d->essay_clients->client_by_email->last_name;
                } else {
                    $result = $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name;
                }
                return $result;
            })
            ->editColumn('editor_name', function($d){
                $result = $d->editor->first_name . ' ' . $d->editor->last_name;
                return $result;
            })
            ->editColumn('program_name', function($d){
                $result = $d->essay_clients->program->program_name;
                return $result;
            })
            ->editColumn('university', function($d){
                $result = $d->essay_clients->university->university_name;
                return $result;
            })
            ->editColumn('essay_title', function($d){
                $result = $d->essay_clients->essay_title;
                return $result;
            })
            ->editColumn('editor_file', function($d){
                if ($d->status->id == 8) {
                    $path = asset('uploaded_files/program/essay/revised/'.$d->attached_of_editors);
                } else {
                    $path = asset('uploaded_files/program/essay/editors/'.$d->attached_of_editors);
                }
                $result = '
                    <a href="'.$path.'" rel="noopener" target="_blank" title="'.($d->attached_of_editors).'">Download</a>
                ';
                return $result;
            })
            ->editColumn('student_file', function($d){
                $path = asset('uploaded_files/program/essay/students/'.$d->essay_clients->attached_of_clients);
                $result = '
                    <a href="'.$path.'" rel="noopener" target="_blank" title="'.($d->essay_clients->attached_of_clients).'">Download</a>
                ';
                return $result;
            })
            ->editColumn('status', function($d){
                if ($d->status->id == 7) {
                    $result = '
                        <span style="color: var(--green)">'.$d->status->status_title.'</span>
                    ';
                } else {
                    $result = '
                        <span style="color: var(--red)">'.$d->status->status_title.'</span>
                    ';
                }
                return $result;
            })
            ->editColumn('completed_date', function($d){
                if ($d->status->id == 7) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->completed_at));
                } else {
                    $result = '-';
                }
                return $result;
            })
            ->rawColumns(['editor_file', 'student_file', 'status'])
            ->make(true);
        }
    }

    public function search(Request $request)
    {
        $month = $request->post('f-month');
        $year = $request->post('f-year');
        $editor = $request->post('f-editor-name');
        $essay_type = $request->post('f-essay-type');
        $essay_editors = EssayEditors::with(['essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.program', 'status', 'editor'])->where('status_essay_editors', 7)->whereMonth('uploaded_at', $month)->whereYear('uploaded_at', $year)
            ->when($editor != "all", function($query) use ($editor) {
                $query->where('email', $editor);
            })->when($essay_type != "all", function($query) use ($essay_type) {
                $query->whereHas('essay_clients', function ($query1) use ($essay_type) {
                    $query1->where('essay_title', 'like', '%'.$essay_type.'%');
                })->orderBy('completed_at', 'asc');
            })->get();

        return response()->json($essay_editors);
    }
}
