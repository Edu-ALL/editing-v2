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
use Exception;

class StudentsMenu extends Controller
{
    public function index(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');
        $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->with('mentors')->when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $clients->appends(['keyword' => $keyword]);

        return view('user.mentor.user-student', ['clients' => $clients]);
    }

    public function detail($id)
    {
        $client = Client::with('mentors')->find($id);

        
        return view('user.mentor.user-student-detail',compact('client'));
    }

    public function update($id, Request $request)
    {
        $rules = [
            'id_essay_clients' => 'required|exists:tbl_essay_clients,id_essay_clients',
            'personal_brand' => 'required',
            'interests' => 'required',
            'personalities' => 'required'
        ];

        $validator = Validator::make($request->all() + ['id_essay_clients' => $id], $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator->messages());
        }

        DB::beginTransaction();
        try {

            $student = Client::find($id);
            $student->personal_brand = $request->personal_brand;
            $student->interests = $request->interests;
            $student->personalities = $request->personalities;
            $student->save();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());

        }

        return redirect('admin/setting/categories-tags')->with('update-tag-successful', 'The tag has been updated');

        $client = Client::with('mentors')->find($id);
        return view('user.mentor.user-student-detail',compact('client'));
    }
}