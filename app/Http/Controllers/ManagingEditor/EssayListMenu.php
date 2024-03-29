<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayReject;
use App\Models\EssayRevise;
use App\Models\EssayStatus;
use App\Models\EssayTags;
use App\Models\Mentor;
use App\Models\Tags;
use App\Models\Token;
use App\Models\WorkDuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class EssayListMenu extends Controller
{
    public function getEssayOngoing(Request $request)
    {
        if ($request->ajax()) {
            $editor = Auth::guard('web-editor')->user();
            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')->where('editors_mail', $editor->email)->where('status_essay_editors', '!=', 7)->orderBy('read', 'asc')->orderBy('tbl_essay_clients.essay_deadline', 'asc')->orderBy('tbl_essay_clients.application_deadline', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->read) && $d->read == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->mentors->first_name . ' ' . $d->essay_clients->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . " " . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->essay_clients->program->program_name;
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_clients->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $diffDeadline = Carbon::parse($d->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(round((60 / 100) * $diffDeadline, 0));
                    $result = date('D, d M Y', strtotime($editors_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--green)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getEssayCompleted(Request $request)
    {
        if ($request->ajax()) {
            $editor = Auth::guard('web-editor')->user();
            $data = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 7)->orderBy('read', 'asc')->orderBy('uploaded_at', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->read) && $d->read == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getCompletedDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = isset($d->essay_clients->client_by_id) ? $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name : $d->essay_clients->client_by_email->first_name . ' ' . $d->essay_clients->client_by_email->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->mentors->first_name . ' ' . $d->essay_clients->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . " " . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->essay_clients->program->program_name;
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_clients->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $diffDeadline = Carbon::parse($d->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(round((60 / 100) * $diffDeadline, 0));
                    $result = date('D, d M Y', strtotime($editors_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--green)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function index()
    {
        return view('user.editor.essay-list.editor-essay-list');
    }

    public function essayDeadline($start, $num)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $editor = Auth::guard('web-editor')->user();
        $essay = EssayEditors::where('editors_mail', '=', $editor->email)->where('status_essay_editors', '!=', 0)->where('status_essay_editors', '!=', 4)->where('status_essay_editors', '!=', 5)->where('status_essay_editors', '!=', 7);
        $essay->whereHas('essay_clients', function ($query) use ($start, $dueDate) {
            $query->whereBetween('essay_deadline', [$start, $dueDate]);
            // $query->where('essay_deadline', '>', $start)->where('essay_deadline', '<=', $dueDate);
        });
        return $essay;
    }

    public function essayListDue()
    {
        return view('user.editor.essay-list.editor-essay-list-due');
    }

    public function getDueTomorrow(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->essayDeadline('0', '1')->orderBy('read', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->read) && $d->read == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->mentors->first_name . ' ' . $d->essay_clients->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . " " . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->essay_clients->program->program_name . ' (' . $d->essay_clients->program->minimum_word . ' - ' . $d->essay_clients->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_clients->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $diffDeadline = Carbon::parse($d->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(60 / 100 * $diffDeadline);
                    $result = date('D, d M Y', strtotime($editors_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->essay_clients->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getDueThreeDays(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->essayDeadline('2', '3')->orderBy('read', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->read) && $d->read == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->mentors->first_name . ' ' . $d->essay_clients->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . " " . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->essay_clients->program->program_name . ' (' . $d->essay_clients->program->minimum_word . ' - ' . $d->essay_clients->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_clients->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $diffDeadline = Carbon::parse($d->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(60 / 100 * $diffDeadline);
                    $result = date('D, d M Y', strtotime($editors_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->essay_clients->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getDueFiveDays(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->essayDeadline('4', '5')->orderBy('read', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->read) && $d->read == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->client_by_id->mentors->first_name . ' ' . $d->essay_clients->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . " " . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->essay_clients->program->program_name . ' (' . $d->essay_clients->program->minimum_word . ' - ' . $d->essay_clients->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_clients->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $diffDeadline = Carbon::parse($d->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(60 / 100 * $diffDeadline);
                    $result = date('D, d M Y', strtotime($editors_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->essay_clients->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function detailEssayList($id_essay, Request $request)
    {
        $essay = EssayClients::find($id_essay);

        $diffDeadline = Carbon::parse($essay->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($essay->uploaded_at)->startOfDay());
        $editors_deadline = Carbon::parse($essay->uploaded_at)->addDays(60 / 100 * $diffDeadline);

        if ($essay) {
            $editors = Editor::paginate(10);
            // $essay = EssayClients::find($id_essay);
            $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();

            if ($essay_editor->read == 0) {
                DB::beginTransaction();
                $essay_editor->read = 1;
                $essay_editor->save();
                DB::commit();
            }

            # accept / reject page
            if ($essay->status_essay_clients == 1) {
                return view('user.editor.essay-list.editor-essay-detail', [
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay
                ]);
                # first page that editor should upload the essay
            } else if ($essay->status_essay_clients == 2) {
                return view('user.editor.essay-list.editor-essay-detail', [
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'tags' => Tags::get()
                ]);
            } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 8) {
                return view('user.editor.essay-list.editor-essay-detail', [
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            } else if ($essay->status_essay_clients == 6) {
                return view('user.editor.essay-list.editor-essay-detail', [
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                    'list_tags' => Tags::get(),
                    'essay_revise' => EssayRevise::where('id_essay_clients', $id_essay)->get()
                ]);
            } else if ($essay_editor->status_essay_editors == 7) {
                return view('user.editor.essay-list.editor-essay-detail', [
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'essay_editor' => $essay_editor,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            }
        } else {
            return abort(404);
            // return redirect('editor/essay-list')->with('isEssay', 'Essay not found');
        }
    }

    public function accept($id_essay)
    {
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 2;
            $essay->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 2;
            $essay_editor->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $id_essay;
            $essay_status->status = 2;
            $essay_status->save();

            DB::commit();
            Log::notice('Editor : ' . Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name . ' has accepted Essay : ' . $essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Accept Essay failed : ' . $e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $editor = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $mentor = Mentor::where('id_mentors', $client->id_mentor)->first();

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay' => $essay,
            'editor' => $editor,
        ];

        $this->sendEmail('accept', $data);

        return redirect('editor/essay-list/ongoing/detail/' . $id_essay);
    }

    public function reject($id_essay, Request $request)
    {
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 5;
            $essay->id_editors = '';
            $essay->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $id_essay;
            $essay_status->status = 5;
            $essay_status->save();

            $essay_reject = new EssayReject;
            $essay_reject->id_essay_clients = $id_essay;
            $essay_reject->editors_mail = EssayEditors::where('id_essay_clients', '=', $id_essay)->first()->editors_mail;
            $essay_reject->notes = $request->notes;
            $essay_reject->created_at = date('Y-m-d H:i:s');
            $essay_reject->save();

            EssayEditors::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();

            DB::commit();
            Log::notice('Editor : ' . Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name . ' has rejected Essay : ' . $essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Reject Essay failed : ' . $e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $editor = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $mentor = Mentor::where('id_mentors', $client->id_mentor)->first();

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay' => $essay,
            'editor' => $editor,
            'notes' => $request->notes
        ];

        $this->sendEmail('reject', $data);

        return redirect('editor/essay-list');
    }

    public function uploadEssay($id_essay, Request $request)
    {
        $rules = [
            'uploaded_file' => 'required|mimes:doc,docx|max:2048',
            'work_duration' => 'required',
            'tag' => 'required',
            'description' => '',
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id_essay], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 3;
            $essay->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 3;
            $essay_editor->work_duration = $request->work_duration;
            $essay_editor->notes_editors = $request->description;
            if ($request->hasFile('uploaded_file')) {
                if ($old_file_path = $essay_editor->attached_of_editors) {
                    $file_path = public_path('uploaded_files/program/essay/editors' . $old_file_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }

                if (isset($essay->client_by_id)) {

                    $file_name = 'Editing-' . $essay->client_by_id->first_name . '-' . $essay->client_by_id->last_name . '-Essays-by-' . $essay->essay_editors->editor->first_name . '(' . date('d-m-Y_His') . ')';
                } elseif (isset($essay->client_by_email)) {

                    $file_name = 'Editing-' . $essay->client_by_email->first_name . '-' . $essay->client_by_email->last_name . '-Essays-by-' . $essay->essay_editors->editor->first_name . '(' . date('d-m-Y_His') . ')';
                }

                // $file_name = 'Editing-'.$essay->client_by_id->first_name.'-'.$essay->client_by_id->last_name.'-Essays-by-'.$essay->editor->first_name.'('.date('d-m-Y').')';
                $file_name = str_replace(' ', '-', $file_name);
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('program/essay/editors', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $essay_editor->attached_of_editors = $file_name . '.' . $file_format;
            }
            $essay_editor->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $id_essay;
            $essay_status->status = 3;
            $essay_status->save();

            $no_tag = 0;
            foreach ($request->tag as $key) {
                $tag = new EssayTags;
                $tag->id_essay_clients = $id_essay;
                $tag->id_topic = $request->tag[$no_tag];
                $tag->save();
                $no_tag++;
            }

            $work_duration = new WorkDuration;
            $work_duration->id_essay_editors = $essay_editor->id_essay_editors;
            $work_duration->status = $essay->status->status_title;
            $work_duration->duration = $essay_editor->work_duration;
            $work_duration->save();

            DB::commit();
            Log::notice('Editor : ' . Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name . ' has submitted Essay : ' . $essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Submit Essay failed : ' . $e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $editor = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $mentor = Mentor::where('id_mentors', $client->id_mentor)->first();

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay' => $essay,
            'editor' => $editor,
        ];

        $this->sendEmail('uploadEssay', $data);

        return redirect('editor/essay-list/ongoing/detail/' . $id_essay);
    }

    public function addComment($id_essay, Request $request)
    {
        $editor = Auth::guard('web-editor')->user();
        DB::beginTransaction();
        try {
            $essay_revise = new EssayRevise;
            $essay_revise->id_essay_clients = $id_essay;
            $essay_revise->editors_mail = $editor->email;
            $essay_revise->role = 'editor';
            $essay_revise->notes = $request->comment;
            $essay_revise->created_at = date('Y-m-d H:i:s');
            $essay_revise->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }


        $data = [
            'comment' => $request->comment,
        ];

        $this->sendEmail('comment', $data);

        return redirect('editor/essay-list/ongoing/detail/' . $id_essay);
    }

    public function uploadRevise($id_essay, Request $request)
    {
        $rules = [
            'uploaded_file' => 'mimes:doc,docx|max:2048'
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id_essay], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 8;
            $essay->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 8;
            $essay_editor->work_duration = $request->work_duration;
            $essay_editor->notes_editors = $request->description;
            if ($request->hasFile('uploaded_file')) {
                if ($old_file_path = $essay_editor->attached_of_editors) {
                    $file_path = public_path('uploaded_files/program/essay/revised' . $old_file_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $file_name = 'Revised_by_' . $essay->essay_editors->editor->first_name . '_' . $essay->essay_editors->editor->last_name . '(' . date('d-m-Y_His') . ')';
                $file_name = str_replace(' ', '_', $file_name);
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('program/essay/revised', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $essay_editor->attached_of_editors = $file_name . '.' . $file_format;
            }
            $essay_editor->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $id_essay;
            $essay_status->status = 8;
            $essay_status->save();

            EssayTags::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();

            $no_tag = 0;
            foreach ($request->tag as $key) {
                $tag = new EssayTags;
                $tag->id_essay_clients = $id_essay;
                $tag->id_topic = $request->tag[$no_tag];
                $tag->save();
                $no_tag++;
            }

            $work_duration = new WorkDuration;
            $work_duration->id_essay_editors = $essay_editor->id_essay_editors;
            $work_duration->status = $essay->status->status_title;
            $work_duration->duration = $essay_editor->work_duration;
            $work_duration->save();

            DB::commit();
            Log::notice('Editor : ' . Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name . ' has revised Essay : ' . $essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Revise Essay failed : ' . $e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $editor = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $mentor = Mentor::where('id_mentors', $client->id_mentor)->first();

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay' => $essay,
            'editor' => $editor,
        ];

        $this->sendEmail('uploadRevise', $data);

        return redirect('editor/essay-list/ongoing/detail/' . $id_essay);
    }

    public function sendEmail($type, $data)
    {
        $managing = Editor::where('position', 3)->where('status', 1)->get()->toArray();
        $email = array_column($managing, 'email');

        $i = 0;
        foreach ($email as $key) {
            $user_token = [
                'email' => $email[$i],
                'token' => Crypt::encrypt(Str::random(32)),
                'activated_at' => time()
            ];
            Token::create($user_token);
            $i++;
        }

        if ($type == 'reject') {
            $editor = $data['editor']->first_name . ' ' . $data['editor']->last_name;
            Mail::send('mail.per-editor.reject-assign', $data, function ($mail) use ($email, $editor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject($editor . ' has rejected an essay assignment');
            });
        } else if ($type == 'accept') { # to mentor cc managing
            $email_mentor = $data['mentor']->email;
            Mail::send('mail.per-editor.accept-assign', $data, function ($mail) use ($email, $email_mentor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email_mentor);
                $mail->cc($email);
                $mail->subject('Assignment Accepted');
            });
        } else if ($type == 'uploadEssay') { # to managing cc mentor
            $editor = $data['editor']->first_name . ' ' . $data['editor']->last_name;
            $email_mentor = $data['mentor']->email;
            Mail::send('mail.per-editor.editor-upload', $data, function ($mail) use ($email, $editor, $email_mentor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc($email_mentor);
                $mail->subject($editor . ' has submitted an essay!');
            });
        } else if ($type == 'uploadRevise') {
            $editor = $data['editor']->first_name . ' ' . $data['editor']->last_name;
            Mail::send('mail.per-editor.editor-revise', $data, function ($mail) use ($email, $editor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject($editor . ' has submitted an essay revision!');
            });
        } else if ($type == 'comment') {
            Mail::send('mail.per-editor.editor-comment', $data, function ($mail) use ($email) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject('Editor Comments');
            });
        }

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }
    }
}
