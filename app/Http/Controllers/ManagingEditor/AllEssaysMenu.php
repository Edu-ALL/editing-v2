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
use App\Models\Mentor;
use App\Models\Tags;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
    public function assignList(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayEditors::where('status_essay_editors', 1)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%' . $keyword . '%');
                    })->orWhere('essay_title', 'like', '%' . $keyword . '%')
                        ->orWhereHas('status', function ($query_status) use ($keyword) {
                            $query_status->where('status_title', 'like', '%' . $keyword . '%');
                        });
                });
            });
        // })->orderBy('uploaded_at', 'desc')->paginate(10);
        })->orderBy('essay_deadline', 'asc')->orderBy('application_deadline', 'asc')->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);
        // dd($essays);
        return view('user.editor.all-essays.essay-assign', ['essays' => $essays]);
    }

    public function notAssignList(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayClients::where('status_essay_clients', 0)->orWhere('status_essay_clients', 4)->orWhere('status_essay_clients', 5)
            ->when($keyword, function ($query_) use ($keyword) {
                $query_->where(function ($query) use ($keyword) {
                    $query->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%' . $keyword . '%');
                    })->orWhere('essay_title', 'like', '%' . $keyword . '%')
                        ->orWhereHas('status', function ($query_status) use ($keyword) {
                            $query_status->where('status_title', 'like', '%' . $keyword . '%');
                        });
                });
            // })->orderBy('uploaded_at', 'desc')->paginate(10);
            })->orderBy('essay_deadline', 'asc')->orderBy('application_deadline', 'asc')->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.essay-not-assign', ['essays' => $essays]);
    }

    public function ongoingList(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayEditors::where('status_essay_editors', 2)->orWhere('status_essay_editors', 3)->orWhere('status_essay_editors', 6)->orWhere('status_essay_editors', 8)
            ->when($keyword, function ($query_) use ($keyword) {
                $query_->where(function ($query) use ($keyword) {
                    $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                        $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                            $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                                $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                            });;
                        })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                            $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                        })->orWhereHas('program', function ($query_program) use ($keyword) {
                            $query_program->where('program_name', 'like', '%' . $keyword . '%');
                        })->orWhere('essay_title', 'like', '%' . $keyword . '%')
                            ->orWhereHas('status', function ($query_status) use ($keyword) {
                                $query_status->where('status_title', 'like', '%' . $keyword . '%');
                            });
                    });
                });
            // })->orderBy('uploaded_at', 'desc')->paginate(10);
            })->orderBy('tbl_essay_clients.essay_deadline', 'asc')->orderBy('tbl_essay_clients.application_deadline', 'asc')->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.essay-ongoing', ['essays' => $essays]);
    }

    public function essayCompleted(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayEditors::where('status_essay_editors', 7)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%' . $keyword . '%');
                    })->orWhere('essay_title', 'like', '%' . $keyword . '%')
                        ->orWhereHas('status', function ($query_status) use ($keyword) {
                            $query_status->where('status_title', 'like', '%' . $keyword . '%');
                        });
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.essay-completed', ['essays' => $essays]);
    }

    public function dueEssayEditor($start, $num)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $essay = EssayClients::where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 4)->where('status_essay_clients', '!=', 5)->where('status_essay_clients', '!=', 7);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay->get();
    }

    public function detailEssayManaging($id_essay, Request $request)
    {
        $essay = EssayClients::find($id_essay);
        if ($essay) {
            $editors = Editor::get();
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

            if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5) {
                return view('user.editor.all-essays.essay-ongoing-detail', [
                    'essay' => $essay,
                    'editors' => $editors,
                    'dueTomorrow' => $this->dueEssayEditor('0', '1'),
                    'dueThree' => $this->dueEssayEditor('1', '3'),
                    'dueFive' => $this->dueEssayEditor('3', '5'),
                    'completedEssay' => EssayEditors::where('status_essay_editors', 7)->get()
                ]);
            } else if ($essay->status_essay_clients == 1) {
                return view('user.editor.all-essays.essay-ongoing-assign', [
                    'essay' => $essay
                ]);
            } else if ($essay->status_essay_clients == 2) {
                return view('user.editor.all-essays.essay-ongoing-ongoing', [
                    'essay' => $essay
                ]);
            } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6 || $essay->status_essay_clients == 8) {
                return view('user.editor.all-essays.essay-ongoing-submitted', [
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                    'list_tags' => Tags::get(),
                    'essay_revise' => EssayRevise::where('id_essay_clients', $id_essay)->get()
                ]);
            }
        } else {
            return redirect('editor/all-essays')->with('isEssay', 'Essay not found');
        }
    }

    public function detailEssayManagingCompleted($id_essay, Request $request)
    {
        $essay = EssayEditors::where('id_essay_clients', $id_essay)->first();
        if ($essay) {
            // $essay = EssayEditors::where('id_essay_clients', $id_essay)->first();
            $essay_client = EssayClients::where('id_essay_clients', $id_essay)->first();
            if ($essay_client->essay_deadline > $essay->uploaded_at) {
                $status_essay = 'On Time';
            } else {
                $status_essay = 'Late';
            }
            return view('user.editor.all-essays.essay-completed-detail', [
                'essay' => $essay,
                'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                'feedback' => EssayFeedbacks::where('id_essay_clients', $id_essay)->first(),
                'status_essay' => $status_essay
            ]);
        } else {
            return redirect('editor/all-essays');
        }
    }

    public function assignEditor($id_essay, Request $request)
    {
        # managing editor data
        $managing_name = Auth::guard('web-editor')->user()->first_name . ' ' . Auth::guard('web-editor')->user()->last_name;

        # get associate editor data
        $editor = Editor::find($request->id_editors);


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
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }


        $editors_mail = $essay->editor->email;

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
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 4;
            $essay->save();

            EssayEditors::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $essay->id_essay_clients;
            $essay_status->status = 4;
            $essay_status->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        $managing = Auth::guard('web-editor')->user();
        $client = Client::where('id_clients', $essay->id_clients)->first();
        $editor = Editor::where('id_editors', $essay->id_editors)->first();
        $email = $essay->editor->email;

        $data = [
            'managing' => $managing,
            'essay' => $essay,
            'client' => $client,
            'editor' => $editor
        ];

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
                $file_name = 'Revised_by_' . $editor->first_name . '_' . $editor->last_name . '(' . date('d-m-Y') . ')';
                // $file_name = str_replace(' ', '-', $file_name);
                $file_format = $request->file('uploaded_acc_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_acc_file')->storeAs('program/essay/revised', $file_name.'.'.$file_format, ['disk' => 'public_assets']);
                $essay_editor->managing_file = $file_name.'.'.$file_format;
            }
            $essay_editor->save();

            // Pusher 
            event(new EditorNotif($essay_editor->editors_mail, 'Congratulations, your essay has been completed.'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
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
            dd($validator->messages());
            return Redirect::back()->withErrors($validator->messages());
        }

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
            $essay_revise->admin_mail = $managing->email;
            $essay_revise->role = 'managing_editor';
            $essay_revise->notes = $request->notes;
            // Upload Revise File
            if ($request->hasFile('uploaded_revise_file')) {
                $file_name = 'Revise-' . date('d-m-Y');
                $file_name = str_replace(' ', '-', $file_name);
                $file_format = $request->file('uploaded_revise_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_revise_file')->storeAs('program/essay/revise', $file_name . '.' . $file_format, ['disk' => 'public_assets']);
                $essay_revise->file = $file_name . '.' . $file_format;
            }
            $essay_revise->created_at = date('Y-m-d H:i:s');
            $essay_revise->save();

            // Pusher 
            event(new EditorNotif($essay_editor->editors_mail, 'Please, revise your essay.'));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        $email = $essay_editor->editors_mail;
        $essay = EssayClients::find($id_essay);
        $editor = Editor::where('id_editors', $essay->id_editors)->first();
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
        } catch (Exception $e) {
            DB::rollBack();
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
                $mail->cc('essay@all-inedu.com');
                $mail->subject('One of your assignments has been canceled');
            });
        } else if ($type == 'verify') {
            Mail::send('mail.complete-essay', $data, function ($mail) use ($email, $data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
                $mail->subject('Your Essay is Complete');
            });
        } else if ($type == 'revise') {
            Mail::send('mail.revise-essay', $data, function ($mail) use ($email, $data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
                $mail->subject($data['client']->first_name . ' ' . $data['client']->last_name . '`s essay, ' . $data['essay']->essay_title . ', needs further revision');
            });
        } else if ($type == 'send_email') {
            Mail::send('mail.send-essay', $data, function ($mail) use ($email, $data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
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
        $essay = EssayClients::where('status_essay_clients', '!=', 7);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay;
    }
    public function dueTomorrow(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = $this->allEssayDeadline('0', '1')->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%' . $keyword . '%');
                })->orWhere('essay_title', 'like', '%' . $keyword . '%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%' . $keyword . '%');
                });
            });
        })->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.editor-list-due-tomorrow', ['essays' => $essays]);
    }
    public function dueThree(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = $this->allEssayDeadline('1', '3')->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%' . $keyword . '%');
                })->orWhere('essay_title', 'like', '%' . $keyword . '%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%' . $keyword . '%');
                });
            });
        })->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.editor-list-due-within-three', ['essays' => $essays]);
    }
    public function dueFive(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = $this->allEssayDeadline('3', '5')->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%' . $keyword . '%');
                })->orWhere('essay_title', 'like', '%' . $keyword . '%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%' . $keyword . '%');
                });
            });
        })->paginate(10);

        if ($keyword)
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.editor-list-due-within-five', ['essays' => $essays]);
    }
}