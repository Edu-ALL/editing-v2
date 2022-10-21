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
use App\Models\Programs;
use App\Models\University;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\File; 

class NewRequestMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = Auth::id_mentors();
        // $id = $user->id_mentors;
        // $name = $user->name;
        // $mentor = Auth::guard('web-mentor')->user();
        $mentor = Auth::guard('web-mentor')->user();
        // $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->with('mentors')
        $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->with('mentors')->get();
        // dd($clients);
        $request_editor = Editor::get();
        $university = University::get();
        $program = Programs::where('program_name', '=', 'Essay Editing')->orderBy('program_name', 'asc')->get();
        // dd($program);
        
        return view('user.mentor.new-request', ['clients' => $clients, 
                                                'request_editor' => $request_editor, 
                                                'university' => $university,
                                                'program' => $program],);
        // compact('clients','request_editor','university','program'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
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
        // $student_email = Client::where('id_mentor', '=', $mentor->id_mentors)->with('mentors')->get();
        $student_name =  $request->id_clients;
        $file_student = Client::where('id_clients', '=', $student_name)->first();
        // dd($file_student->email);
        $fileName = $request->attached_of_clients->getClientOriginalName();
        $filePath = 'program/essay/mentors/'.$fileName;
        Storage::disk('public_assets')->put($filePath, file_get_contents($request->attached_of_clients));
        // Storage::disk('public')->url($filePath);

        // dd($path);
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
            // dd($new_request);
            
            $new_request->attached_of_clients   = $fileName;
            $new_request->status_essay_clients  = 0;
            $new_request->status_read           = 0;
            $new_request->status_read_editor    = 0;
            $new_request->uploaded_at    = date('Y-m-d H:i:s');
            $new_request->save();
            DB::commit();

        } catch (Exception $e) {
            // dd($e->getMessage());
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('/mentor/new-request')->with('add-new-request-successful', 'New request has been saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}