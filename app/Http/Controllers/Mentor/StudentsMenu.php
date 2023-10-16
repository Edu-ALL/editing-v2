<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\CRM\Client as CRMClient;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class StudentsMenu extends Controller
{
    public function getStudent(Request $request){
        if ($request->ajax()) {
            $mentor = Auth::guard('web-mentor')->user();
            $data = Client::where('id_mentor', '=', $mentor->id_mentors)->orWhere('id_mentor_2', '=', $mentor->id_mentors)->orderBy('first_name', 'asc')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->setRowAttr([
                'onclick' => function($d) {
                    return 'getStudentDetail('.$d->id_clients.')';
                },
            ])
            ->editColumn('student_name', function($d){
                $result = $d->first_name . ' ' . $d->last_name;
                return $result;
            })
            ->editColumn('mentor_name', function($d){
                $result = $d->mentors->first_name . ' ' . $d->mentors->last_name;
                return $result;
            })
            ->editColumn('backup_mentor', function($d){
                $result = isset($d->mentors2) ? $d->mentors2->first_name.' '.$d->mentors2->last_name : '-';
                return $result;
            })
            ->editColumn('email', function($d){
                $result = $d->email ? $d->email : '-';
                return $result;
            })
            ->editColumn('phone', function($d){
                $result = $d->phone ? $d->phone : '-';
                return $result;
            })
            ->editColumn('city', function($d){
                $result = $d->address ? strip_tags($d->address) : '-';
                return $result;
            })
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');

        $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->orWhere('id_mentor_2', '=', $mentor->id_mentors)
        ->when($keyword, function ($query) use ($keyword) {
            $query->where(function($query_) use ($keyword) {
                $query_->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')
                ->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                    $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhere('email', 'like', '%'.$keyword.'%')
                ->orWhereHas('mentors2', function ($query_mentor) use ($keyword) {
                    $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhere('email', 'like', '%'.$keyword.'%')
                ->orWhere('phone', 'like', '%'.$keyword.'%')
                ->orWhere('address', 'like', '%'.$keyword.'%');
            });
        })
        ->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword)
            $clients->appends(['keyword' => $keyword]);

        return view('user.mentor.user-student', ['clients' => $clients]);
    }

    public function detail($id)
    {
        if (!$client = Client::with('mentors')->find($id)) {
            return abort(404);
        }
        return view('user.mentor.user-student-detail',compact('client'));
    }

    // TODO: Check Log
    public function update($id, Request $request)
    {
        $rules = [
            // 'id_essay_clients' => 'required|exists:tbl_essay_clients,id_essay_clients',
            'personal_brand' => 'nullable',
            'interests' => 'nullable',
            'personalities' => 'nullable'
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }
        // $student_name =  $request->id_clients;
        $user = Client::where('id_clients', '=', $id)->first();
        // dd($file_student->email);
        // $user = $id;
        // dd($user->resume);
        // if ($request->hasFile('resume')) {

        // };

        if ($request->hasFile('resume')) {
            if ($old_file_path_resume = $user->resume) {
                $file_path_resume = public_path('uploaded_files/user/students/'.$user->first_name.'/resume'.'/'.$old_file_path_resume);
                // dd($user->resume);
                if (File::exists($file_path_resume)) {
                    File::delete($file_path_resume);
                }
            }
            $resumeFile = $request->resume->getClientOriginalName();
            $filePathresume = 'user/students/'.$user->first_name.'/resume'.'/'.$resumeFile;
            Storage::disk('public_assets')->put($filePathresume, file_get_contents($request->resume));
        }else{
            $resumeFile = $request->resume;
        }


        if ($request->hasFile('questionnaire')) {
            if ($old_file_path_questionnaire = $user->questionnaire) {
                $file_path_questionnaire = public_path('uploaded_files/user/students/'.$user->first_name.'/questionnaire'.'/'.$old_file_path_questionnaire);
                // dd($user->resume);
                if (File::exists($file_path_questionnaire)) {
                    File::delete($file_path_questionnaire);
                }
            }
            $questionnaireFile = $request->questionnaire->getClientOriginalName();
            $filePathquestionnaire = 'user/students/'.$user->first_name.'/questionnaire'.'/'.$questionnaireFile;
            Storage::disk('public_assets')->put($filePathquestionnaire, file_get_contents($request->questionnaire));
        }else{
            $questionnaireFile = $request->questionnaire;
        }


        if ($request->hasFile('others')) {
            if ($old_file_path_others = $user->others) {
                $file_path_others = public_path('uploaded_files/user/students/'.$user->first_name.'/others'.'/'.$old_file_path_others);
                // dd($user->resume);
                if (File::exists($file_path_others)) {
                    File::delete($file_path_others);
                }
            }
            $othersFile = $request->others->getClientOriginalName();
            $filePathothers = 'user/students/'.$user->first_name.'/others'.'/'.$othersFile;
            Storage::disk('public_assets')->put($filePathothers, file_get_contents($request->others));
        }else{
            $othersFile = $request->others;
        }

        // dd($questionnaireFile);

        DB::beginTransaction();
        try {

            $student = Client::find($id);
            $student->personal_brand    = $request->personal_brand;
            $student->interests         = $request->interests;
            $student->personalities     = $request->personalities;
            if ($request->hasFile('resume')) {
                $student->resume = $resumeFile;
            }
            if ($request->hasFile('questionnaire')){
                $student->questionnaire = $questionnaireFile;
            }
            if ($request->hasFile('others')){
                $student->others = $othersFile;
            }
            // if ($request->hasFile('resume')) {
            //     $student->resume            = $resumeFile;
            // }elseif ($request->hasFile('questionnaire')){
            //     $student->questionnaire     = $questionnaireFile;
            // }elseif ($request->hasFile('others')){
            //     $student->others            = $othersFile;
            // };

            // dd($student);
            Log::notice("Client : " . $student->first_name . " " . $student->last_name  . " was updated by Mentor : " . Auth::guard('web-mentor')->user()->first_name . " " . Auth::guard('web-mentor')->user()->last_name);
            $student->save();
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('/mentor/user/student')->with('update-data-successful', 'Data Student has been updated');

        // $client = Client::with('mentors')->find($id);
        // return view('user.mentor.user-student-detail',compact('client'));
    }
}
