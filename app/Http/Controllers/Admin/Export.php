<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EssaysExport;
use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class Export extends Controller
{
    public function index(Request $request)
    {
        $essay_editors = NULL;
        $editors = Editor::with('position')->where('status', '=', 1)->orderBy('first_name', 'asc')->get();
        $status = Status::orderBy('status_title', 'asc')->get();

        if ($request->all()) {

            $f_token = $request->get('_token');
            $f_month = $request->get('f-month');
            $f_year = $request->get('f-year');
            $f_editor = $request->get('f-editor-name');
            $f_essay_type = $request->get('f-essay-type');
            $f_status = $request->get('f-status');
            $essay_editors = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')
                ->with([
                    'essay_clients.client_by_id',
                    'essay_clients.client_by_email',
                    'essay_clients.university',
                    'essay_clients.program',
                    'status',
                    'editor'
                ])
                ->whereMonth('tbl_essay_editors.uploaded_at', $f_month)
                ->whereYear('tbl_essay_editors.uploaded_at', $f_year)
                ->when($f_status != "all", function ($query) use ($f_status) {

                    // $query->where('status_essay_editors', $f_status)->orWhere('status_essay_clients', $f_status);
                    $query->where('status_essay_editors', $f_status)->where('status_essay_clients', $f_status);
                })->when($f_editor != "all", function ($query) use ($f_editor) {

                    $query->where('tbl_essay_editors.editors_mail', $f_editor);
                })->when($f_essay_type != "all", function ($query) use ($f_essay_type) {

                    $query->whereHas('essay_clients', function ($query1) use ($f_essay_type) {
                        $query1->where('essay_title', 'like', '%' . $f_essay_type . '%');
                    });
                })->orderBy('tbl_essay_editors.uploaded_at', 'desc');

            $essay_editors = $request->get('f-download') != 1 ? $essay_editors->paginate(10)->appends([
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

        // download excel
        // when download = 1
        if ($request->get('f-download') == 1) {
            return $this->create_excel($essay_editors, $f_month, $f_year);
        }

        return view('user.admin.export-excel.export-editor-essay', $response);
    }

    public function getEssay(Request $request)
    {
        if ($request->ajax()) {
            // if ($request->all()) {
            $f_token = $request->get('_token');
            $f_month = $request->get('f-month');
            $f_year = $request->get('f-year');
            $f_editor = $request->get('f-editor-name');
            $f_essay_type = $request->get('f-essay-type');
            $f_status = $request->get('f-status');

            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')
                ->with([
                    'essay_clients.client_by_id',
                    'essay_clients.client_by_email',
                    'essay_clients.university',
                    'essay_clients.program',
                    'status',
                    'editor'
                ])
                ->whereMonth('tbl_essay_editors.uploaded_at', $f_month)->whereYear('tbl_essay_editors.uploaded_at', $f_year)
                ->when($f_status != "all", function ($query) use ($f_status) {
                    // $query->where('status_essay_editors', $f_status)->orWhere('status_essay_clients', $f_status);
                    $query->where('status_essay_editors', $f_status)->where('status_essay_clients', $f_status);
                })
                ->when($f_editor != "all", function ($query) use ($f_editor) {
                    $query->where('tbl_essay_editors.editors_mail', $f_editor);
                })
                ->when($f_essay_type != "all", function ($query) use ($f_essay_type) {
                    $query->whereHas('essay_clients', function ($query1) use ($f_essay_type) {
                        $query1->where('essay_title', 'like', '%' . $f_essay_type . '%');
                    });
                })
                ->orderBy('tbl_essay_editors.uploaded_at', 'desc')
                ->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($result) {
                    if ($result->essay_clients->client_by_id == null) {
                        $res = $result->essay_clients->client_by_email->first_name . ' ' . $result->essay_clients->client_by_email->last_name;
                    } else {
                        $res = $result->essay_clients->client_by_id->first_name . ' ' . $result->essay_clients->client_by_id->last_name;
                    }

                    return $res;
                })
                ->editColumn('student_name', function ($result) {
                    if ($result->essay_clients->client_by_id == null) {
                        $res = $result->essay_clients->client_by_email->first_name . ' ' . $result->essay_clients->client_by_email->last_name;
                    } else {
                        $res = $result->essay_clients->client_by_id->first_name . ' ' . $result->essay_clients->client_by_id->last_name;
                    }

                    return $res;
                })
                ->editColumn('editor_name', function ($result) {
                    $res = $result->editor->first_name . ' ' . $result->editor->last_name;
                    return $res;
                })
                ->editColumn('program_name', function ($result) {
                    $res = $result->essay_clients->program->program_name;
                    return $res;
                })
                ->editColumn('university', function ($result) {
                    $res = $result->essay_clients->university->university_name;
                    return $res;
                })
                ->editColumn('essay_title', function ($result) {
                    $res = $result->essay_clients->essay_title;
                    return $res;
                })
                ->editColumn('editors_file', function ($result) {
                    $res = '<a href="' . (asset('uploaded_files/program/essay/editors/' . $result->attached_of_editors)) . '" rel="noopener" target="_blank" title="' . ($result->attached_of_editors) . '">Download</a>';
                    return $res;
                })
                ->editColumn('students_file', function ($result) {
                    $res = '<a href="' . (asset('uploaded_files/program/essay/students/' . $result->essay_clients->attached_of_clients)) . '" rel="noopener" target="_blank" title="' . ($result->essay_clients->attached_of_clients) . '">Download</a>';
                    return ' ' . $res . '';
                })
                ->editColumn('status', function ($result) {
                    if ($result->status->id == 7) {
                        $res = '<div style="color: var(--green)">' . ($result->status->status_title) . '</div>';
                    } else {
                        $res = '<div style="color: var(--red)">' . ($result->status->status_title) . '</div>';
                    }
                    return $res;
                })
                ->editColumn('essay_rating', function ($result) {
                    $res = $result->essay_clients->essay_rating;
                    return $res;
                })
                ->editColumn('work_duration', function ($result) {
                    $res = $result->work_duration;
                    return $res;
                })
                ->editColumn('application_deadline', function ($result) {
                    $res = date('D, d M Y', strtotime($result->essay_clients->application_deadline));
                    return $res;
                })
                ->editColumn('completed_date', function ($result) {
                    $res = date('D, d M Y', strtotime($result->essay_clients->completed_at));
                    return $res;
                })
                ->rawColumns(['student_name', 'editor_name', 'program_name', 'university', 'essay_title', 'editors_file', 'students_file', 'status', 'essay_rating', 'work_duration', 'application_deadline', 'completed_date'])
                ->make();
        }
    }

    public function create_excel($essay_editors, $f_month, $f_year)
    {
        foreach ($essay_editors as $essay_editor) {
            if ($essay_editor->essay_clients->client_by_id == NULL) {
                $student_name = $essay_editor->essay_clients->client_by_email->first_name . ' ' . $essay_editor->essay_clients->client_by_email->last_name;
            } else {
                $student_name = $essay_editor->essay_clients->client_by_id->first_name . ' ' . $essay_editor->essay_clients->client_by_id->last_name;
            }

            $body_excel[] = [
                $student_name,
                $essay_editor->editor->first_name . ' ' . $essay_editor->editor->last_name,
                $essay_editor->essay_clients->program->program_name,
                $essay_editor->essay_clients->university->university_name,
                $essay_editor->essay_clients->essay_title,
                public_path('uploaded_files/program/essay/editors/') . $essay_editor->attached_of_editors,
                public_path('uploaded_files/program/essay/students/') . $essay_editor->essay_clients->attached_of_clients,
                $essay_editor->status->status_title,
                $essay_editor->essay_clients->essay_rating,
                $essay_editor->work_duration,
                $essay_editor->essay_clients->application_deadline,
                $essay_editor->essay_clients->completed_at
            ];
        }

        $export = new EssaysExport([
            [
                'Students Name',
                'Editors Name',
                'Program Name',
                'University',
                'Essay Title',
                // 'Description',  # new
                // 'Essay Deadline', # new
                // 'Application Deadline', # new
                'Editors File',
                'Students File',
                // 'Students Status', # new
                'Status', # editor status
                'Essay Rating',
                'Work Duration (Minutes)',
                'Application Date',
                'Completed Date'
            ],
            $body_excel
        ]);
        Log::notice('Excel file has been successfully created : ' . 'Essay Report ' . $f_month . '-' . $f_year . '.xlsx');
        return Excel::download($export, 'Essay Report ' . $f_month . '-' . $f_year . '.xlsx');
    }

    public function search(Request $request)
    {
        $month = $request->post('f-month');
        $year = $request->post('f-year');
        $editor = $request->post('f-editor-name');
        $essay_type = $request->post('f-essay-type');
        $essay_editors = EssayEditors::with(['essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.program', 'status', 'editor'])->where('tbl_essay_editors.status_essay_editors', 7)->whereMonth('tbl_essay_editors.uploaded_at', $month)->whereYear('tbl_essay_editors.uploaded_at', $year)
            ->when($editor != "all", function ($query) use ($editor) {
                $query->where('email', $editor);
            })->when($essay_type != "all", function ($query) use ($essay_type) {
                $query->whereHas('essay_clients', function ($query1) use ($essay_type) {
                    $query1->where('essay_title', 'like', '%' . $essay_type . '%');
                })->orderBy('completed_at', 'asc');
            })->get();

        return response()->json($essay_editors);
    }
}
