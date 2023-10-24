<?php

namespace App\Http\Controllers\Mentor;

use App\Events\ManagingNotif;
use App\Http\Controllers\Admin\Program;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayStatus;
use App\Models\Mentor;
use App\Models\Programs;
use App\Models\University;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NewRequestMenu extends Controller
{
    public function index()
    {
        $mentor = Auth::guard('web-mentor')->user();
        $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->orWhere('id_mentor_2', '=', $mentor->id_mentors)->with('mentors')->get();
        $request_editor = Editor::where('status', '=', '1')->get();
        $university = University::get();
        $program = Programs::where('program_name', '=', 'Essay Editing')->orderBy('program_name', 'asc')->get();

        return view('user.mentor.new-request', [
            'clients' => $clients,
            'request_editor' => $request_editor,
            'university' => $university,
            'program' => $program
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'id_editors' => 'nullable',
            'id_univ' => 'required',
            'id_clients' => 'required',
            'number_of_word' => 'required',
            'essay_title' => 'required',
            'essay_prompt' => 'required',
            'essay_notes' => 'nullable',
            'essay_deadline' => 'required|date',
            'application_deadline' => 'required|date|after:essay_deadline',
            'attached_of_clients' => 'required|mimes:docx,doc|max:2048',
        ];

        $messages = [
            'id_univ.required' => 'The university name is required',
            'id_clients.required' => 'The student name is required',
            'attached_of_clients.required' => 'The uploaded file is required',
            'attached_of_clients.mimes' => 'The uploaded file must be doc / docx',
            'attached_of_clients.max' => 'The uploaded file size must less than 2Mb'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        $id_transaksi = '0';
        $mentor = Auth::guard('web-mentor')->user();
        $mentee_id =  $request->id_clients;

        $client = Client::where('id_clients', '=', $mentee_id)->first();

        $fileName = $request->attached_of_clients->getClientOriginalName();
        $fileExt = $request->attached_of_clients->getClientOriginalExtension();

        $cstFileName = str_replace(' ', '', $client->first_name) . '_Essay_by_' . str_replace(' ', '', $mentor->first_name) . '(' . date('d-m-Y_His') . ').' . $fileExt;
        // $filePath = 'program/essay/mentors/'.$fileName;
        $filePath = 'program/essay/students/' . $cstFileName;
        Storage::disk('public_assets')->put($filePath, file_get_contents($request->attached_of_clients));


        DB::beginTransaction();
        try {
            $new_request = new EssayClients();
            $new_request->id_transaction        = $id_transaksi;
            $new_request->id_program            = $request->number_of_word;
            $new_request->id_univ               = $request->id_univ;
            $new_request->id_editors            = $request->id_editors;
            $new_request->essay_title           = $request->essay_title;
            $new_request->essay_prompt          = $request->essay_prompt;
            $new_request->essay_notes           = $request->essay_notes;
            $new_request->id_clients            = $request->id_clients;
            $new_request->email                 = $client->email;
            // $new_request->mentors_mail          = $client->mentors->email;
            $new_request->mentors_mail          = $mentor->email;
            $new_request->essay_deadline        = $request->essay_deadline;
            $new_request->application_deadline  = $request->application_deadline;
            $new_request->attached_of_clients   = $cstFileName;
            $new_request->status_essay_clients  = 0;
            $new_request->status_read           = 0;
            $new_request->status_read_editor    = 0;
            $new_request->uploaded_at    = date('Y-m-d H:i:s');
            $new_request->save();

            // Insert Essay Status
            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $new_request->id_essay_clients;
            $essay_status->status = 0;
            $essay_status->save();

            Log::notice("Essay : " . $new_request->essay_title . " was added by Mentor : " . Auth::guard('web-mentor')->user()->first_name . " " . Auth::guard('web-mentor')->user()->last_name);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay_title' => $request->essay_title,
            'essay_deadline' => $request->essay_deadline,
            'application_deadline' => $request->application_deadline,
            'university' => University::where('id_univ', $request->id_univ)->first(),
            'essay_prompt' => $request->essay_prompt,
            'essay_notes' => $request->essay_notes,
        ];

        try {

            // Pusher
            event(new ManagingNotif('Mentor has uploaded the essay.'));
        } catch (Exception $e) {

            Log::error('Pusher store new request from mentor : '.$e->getMessage());

        }


        $this->sendEmail('new-request', $data);

        return redirect('/mentor/essay-list/ongoing')->with('message', 'New request has been saved');
    }

    // Check Log
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

        Mail::send('mail.mentor.new-request', $data, function ($mail) use ($email) {
            $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->to($email);
            // $mail->cc('essay@all-inedu.com');
            $mail->subject('An essay needs to be assigned!');
        });

        if (Mail::failures()) {
            Log::error("Send Email by " . $email . " was failed");
            return response()->json(Mail::failures());
        }
    }

    public function mentorUploadEssay(Request $request)
    {
        $rules = [
            'mentors_mail' => 'required|email|exists:tbl_mentors,email',
            'id_editors' => 'nullable',
            'id_univ' => 'required',
            'id_clients' => 'required',
            'number_of_word' => 'required',
            'essay_title' => 'required',
            'essay_prompt' => 'required',
            'essay_notes' => 'nullable',
            'essay_deadline' => 'required|date',
            'application_deadline' => 'required|date|after:essay_deadline',
            'attached_of_clients' => 'required|mimes:docx,doc|max:2048',
        ];

        $messages = [
            'id_univ.required' => 'The university name is required',
            'id_clients.required' => 'The student name is required',
            'attached_of_clients.required' => 'The uploaded file is required',
            'attached_of_clients.mimes' => 'The uploaded file must be doc / docx',
            'attached_of_clients.max' => 'The uploaded file size must less than 2Mb'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 400);
        }

        $id_transaksi = '0';
        $mentor = Mentor::where('email', $request->mentors_mail)->first();
        $mentee_id =  $request->id_clients;

        $client = Client::where('id_clients', '=', $mentee_id)->first();

        $fileName = $request->attached_of_clients->getClientOriginalName();
        $fileExt = $request->attached_of_clients->getClientOriginalExtension();

        $cstFileName = str_replace(' ', '', $client->first_name) . '_Essay_by_' . str_replace(' ', '', $mentor->first_name) . '(' . date('d-m-Y_His') . ').' . $fileExt;
        // $filePath = 'program/essay/mentors/'.$fileName;
        $filePath = 'program/essay/students/' . $cstFileName;
        Storage::disk('public_assets')->put($filePath, file_get_contents($request->attached_of_clients));


        DB::beginTransaction();
        try {
            $new_request = new EssayClients();
            $new_request->id_transaction        = $id_transaksi;
            $new_request->id_program            = $request->number_of_word;
            $new_request->id_univ               = $request->id_univ;
            $new_request->id_editors            = $request->id_editors;
            $new_request->essay_title           = $request->essay_title;
            $new_request->essay_prompt          = $request->essay_prompt;
            $new_request->essay_notes           = $request->essay_notes;
            $new_request->id_clients            = $request->id_clients;
            $new_request->email                 = $client->email;
            // $new_request->mentors_mail          = $client->mentors->email;
            $new_request->mentors_mail          = $mentor->email;
            $new_request->essay_deadline        = $request->essay_deadline;
            $new_request->application_deadline  = $request->application_deadline;

            $new_request->attached_of_clients   = $cstFileName;
            $new_request->status_essay_clients  = 0;
            $new_request->status_read           = 0;
            $new_request->status_read_editor    = 0;
            $new_request->uploaded_at    = date('Y-m-d H:i:s');
            $new_request->save();

            Log::notice("Essay : " . $new_request->title . " was uploaded by Mentor : " . Auth::guard('web-mentor')->user()->first_name . " " . Auth::guard('web-mentor')->user()->last_name);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            // return Redirect::back()->withErrors($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to store new request. Please try again.']);
        }

        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay_title' => $request->essay_title,
            'essay_deadline' => $request->essay_deadline,
            'application_deadline' => $request->application_deadline,
            'university' => University::where('id_univ', $request->id_univ)->first(),
            'essay_prompt' => $request->essay_prompt,
            'essay_notes' => $request->essay_notes,
        ];

        try {

            // Pusher
            event(new ManagingNotif('Mentor has uploaded the essay.'));
        } catch (Exception $e) {

            // Log::error('Pusher store new request from mentor : ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to store new request. Please try again.']);
        }


        $this->sendEmail('new-request', $data);

        // return redirect('/mentor/essay-list/ongoing')->with('message', 'New request has been saved');
        return response()->json(['success' => true, 'message' => 'New request has been saved']);
    }
}
