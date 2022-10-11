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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $rules = [
            'id_program' => 'required',
            'id_univ' => 'required',
            'id_editors' => 'required',
            'essay_title' => 'required',
            'essays_prompt' => 'required',
            'id_clients' => 'required',
            'number_of_words' => 'required',
            
            'essay_deadline' => 'required',
            'application_deadline' => 'required',
            'essay_title' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }
        $id_transaksi = '0';
        $mentor = Auth::guard('web-mentor')->user();
        $student_email = Client::where('id_mentor', '=', $mentor->id_mentors)->with('mentors')->get();
        $data = [
            'id_essay_clients' => $id_essay,
            'id_transaction' => $code,
            'id_program' => $this->input->post('words'),
            'id_univ' => $this->input->post('univ_name'),
            'id_editors' => $this->input->post('id_editors'),
            'essay_title' => $title,
            'essay_prompt' => $this->input->post('essay_prompt'),
            'id_clients' => $this->input->post('student_id'),
            'email' => $student_mail,
            'mentors_mail' => $this->session->userdata('email'),
            'essay_deadline' => $this->input->post('essay_deadline'),
            'application_deadline' => $this->input->post('app_deadline'),
            'attached_of_clients' => $new_files,
            'uploaded_at' => date('Y-m-d H:i:s'),
        ];


        DB::beginTransaction();
        try {
            $new_request = new EssayClients();
            $new_request->id_transaction = $id_transaksi;
            $new_request->id_program = $request->id_program;
            $new_request->id_univ = $request->id_univ;
            $new_request->id_editors = $request->id_editors;
            $new_request->essay_title = $request->essay_title;
            $new_request->email = $student_email->email;
            $new_request->client_by_id = $request->client_by_id;
            $new_request->status = 0;
            $new_request->save();
            DB::commit();

        } catch (Exception $e) {
            
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