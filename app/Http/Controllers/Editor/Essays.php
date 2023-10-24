<?php

namespace App\Http\Controllers\Editor;

use App\Events\ManagingNotif;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\EssayClients;
use App\Models\Editor;
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

class Essays extends Controller
{
    public function index(Request $request)
    {
        return view('user.per-editor.essay-list.essay-list');
    }

    public function getEssayOngoing(Request $request)
    {
        if ($request->ajax()) {
            $editor = Auth::guard('web-editor')->user();
            $data = EssayEditors::join('tbl_essay_clients', 'tbl_essay_clients.id_essay_clients', 'tbl_essay_editors.id_essay_clients')
                ->with(['status', 'essay_clients.mentor', 'editor', 'essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.client_by_id.mentors', 'essay_clients.client_by_email.mentors', 'essay_clients.program'])
                ->where('editors_mail', $editor->email)
                ->where('status_essay_editors', '!=', 7)
                ->orderBy('read', 'asc')
                ->orderBy('tbl_essay_clients.essay_deadline', 'asc')
                ->orderBy('tbl_essay_clients.application_deadline', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($essay) {
                    if (isset($essay->essay_clients->client_by_id)) {
                        $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                            ($essay->essay_clients->client_by_id->first_name) . ' ' . ($essay->essay_clients->client_by_id->last_name) .
                            '</div>';
                    } else {
                        $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                            ($essay->essay_clients->client_by_email->first_name) . ' ' . ($essay->essay_clients->client_by_email->last_name) .
                            '</div>';
                    }
                    return $result;
                })
                ->editColumn('mentor_name', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->essay_clients->mentor->first_name) . ' ' . ($essay->essay_clients->mentor->last_name)  .
                        '</div>';
                    return $result;
                })
                ->editColumn('editor_name', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-')  .
                        '</div>';
                    return $result;
                })
                ->editColumn('program', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->essay_clients->program->program_name)  .
                        '</div>';
                    return $result;
                })
                ->editColumn('title', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->essay_clients->essay_title)  .
                        '</div>';
                    return $result;
                })
                ->editColumn('upload_date', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        (date('D, d M Y', strtotime($essay->essay_clients->uploaded_at)))  .
                        '</div>';
                    return $result;
                })
                ->editColumn('essay_deadline', function ($essay) {
                    $diffDeadline = Carbon::parse($essay->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($essay->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($essay->essay_clients->uploaded_at)->addDays(60 / 100 * $diffDeadline);

                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        (date('D, d M Y', strtotime($editors_deadline)))  .
                        '</div>';
                    return $result;
                })
                ->editColumn('status', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '" style="color: var(--green)">' .
                        ($essay->status->status_title)  .
                        '</div>';
                    return $result;
                })
                ->rawColumns(['student_name', 'mentor_name', 'editor_name', 'program', 'title', 'upload_date', 'essay_deadline', 'status'])
                ->make();
        }
    }

    public function getEssayCompleted(Request $request)
    {
        if ($request->ajax()) {
            $editor = Auth::guard('web-editor')->user();
            $data = EssayEditors::where('editors_mail', $editor->email)
                ->with(['status', 'essay_clients.mentor', 'editor', 'essay_clients.client_by_id', 'essay_clients.client_by_email', 'essay_clients.client_by_id.mentors', 'essay_clients.client_by_email.mentors', 'essay_clients.program'])
                ->where('status_essay_editors', '=', 7)
                ->orderBy('read', 'asc')
                ->orderBy('uploaded_at', 'desc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($essay) {
                    if (isset($essay->essay_clients->client_by_id)) {
                        $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                            ($essay->essay_clients->client_by_id->first_name) . ' ' . ($essay->essay_clients->client_by_id->last_name) .
                            '</div>';
                    } else {
                        $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                            ($essay->essay_clients->client_by_email->first_name) . ' ' . ($essay->essay_clients->client_by_email->last_name) .
                            '</div>';
                    }
                    return $result;
                })
                ->editColumn('mentor_name', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->essay_clients->mentor->first_name) . ' ' . ($essay->essay_clients->mentor->last_name)  .
                        '</div>';
                    return $result;
                })
                ->editColumn('editor_name', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-')  .
                        '</div>';
                    return $result;
                })
                ->editColumn('program', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->essay_clients->program->program_name)  .
                        '</div>';
                    return $result;
                })
                ->editColumn('title', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        ($essay->essay_clients->essay_title)  .
                        '</div>';
                    return $result;
                })
                ->editColumn('upload_date', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        (date('D, d M Y', strtotime($essay->essay_clients->uploaded_at)))  .
                        '</div>';
                    return $result;
                })
                ->editColumn('essay_deadline', function ($essay) {
                    $diffDeadline = Carbon::parse($essay->essay_clients->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($essay->essay_clients->uploaded_at)->startOfDay());
                    $editors_deadline = Carbon::parse($essay->essay_clients->uploaded_at)->addDays(60 / 100 * $diffDeadline);

                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '">' .
                        (date('D, d M Y', strtotime($editors_deadline)))  .
                        '</div>';
                    return $result;
                })
                ->editColumn('status', function ($essay) {
                    $result =  '<div class="' . ($essay->read == 0 ? 'unread' : '') . '" style="color: var(--green)">' .
                        ($essay->status->status_title)  .
                        '</div>';
                    return $result;
                })
                ->rawColumns(['student_name', 'mentor_name', 'editor_name', 'program', 'title', 'upload_date', 'essay_deadline', 'status'])
                ->make();
        }
    }

    public function detailEssay($id_essay, Request $request)
    {
        $essay = EssayClients::find($id_essay);

        $diffDeadline = Carbon::parse($essay->essay_deadline)->startOfDay()->diffInDays(Carbon::parse($essay->uploaded_at)->startOfDay());
        $editors_deadline = Carbon::parse($essay->uploaded_at)->addDays(60 / 100 * $diffDeadline);

        if ($essay) {
            $editors = Editor::paginate(10);
            $essay = EssayClients::find($id_essay);
            $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();

            if ($essay_editor->read == 0) {
                DB::beginTransaction();
                $essay_editor->read = 1;
                $essay_editor->save();
                DB::commit();
            }


            // Status Uploaded
            if ($essay->status_essay_clients == 0) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "uploaded",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                ]);
            }

            // Status Assigned
            if ($essay->status_essay_clients == 1) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "assigned",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                ]);
            }

            // Status ongoing
            if ($essay->status_essay_clients == 2) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "ongoing",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'tags' => Tags::get()
                ]);
            }

            // Status Submitted
            if ($essay->status_essay_clients == 3) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "submitted",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'editors' => $editors,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            }

            // Status Canceled
            if ($essay->status_essay_clients == 4) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "canceled",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                ]);
            }

            // Status Revise
            if ($essay->status_essay_clients == 6) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => 'revise',
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                    'list_tags' => Tags::get(),
                    'essay_revise' => EssayRevise::where('id_essay_clients', $id_essay)->get()
                ]);
            }

            // Status COMPLETED
            if ($essay->status_essay_clients == 7) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "completed",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay_editor->essay_clients,
                    'essay_editor' => $essay_editor,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                 ]);
            }

            // Status Submitted
            if ($essay->status_essay_clients == 8) {
                return view('user.per-editor.essay-list.essay-detail', [
                    'essay_status' => "revised",
                    'editors_deadline' => $editors_deadline,
                    'essay' => $essay,
                    'editors' => $editors,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            }

        } else {
            return abort(404);
        }
    }

    public function accept($id_essay)
    {
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 2;
            # update status read editor
            $essay->status_read_editor = 0;
            $essay->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 2;
            $essay_editor->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $id_essay;
            $essay_status->status = 2;
            $essay_status->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
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

        // Pusher
        event(new ManagingNotif('Editor accepted your assignment.'));

        $this->sendEmail('accept', $data);

        Log::notice("Essay : " . EssayClients::find($id_essay)->essay_title . " from Client : " . $client->first_name . " " .  $client->last_name . " was accepted by Editor : " . $editor->first_name . " " . $editor->last_name);
        return redirect('editors/essay-list/ongoing/detail/' . $id_essay);
    }

    public function reject($id_essay, Request $request)
    {
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 5;
            # update status read editor
            $essay->status_read_editor = 0;
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
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
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

        // Pusher
        event(new ManagingNotif('Editor rejected your assignment.'));

        $this->sendEmail('reject', $data);

        Log::notice("Essay : " . EssayClients::find($id_essay)->essay_title . " from Client : " . $client->first_name . " " .  $client->last_name . " was rejected by Editor : " . $editor->first_name . " " . $editor->last_name);
        return redirect('editors/essay-list');
    }

    public function sendEmail($type, $data)
    {
        $managing = Editor::where('position', 3)->where('status', 1)->get()->toArray();
        $email = array_column($managing, 'email');

        // $user_token = [
        //     'email' => $email,
        //     'token' => Crypt::encrypt(Str::random(32)),
        //     'activated_at' => time()
        // ];

        // # save token
        // Token::create($user_token);

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
            Mail::send('mail.per-editor.accept-assign', $data, function ($mail) use ($email) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
                $mail->subject('Assignment Accepted');
            });
        } else if ($type == 'uploadEssay') {
            $editor = $data['editor']->first_name . ' ' . $data['editor']->last_name;
            Mail::send('mail.per-editor.editor-upload', $data, function ($mail) use ($email, $editor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                // $mail->cc('essay@all-inedu.com');
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

        // DB::beginTransaction();
        // try {
        $essay = EssayClients::find($id_essay);
        $essay->status_essay_clients = 3;
        # update status read editor
        $essay->status_read_editor = 0;
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
            } else if (isset($essay->client_by_email)) {

                $file_name = 'Editing-' . $essay->client_by_email->first_name . '-' . $essay->client_by_email->last_name . '-Essays-by-' . $essay->essay_editors->editor->first_name . '(' . date('d-m-Y_His') . ')';
            }
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

        // DB::commit();
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     Log::error($e->getMessage());
        //     return Redirect::back()->withErrors($e->getMessage());
        // }

        $editor = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $mentor = Mentor::where('id_mentors', $client->id_mentor)->first();

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay' => $essay,
            'editor' => $editor,
        ];

        // Pusher
        event(new ManagingNotif('The Editor has been submitted, Please verify his/her essay.'));

        $this->sendEmail('uploadEssay', $data);

        Log::notice("Essay : " . EssayClients::find($id_essay)->essay_title . " from Client : " . $client->first_name . " " .  $client->last_name . " was uploaded by Editor : " . $editor->first_name . " " . $editor->last_name);
        return redirect('editors/essay-list/ongoing/detail/' . $id_essay);
    }

    public function addComment($id_essay, Request $request)
    {
        $editor = Auth::guard('web-editor')->user();
        DB::beginTransaction();
        try {

            # update status read editor
            $essay = EssayClients::find($id_essay);
            $essay->status_read_editor = 0;
            $essay->save();

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

        return redirect('editors/essay-list/ongoing/detail/' . $id_essay);
    }

    public function uploadRevise($id_essay, Request $request)
    {
        $rules = [
            'uploaded_file' => 'required|mimes:doc,docx|max:2048',
            'work_duration' => 'required',
            'tag' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id_essay], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 8;
            # update status read editor
            $essay->status_read_editor = 0;
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
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
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

        // Pusher
        event(new ManagingNotif('The Editor has been revised, Please verify his/her essay.'));

        $this->sendEmail('uploadRevise', $data);

        Log::notice("Essay : " . EssayClients::find($id_essay)->essay_title . " from Client : " . $client->first_name . " " .  $client->last_name . " revise was uploaded by Editor : " . $editor->first_name . " " . $editor->last_name);
        return redirect('editors/essay-list/ongoing/detail/' . $id_essay);
    }
}
