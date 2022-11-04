<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Admin\Program;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use App\Models\Editor;
use App\Models\EssayClients;
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
use Illuminate\Support\Str;

class NewRequestMenu extends Controller
{
    public function index()
    {
        $mentor = Auth::guard('web-mentor')->user();
        $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->with('mentors')->get();
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
        // $rules = [
        //     'id_program' => 'required',
        //     'id_univ' => 'required',
        //     'id_editors' => 'required',
        //     'essay_title' => 'required',
        //     'essays_prompt' => 'required',
        //     'id_clients' => 'required',
        //     'number_of_words' => 'required',

        //     'essay_deadline' => 'required',
        //     'application_deadline' => 'required',
        //     'essay_title' => 'required',
        //     'file' => 'required|mimes:docx,doc|max:2048'
        // ];

        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return Redirect::back()->withErrors($validator->messages());
        // }
        $id_transaksi = '0';
        $mentor = Auth::guard('web-mentor')->user();
        $student_name =  $request->id_clients;

        $file_student = Client::where('id_clients', '=', $student_name)->first();
        $fileName = $request->attached_of_clients->getClientOriginalName();
        $filePath = 'program/essay/students/' . $fileName;
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
            $new_request->id_clients            = $request->id_clients;
            $new_request->email                 = $file_student->email;
            $new_request->mentors_mail          = $file_student->mentors->email;
            $new_request->essay_deadline        = $request->essay_deadline;
            $new_request->application_deadline  = $request->application_deadline;

            $new_request->attached_of_clients   = $fileName;
            $new_request->status_essay_clients  = 0;
            $new_request->status_read           = 0;
            $new_request->status_read_editor    = 0;
            $new_request->uploaded_at    = date('Y-m-d H:i:s');
            $new_request->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        $client = Client::where('id_clients', $request->id_clients)->first();
        $data = [
            'client' => $client,
            'mentor' => $mentor,
            'essay_title' => $request->essay_title,
            'essay_deadline' => $request->essay_deadline,
            'application_deadline' => $request->application_deadline,
            'university' => University::where('id_univ', $request->id_univ)->first(),
            'essay_prompt' => $request->essay_prompt
        ];

        $this->sendEmail('reject', $data);

        return redirect('/mentor/new-request')->with('add-new-request-successful', 'New request has been saved');
    }

    public function sendEmail($type, $data)
    {
        $managing = Editor::where('position', 3)->get()->toArray();
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
            $mail->cc('essay@all-inedu.com');
            $mail->subject('An essay needs to be assigned!');
        });

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }
    }
}