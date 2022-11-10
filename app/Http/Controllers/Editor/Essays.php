<?php

namespace App\Http\Controllers\Editor;

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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class Essays extends Controller
{
    public function index(Request $request){
        $editor = Auth::guard('web-editor')->user();
        $keyword1 = $request->get('keyword-ongoing');
        $keyword2 = $request->get('keyword-completed');
        $ongoing_essay = EssayClients::where('id_editors', '=', $editor->id_editors)->where('status_essay_clients', '!=', 7)->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 4)->where('status_essay_clients', '!=', 5)->when($keyword1, function ($query_) use ($keyword1) {
            $query_->where(function ($query) use ($keyword1) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword1) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword1) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword1) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword1.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword1) {
                    $query_program->where('program_name', 'like', '%'.$keyword1.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword1.'%')
                ->orWhereHas('status', function ($query_status) use ($keyword1) {
                    $query_status->where('status_title', 'like', '%'.$keyword1.'%');
                });
            });
        })->orderBy('uploaded_at', 'asc')->paginate(10);
        $completed_essay = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 7)->when($keyword2, function ($query_) use ($keyword2) {
            $query_->where(function ($query) use ($keyword2) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword2) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword2) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword2) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword2) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword2.'%');
                    })->orWhereHas('program', function ($query_program) use ($keyword2) {
                        $query_program->where('program_name', 'like', '%'.$keyword2.'%');
                    })->orWhere('essay_title', 'like', '%'.$keyword2.'%')
                    ->orWhereHas('status', function ($query_status) use ($keyword2) {
                        $query_status->where('status_title', 'like', '%'.$keyword2.'%');
                    });
                });
            });
        })->orderBy('read', 'asc')->orderBy('uploaded_at', 'desc')->paginate(10);

        return view('user.per-editor.essay-list.essay-list', [
            'ongoing_essay' => $ongoing_essay,
            'completed_essay' => $completed_essay,
        ]);
    }

    public function detailEssay($id_essay, Request $request)
    {
        $essay = EssayClients::find($id_essay);
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

            if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4) {
                return view('user.per-editor.essay-list.essay-list-ongoing-detail', [
                    'essay' => $essay,
                    'editors' => $editors
                ]);
            } else if ($essay->status_essay_clients == 1) {
                return view('user.per-editor.essay-list.essay-list-ongoing-detail', [
                    'essay' => $essay
                ]);
            } else if ($essay->status_essay_clients == 2) {
                return view('user.per-editor.essay-list.essay-list-ongoing-accepted', [
                    'essay' => $essay,
                    'tags' => Tags::get()
                ]);
            } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 8) {
                return view('user.per-editor.essay-list.essay-list-ongoing-submitted', [
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            } else if ($essay->status_essay_clients == 6) {
                return view('user.per-editor.essay-list.essay-list-ongoing-revise', [
                    'essay' => $essay,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                    'list_tags' => Tags::get(),
                    'essay_revise' => EssayRevise::where('id_essay_clients', $id_essay)->get()
                ]);
            }
        } else {
            return redirect('editors/essay-list')->with('isEssay', 'Essay not found');
        }
        
    }

    public function detailEssayCompleted($id_essay, Request $request)
    {
        $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();
        if ($essay_editor) {
            // $essay = EssayClients::find($id_essay);
            $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();

            if ($essay_editor->read == 0) {
                DB::beginTransaction();
                $essay_editor->read = 1;
                $essay_editor->save();
                DB::commit();
            }

            if ($essay_editor->status_essay_editors == 7) {
                return view('user.per-editor.essay-list.essay-list-completed-detail', [
                    'essay' => $essay_editor,
                    'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
                ]);
            }
        } else {
            return redirect('editors/essay-list')->with('isEssay', 'Essay not found');
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
        } catch (Exception $e) {
            DB::rollBack();
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

        return redirect('editors/essay-list/ongoing/detail/'.$id_essay);
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
        } catch (Exception $e) {
            DB::rollBack();
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

        return redirect('editors/essay-list');
    }

    public function sendEmail($type, $data)
    {
        // $email = 'editor.dummy@example.com';
        $managing = Editor::where('position', 3)->get()->toArray();
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
            $editor = $data['editor']->first_name.' '.$data['editor']->last_name;
            Mail::send('mail.per-editor.reject-assign', $data, function($mail) use ($email, $editor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
                $mail->subject($editor.' has rejected an essay assignment');
            });
        } else if ($type == 'accept') { # to mentor cc managing
            Mail::send('mail.per-editor.accept-assign', $data, function($mail) use ($email) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
                $mail->subject('Assignment Accepted');
            });
        } else if ($type == 'uploadEssay') {
            $editor = $data['editor']->first_name.' '.$data['editor']->last_name;
            Mail::send('mail.per-editor.editor-upload', $data, function($mail) use ($email, $editor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
                $mail->subject($editor.' has submitted an essay!');
            });
        } else if ($type == 'uploadRevise') {
            $editor = $data['editor']->first_name.' '.$data['editor']->last_name;
            Mail::send('mail.per-editor.editor-revise', $data, function($mail) use ($email, $editor) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
                $mail->subject($editor.' has submitted an essay revision!');
            });
        } else if ($type == 'comment') {
            Mail::send('mail.per-editor.editor-comment', $data, function($mail) use ($email) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($email);
                $mail->cc('essay@all-inedu.com');
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
            'uploaded_file' => 'mimes:doc,docx|max:2048'
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
                    $file_path = public_path('uploaded_files/program/essay/editors'.$old_file_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $file_name = 'Editing-'.$essay->client_by_id->first_name.'-'.$essay->client_by_id->last_name.'-Essays-by-'.$essay->editor->first_name.'('.date('d-m-Y').')';
                $file_name = str_replace(' ', '-', $file_name);
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('program/essay/editors', $file_name.'.'.$file_format, ['disk' => 'public_assets']);
                $essay_editor->attached_of_editors = $file_name.'.'.$file_format;
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
        } catch (Exception $e) {
            DB::rollBack();
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

        return redirect('editors/essay-list/ongoing/detail/'.$id_essay);
    }

    public function addComment($id_essay, Request $request){
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

        return redirect('editors/essay-list/ongoing/detail/'.$id_essay);
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
                    $file_path = public_path('uploaded_files/program/essay/revised'.$old_file_path);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $file_name = 'Revised_by_'.$essay->editor->first_name.'_'.$essay->editor->last_name.'('.date('d-m-Y').')';
                $file_name = str_replace(' ', '_', $file_name);
                $file_format = $request->file('uploaded_file')->getClientOriginalExtension();
                $med_file_path = $request->file('uploaded_file')->storeAs('program/essay/revised', $file_name.'.'.$file_format, ['disk' => 'public_assets']);
                $essay_editor->attached_of_editors = $file_name.'.'.$file_format;
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

        return redirect('editors/essay-list/ongoing/detail/'.$id_essay);
    }
}