<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\CRM\Client as CRMClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class Clients extends Controller
{
    public function index(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');
        $clients = Client::with('mentors')->where('id_mentor', '=', $mentor->id_mentors)->orWhere('id_mentor_2', '=', $mentor->id_mentors)->when($keyword, function($query) use ($keyword) {
            // $query->where('first_name', 'like', '%'.$keyword.'%');
            $query->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $clients->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-student', ['clients' => $clients]);
    }
}