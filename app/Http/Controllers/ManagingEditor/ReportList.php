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
