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
        $id = Auth::id();
        $client = Client::where('id_mentor' || 'id_mentor_2', '=', $id);
        // dd($client);
        $request_editor = Editor::get();
        $university = University::get();
        $program = Programs::where('program_name', '=', 'Essay Editing')->orderBy('program_name', 'asc')->get();
        // dd($program);
        
        return view('user.mentor.new-request',compact('client','request_editor','university','program'));
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
            'essay_title' => 'required',
            'id_editors' => 'required',
            'id_univ' => 'required',
            'id_clients' => 'required',
            'number_of_words' => 'required',
            'essay_title' => 'required',
            'essays_prompt' => 'required',
            'essay_deadline' => 'required',
            'application_deadline' => 'required',
            'essay_title' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {
            $new_request = new EssayClients();
            $new_request->first_name = $request->first_name;
            $new_request->last_name = $request->last_name;
            $new_request->phone = $request->phone;
            $new_request->email = $request->email;
            $new_request->graduated_from = $request->graduated_from;
            $new_request->major = $request->major;
            $new_request->address = $request->address;
            $new_request->client_by_id = $request->client_by_id;
            $new_request->image = "default.png";
            $new_request->password = Hash::make(12345678);
            $new_request->status = 1;
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