<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Events\EditorNotif;
use App\Events\MentorNotif;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayFeedbacks;
use App\Models\EssayRevise;
use App\Models\EssayStatus;
use App\Models\EssayTags;
use App\Models\ManagingFeedback;
use App\Models\Mentor;
use App\Models\Tags;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AllEssaysMenu extends Controller
{
    public function index()
    {
        $count_not_assign_essay = EssayClients::where('status_essay_clients', 0)->orWhere('status_essay_clients', 4)->orWhere('status_essay_clients', 5)->count();
        $count_assign_essay = EssayEditors::where('status_essay_editors', 1)->count();
        $count_ongoing_essay = EssayEditors::where('status_essay_editors', 2)->orWhere('status_essay_editors', 3)->orWhere('status_essay_editors', 6)->orWhere('status_essay_editors', 8)->count();
        $count_completed_essay = EssayEditors::where('status_essay_editors', 7)->count();
        return view('user.editor.all-essays.editor-all-essays', [
            'count_not_assign_essay' => $count_not_assign_essay,
            'count_assign_essay' => $count_assign_essay,
            'count_ongoing_essay' => $count_ongoing_essay,
            'count_completed_essay' => $count_completed_essay,
        ]);
    }

    public function essayOngoing(Request $request)
    {
        return view('user.editor.all-essays.essay-ongoing');
    }

    public function getEditorList(Request $request)
    {
        if ($request->ajax()) {
            $data = Editor::where('status', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'select_row(this)';
                    },
                    'style' => function ($d) {
                        return 'cursor: pointer';
                    },
                ])
                ->editColumn('editor_name', function ($d) {
                    $result = $d->first_name . ' ' . $d->last_name;
                    return $result;
                })
                ->editColumn('graduated_from', function ($d) {
                    $result = $d->graduated_from;
                    return $result;
                })
                ->editColumn('dueTomorrow', function ($d) {
                    $result = $this->dueEssayEditor('0', '1', $d->email) . ' Essays';
                    return $result;
                })
                ->editColumn('dueThree', function ($d) {
                    $result = $this->dueEssayEditor('2', '3', $d->email) . ' Essays';
                    return $result;
                })
                ->editColumn('dueFive', function ($d) {
                    $result = $this->dueEssayEditor('4', '5', $d->email) . ' Essays';
                    return $result;
                })
                ->editColumn('completed_essay', function ($d) {
                    $completedEssay = EssayEditors::where('status_essay_editors', 7)->get();
                    $result = $completedEssay->where('editors_mail', $d->email)->count() . " Essays";
                    return $result;
                })
                ->editColumn('assign', function ($d) {
                    $result = '
                    <div class="form-check d-flex align-items-center justify-content-center">
                        <input class="form-check-input" type="radio" name="id_editors" id="flexRadioDefault1" value="' . $d->email . '">
                    </div>
                ';
                    return $result;
                })
                ->rawColumns(['assign'])
                ->make(true);
        }
    }

    public function getNotAssignList(Request $request)
    {
        if ($request->ajax()) {
            $data = EssayClients::where('status_essay_clients', 0)->orWhere('status_essay_clients', 4)->orWhere('status_essay_clients', 5)->orderBy('essay_deadline', 'asc')->orderBy('application_deadline', 'asc')->get();
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
                    $result = isset($d->client_by_id) ? $d->client_by_id->first_name . ' ' . $d->client_by_id->last_name : $d->client_by_email->first_name . ' ' . $d->client_by_email->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = isset($d->client_by_id) ? $d->client_by_id->mentors->first_name . ' ' . $d->client_by_id->mentors->last_name : $d->client_by_email->mentors->first_name . ' ' . $d->client_by_email->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = $d->status_essay_clients == 0 || $d->status_essay_clients == 4 || $d->status_essay_clients == 5 ? '-' : $d->editor->first_name . ' ' . $d->editor->last_name;
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = isset($d->editor) ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->program->program_name . ' (' . $d->program->minimum_word . ' - ' . $d->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->uploaded_at));
                    return $result;
                })
                ->editColumn('editors_deadline', function ($d) {
                    // Editors deadline 60% dari selisih
                    $deadline = Carbon::parse($d->essay_deadline)
                        ->startOfDay()
                        ->diffInDays(Carbon::parse($d->uploaded_at)->startOfDay());

                    $editor_deadline = Carbon::parse($d->uploaded_at)->addDays(round((60 / 100) * $deadline, 0));
                    $result = date('D, d M Y', strtotime($editor_deadline));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getAssignList(Request $request)
    {
        if ($request->ajax()) {
            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')->where('status_essay_editors', 1)->orderBy('tbl_essay_clients.essay_deadline', 'asc')->orderBy('tbl_essay_clients.application_deadline', 'asc')->get();
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
                    $result = isset($d->essay_clients->client_by_id) ? $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name : $d->essay_clients->client_by_email->first_name . ' ' . $d->essay_clients->client_by_email->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->mentor->first_name . ' ' . $d->essay_clients->mentor->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = isset($d->editor) ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = isset($d->essay_clients->editor) ? $d->essay_clients->editor->first_name . ' ' . $d->essay_clients->editor->last_name : '-';
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
                ->editColumn('editors_deadline', function ($d) {
                    // Editors deadline 60% dari selisih
                    $deadline = Carbon::parse($d->essay_clients->essay_deadline)
                        ->startOfDay()
                        ->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());

                    $editor_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(round((60 / 100) * $deadline, 0));
                    $result = date('D, d M Y', strtotime($editor_deadline));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getOngoingList(Request $request)
    {
        if ($request->ajax()) {
            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')->where('status_essay_editors', 2)->orWhere('status_essay_editors', 3)->orWhere('status_essay_editors', 6)->orWhere('status_essay_editors', 8)->orderBy('tbl_essay_clients.essay_deadline', 'asc')->orderBy('tbl_essay_clients.application_deadline', 'asc')->get();
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
                    $result = isset($d->essay_clients->client_by_id) ? $d->essay_clients->client_by_id->first_name . ' ' . $d->essay_clients->client_by_id->last_name : $d->essay_clients->client_by_email->first_name . ' ' . $d->essay_clients->client_by_email->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->essay_clients->mentor->first_name . ' ' . $d->essay_clients->mentor->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = isset($d->editor) ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = isset($d->essay_clients->editor) ? $d->essay_clients->editor->first_name . ' ' . $d->essay_clients->editor->last_name : '-';
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
                ->editColumn('editors_deadline', function ($d) {
                    // Editors deadline 60% dari selisih
                    $deadline = Carbon::parse($d->essay_clients->essay_deadline)
                        ->startOfDay()
                        ->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());

                    $editor_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(round((60 / 100) * $deadline, 0));
                    $result = date('D, d M Y', strtotime($editor_deadline));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getCompletedList(Request $request)
    {
        if ($request->ajax()) {
            $data = EssayEditors::where('status_essay_editors', 7)->orderBy('uploaded_at', 'desc')->get();
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
                    $result = $d->essay_clients->mentor->first_name . ' ' . $d->essay_clients->mentor->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    $result = isset($d->editor) ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = isset($d->essay_clients->editor) ? $d->essay_clients->editor->first_name . ' ' . $d->essay_clients->editor->last_name : '-';
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
                ->editColumn('editors_deadline', function ($d) {
                    // Editors deadline 60% dari selisih
                    $deadline = Carbon::parse($d->essay_clients->essay_deadline)
                        ->startOfDay()
                        ->diffInDays(Carbon::parse($d->essay_clients->uploaded_at)->startOfDay());

                    $editor_deadline = Carbon::parse($d->essay_clients->uploaded_at)->addDays(round((60 / 100) * $deadline, 0));
                    $result = date('D, d M Y', strtotime($editor_deadline));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_clients->essay_deadline));
                    return $result;
                })
                ->editColumn('managing_feedback', function ($d) {
                    $managing_feedback = ManagingFeedback::where('id_essay_editor', $d->id_essay_editors)->first();
                    $feedback = $managing_feedback ? $managing_feedback->feedback : 4;
                    $result = '';
                    switch ($feedback) {
                        case 0:
                            $result = 'Unacceptable';
                            break;
                        case 1:
                            $result = 'Lacking';
                            break;
                        case 2:
                            $result = 'Acceptable';
                            break;
                        case 3:
                            $result = 'Beyond';
                            break;
                        default:
                            $result = '-';
                    }
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

    public function essayCompleted(Request $request)
    {
        return view('user.editor.all-essays.essay-completed');
    }

    public function dueEssayEditor($start, $num, $email)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $essay = EssayEditors::whereHas('essay_clients', function ($query) use ($start, $dueDate, $email) {
            $query->whereBetween('essay_deadline', [$start, $dueDate]);
        })->whereIn('status_essay_editors', ['1', '2', '3', '6', '8'])->where('editors_mail', $email)->count();
        return $essay;
    }

    public function detailEssayManaging($id_essay, Request $request)
    {
        $tracking = EssayStatus::where('id_essay_clients', $id_essay)
            ->groupBy('status')
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        $essay = EssayClients::find($id_essay);
        if ($essay) {
            $editors = Editor::all();
            // $essay = EssayClients::find($id_essay);
            $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();

            if ($essay->status_read == 0) {
                DB::beginTransaction();
                $essay->status_read = 1;
                $essay->save();
                DB::commit();
            }
            if ($essay->status_read_editor == 0) {
                DB::beginTransaction();
                $essay->status_read_editor = 1;
                $essay->save();
                DB::commit();
            }
            if ($essay_editor) {
                if ($essay_editor->read == 0) {
                    DB::beginTransaction();
                    $essay_editor->read = 1;
                    $essay_editor->save();
                    DB::commit();
                }
            }
            
            $editors->map(function($data) {
                $data['dueTomorrow'] = $this->dueEssayEditor('0', '1', $data['email']);
                $data['dueThree'] = $this->dueEssayEditor('2', '3', $data['email']);
                $data['dueFive'] = $this->dueEssayEditor('4', '5', $data['email']);
            });

            if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5) {
                return view('user.editor.all-essays.essay-ongoing-detail', [
                    'tracking' => $tracking,
                    'essay' => $essay,
                    'editors' => $editors,
                    'completedEssay' => EssayEditors::where('status_essay_editors', 7)->get()
                ]);
            } else if ($essay->status_essay_clients == 1) {
                return view('user.editor.all-essays.essay-ongoing-detail', [
                    'tracking' => $tracking,
                    'essay' => $essay
                ]);
            } else if ($essay->status_essay_clients == 2) {
                return view('user.editor.all-essays.essay-ongoing-detail', [
                    'tracking' => $tracking,
                    'essay' => $essay
                ]);
            } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8) {
                return view('user.editor.all-essays.essay-ongoing-detail', [
                    'tracking' => $tracking,
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                    'list_tags' => Tags::get(),
                    'essay_revise' => EssayRevise::where('id_essay_clients', $id_essay)->get()
                ]);
            }
        } else {
            return abort(404);
            // return redirect('editor/all-essays')->with('isEssay', 'Essay not found');
        }
    }

    public function detailEssayManagingCompleted($id_essay, Request $request)
    {
        $essay = EssayEditors::where('id_essay_clients', $id_essay)->first();
        $managing_feedback = ManagingFeedback::where('id_essay_editor', $essay->id_essay_editors)->first();

        $tracking = EssayStatus::where('id_essay_clients', $id_essay)
            ->groupBy('status')
            ->orderBy('status', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($essay) {
            // $essay = EssayEditors::where('id_essay_clients', $id_essay)->first();
            $essay_client = EssayClients::where('id_essay_clients', $id_essay)->first();
            if ($essay_client->essay_deadline > $essay->uploaded_at) {
                $status_essay = 'On Time';
            } else {
                $status_essay = 'Late';
            }
            if ($essay->read == 0) {
                DB::beginTransaction();
                $essay->read = 1;
                $essay->save();
                DB::commit();
            }
            return view('user.editor.all-essays.essay-completed-detail', [
                'tracking' => $tracking,
                'essay' => $essay_client,
                'essay_editor' => $essay,
                'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                'feedback' => EssayFeedbacks::where('id_essay_clients', $id_essay)->first(),
                'status_essay' => $status_essay,
                'managing_feedback' => $managing_feedback,
            ]);
        } else {
            return abort(404);
            // return redirect('editor/all-essays');
        }
    }

    public function assignEditor($id_essay, Request $request)
    {
        # managing editor data
        $managing_name = Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name;

        # get associate editor data
        $editor = Editor::where('email', $request->id_editors)->where('status', 1)->first();

        DB::beginTransaction();
        try {

            # update table essay clients
            $essay = EssayClients::find($id_essay);
            // $essay->id_editors = $request->id_editors;
            $essay->status_essay_clients = 1;
            $essay->save();

            # insert into table essay editor
            $essay_editor = new EssayEditors;
            $essay_editor->id_essay_clients = $essay->id_essay_clients;
            $essay_editor->editors_mail = $request->id_editors;
            $essay_editor->status_essay_editors = 1;
            $essay_editor->save();

            // Pusher 
            event(new EditorNotif($editor->email, 'You have a new assignment.'));

            # insert into table essay status
            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 1;
            $essay_status->save();
            Log::notice('Editor : '.$managing_name.' has been Assigned for Essay : '.$essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Assign Editor failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $editors_mail = $essay->essay_editors->editor->email;

        $user_token = [
            'email' => $editors_mail,
            'token' => Crypt::encrypt(Str::random(32)),
            'activated_at' => time()
        ];

        # save token
        Token::create($user_token);

        $content = [
            'managing_name' => $managing_name,
            'editor' => $editor,
            'essay' => $essay
        ];

        Mail::send('mail.assign-essay', $content, function ($mail) use ($editors_mail) {
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->to($editors_mail);
            $mail->subject('Your Assignment');
        });

        if (Mail::failures()) {
            DB::rollBack();
            return Redirect::back()->withErrors("Failed to send email to editor");
        }

        DB::commit();

        return redirect('editor/all-essays/ongoing/detail/' . $id_essay);
    }

    public function cancel($id_essay)
    {
        DB::beginTransaction();
        $essay = EssayClients::find($id_essay);
        $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();
        $managing = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $editor = Editor::where('email', $essay_editor->editors_mail)->first();

        try {
            $essay->status_essay_clients = 4;
            $essay->save();

            $editors_mail = null;
            if (isset($essay->essay_editors)) {
                $editors_mail = $essay->essay_editors->editor->email;
                EssayEditors::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();
            }

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 4;
            $essay_status->save();

            DB::commit();
            Log::notice('Editor : '.$editor->first_name.' '.$editor->last_name.' has been Canceled for Essay : '.$essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Cancel Editor failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        // $email = $essay->essay_editors->editor->email;
        $email = $editors_mail;

        $data = [
            'managing' => $managing,
            'essay' => $essay,
            'client' => $client,
            'editor' => $editor
        ];

        if ($email && $data)
            $this->sendEmail('cancel', $email, $data);

        return redirect('editor/all-essays/ongoing/detail/' . $id_essay);
    }

    public function verify($id_essay, Request $request)
    {
        $editor = Auth::guard('web-editor')->user();

        $rules = [
            'uploaded_acc_file' => 'mimes:doc,docx|max:2048'
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id_essay], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 7;
            $essay->completed_at = date('Y-m-d H:i:s');

            # update status read
            $essay->status_read = 0;

            $essay->save();
            // Pusher 
            event(new MentorNotif($essay->mentors_mail, 'Congratulations, your essay has been completed.'));


            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 7;
            $essay_status->save();


            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 7;
            // Upload Acc File
            if ($request->hasFile('uploaded_acc_file')) {
                $file_name = 'Revised_by_' . $editor->first_name . '_' . $editor->last_name . '(' . date('d-m-Y_His') . ')';
                // $file_name = str_replace(' ', '-', $file_name);
                $file_format = $request->file('uploaded_acc_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_acc_file')->storeAs('program/essay/revised', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $essay_editor->managing_file = $file_name . '.' . $file_format;
            }
            $essay_editor->notes_managing = $request->notes_managing;
            $essay_editor->save();

            // Pusher 
            event(new EditorNotif($essay_editor->editors_mail, 'Congratulations, your essay has been completed.'));

            DB::commit();
            Log::notice('Editor : '.$editor->first_name.' '.$editor->last_name.' has been Completed for Essay : '.$essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Complete Essay failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $email = $essay_editor->editors_mail;
        $data = [];

        $this->send_email($id_essay);
        $this->sendEmail('verify', $email, $data);

        return redirect('editor/all-essays/completed/detail/' . $id_essay);
    }

    public function revise($id_essay, Request $request)
    {
        $managing = Auth::guard('web-editor')->user();

        $rules = [
            'uploaded_revise_file' => 'mimes:doc,docx|max:2048'
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id_essay], $rules);
        if ($validator->fails()) {
            // dd($validator->messages());
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 6;
            # update status read editor
            $essay->status_read_editor = 1;
            $essay->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 6;
            $essay_status->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 6;
            // $essay_editor->notes_editors = $request->notes;
            $essay_editor->save();

            $essay_revise = new EssayRevise;
            $essay_revise->id_essay_clients = $id_essay;
            $essay_revise->editors_mail = $essay_editor->editors_mail;
            $essay_revise->admin_mail = $managing->email;
            $essay_revise->role = 'managing_editor';
            $essay_revise->notes = $request->notes;
            // Upload Revise File
            if ($request->hasFile('uploaded_revise_file')) {
                $file_name = 'Revise-' . date('d-m-Y_His');
                $file_name = str_replace(' ', '-', $file_name);
                $file_format = $request->file('uploaded_revise_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_revise_file')->storeAs('program/essay/revise', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $essay_revise->file = $file_name . '.' . $file_format;
            }
            $essay_revise->created_at = date('Y-m-d H:i:s');
            $essay_revise->save();

            // Pusher 
            // event(new EditorNotif($essay_editor->editors_mail, 'Please, revise your essay.'));

            DB::commit();
            Log::notice('Editor : '.$managing->first_name.' '.$managing->last_name.' has been Revised for Essay : '.$essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Revise Essay failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $email = $essay_editor->editors_mail;
        $essay = EssayClients::find($id_essay);
        // $editor = Editor::where('id_editors', $essay->id_editors)->first();
        $editor = Editor::where('id_editors', $essay->essay_editors->editor->id_editors)->first();
        $client = Client::where('id_clients', $essay->id_clients)->first();

        $data = [
            'editor' => $editor,
            'essay' => $essay,
            'client' => $client,
            'managing' => $managing
        ];
        $this->sendEmail('revise', $email, $data);

        return redirect('editor/all-essays/ongoing/detail/' . $id_essay);
    }

    public function managing_feedback(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $managing_feedback = new ManagingFeedback;
            $managing_feedback->id_essay_editor = $request->essay_editor;
            $managing_feedback->id_editor = $request->managing_editor;
            $managing_feedback->feedback = $request->feedback;
            $managing_feedback->created_at = date('Y-m-d H:i:s');
            $managing_feedback->save();

            DB::commit();
            Log::notice('Store Managing Feedback Successfully with Essay Editors ID ' . $request->essay_editor);
            return redirect('editor/all-essays/completed/detail/' . $id)->withSuccess('The feedback has been submitted.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Store Managing Feedback: ' . $e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }
    }

    public function send_email($id_essay)
    {
        $editor = Auth::guard('web-editor')->user();
        $essay = EssayClients::find($id_essay);
        $essayEditor = EssayEditors::where('id_essay_clients', $essay->id_essay_clients)->first();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $mentor = Mentor::where('id_mentors', $client->id_mentor)->first();
        $email = $mentor->email;

        $data = [
            'editor' => $editor,
            'essay' => $essay,
            'essayEditor' => $essayEditor,
            'client' => $client,
            'mentor' => $mentor
        ];

        // Pusher 
        // event(new MentorNotif($email, 'Congratulations, your essay has been completed.'));

        $this->sendEmail('send_email', $email, $data);
        Log::notice('Email successfully sent to Mentor : '.$mentor->first_name.' '.$mentor->last_name.' for Essay : '.$essay->essay_title.' with Editor : '.$editor->first_name.' '.$editor->last_name);
        return redirect('editor/all-essays/completed/detail/' . $id_essay);
    }

    public function cancel_revise($id_essay, Request $request)
    {
        $editor = Auth::guard('web-editor')->user();

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
            $essay_editor->save();

            $essay_revise = new EssayRevise;
            $essay_revise->id_essay_clients = $id_essay;
            $essay_revise->editors_mail = $essay_editor->editors_mail;
            $essay_revise->admin_mail = $editor->email;
            $essay_revise->role = 'managing_editor';
            $essay_revise->notes = $request->notes;
            $essay_revise->created_at = date('Y-m-d H:i:s');
            $essay_revise->save();

            // Pusher 
            event(new EditorNotif($essay_editor->editors_mail, 'Please, revise your essay.'));
            if (EssayFeedbacks::find($id_essay)) {
                EssayFeedbacks::find($id_essay)->delete();
            }


            DB::commit();
            Log::notice('Editor : '.$editor->first_name.' '.$editor->last_name.' has been Cancel Revise for Essay : '.$essay->essay_title);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Cancel Revise Essay failed : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('editor/all-essays/ongoing/detail/' . $id_essay);
    }

    public function sendEmail($type, $email, $data)
    {
        $managing = Auth::guard('web-editor')->user();

        $user_token = [
            'email' => $managing->email,
            'token' => Crypt::encrypt(Str::random(32)),
            'activated_at' => time()
        ];

        # save token
        Token::create($user_token);

        if ($type == 'cancel') {
            Mail::send('mail.cancel-assign', $data, function ($mail) use ($email) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject('One of your assignments has been canceled');
            });
        } else if ($type == 'verify') {
            Mail::send('mail.complete-essay', $data, function ($mail) use ($email, $data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject('Your Essay is Complete');
            });
        } else if ($type == 'revise') {
            Mail::send('mail.revise-essay', $data, function ($mail) use ($email, $data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject($data['client']->first_name . ' ' . $data['client']->last_name . '`s essay, ' . $data['essay']->essay_title . ', needs further revision');
            });
        } else if ($type == 'send_email') {
            Mail::send('mail.send-essay', $data, function ($mail) use ($email, $data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject($data['client']->first_name . ' ' . $data['client']->last_name . '`s essay, ' . $data['essay']->essay_title . ', is ready!');
            });
        }

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }
    }

    public function allEssayDeadline($start, $num)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $essay = EssayClients::where('status_essay_clients', '!=', 7)->whereBetween('essay_deadline', [$start, $dueDate]);
        return $essay;
    }

    public function essayListDue()
    {
        return view('user.editor.all-essays.essay-list-due');
    }

    public function getDueTomorrow(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->allEssayDeadline('0', '1')->orderBy('status_read_editor', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->status_read_editor) && $d->status_read_editor == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->client_by_id->first_name . ' ' . $d->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->client_by_id->mentors->first_name . ' ' . $d->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    if ($d->essay_editors && $d->essay_editors->editor != null) {
                        $result = $d->essay_editors->editor->first_name . ' ' . $d->essay_editors->editor->last_name;
                    } else if ($d->status_essay_clients == 0 || $d->editor == null) {
                        $result = '-';
                    }
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->program->program_name . ' (' . $d->program->minimum_word . ' - ' . $d->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getDueThree(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->allEssayDeadline('2', '3')->orderBy('status_read_editor', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->status_read_editor) && $d->status_read_editor == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->client_by_id->first_name . ' ' . $d->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->client_by_id->mentors->first_name . ' ' . $d->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    if ($d->essay_editors && $d->essay_editors->editor != null) {
                        $result = $d->essay_editors->editor->first_name . ' ' . $d->essay_editors->editor->last_name;
                    } else if ($d->status_essay_clients == 0 || $d->editor == null) {
                        $result = '-';
                    }
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->program->program_name . ' (' . $d->program->minimum_word . ' - ' . $d->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    public function getDueFive(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->allEssayDeadline('4', '5')->orderBy('status_read_editor', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->setRowClass(function ($d) {
                    return isset($d->status_read_editor) && $d->status_read_editor == 0 ? 'unread' : '';
                })
                ->setRowAttr([
                    'onclick' => function ($d) {
                        return 'getOngoingDetail(' . $d->id_essay_clients . ')';
                    },
                ])
                ->editColumn('student_name', function ($d) {
                    $result = $d->client_by_id->first_name . ' ' . $d->client_by_id->last_name;
                    return $result;
                })
                ->editColumn('mentor_name', function ($d) {
                    $result = $d->client_by_id->mentors->first_name . ' ' . $d->client_by_id->mentors->last_name;
                    return $result;
                })
                ->editColumn('editor_name', function ($d) {
                    if ($d->essay_editors && $d->essay_editors->editor != null) {
                        $result = $d->essay_editors->editor->first_name . ' ' . $d->essay_editors->editor->last_name;
                    } else if ($d->status_essay_clients == 0 || $d->editor == null) {
                        $result = '-';
                    }
                    return $result;
                })
                ->editColumn('request_editor', function ($d) {
                    $result = $d->editor ? $d->editor->first_name . ' ' . $d->editor->last_name : '-';
                    return $result;
                })
                ->editColumn('program_name', function ($d) {
                    $result = $d->program->program_name . ' (' . $d->program->minimum_word . ' - ' . $d->program->maximum_word . ' Words)';
                    return $result;
                })
                ->editColumn('essay_title', function ($d) {
                    $result = $d->essay_title;
                    return $result;
                })
                ->editColumn('upload_date', function ($d) {
                    $result = date('D, d M Y', strtotime($d->uploaded_at));
                    return $result;
                })
                ->editColumn('essay_deadline', function ($d) {
                    $result = date('D, d M Y', strtotime($d->essay_deadline));
                    return $result;
                })
                ->editColumn('status', function ($d) {
                    $result = '
                    <span style="color: var(--blue)">' . $d->status->status_title . '</span>
                ';
                    return $result;
                })
                ->rawColumns(['status'])
                ->make(true);
        }
    }
}
