<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StudentsMenu extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $clients = Client::with('mentors')->when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $clients->appends(['keyword' => $keyword]);

        return view('user.mentor.user-student', ['clients' => $clients]);
    }

    public function detail($id){
        return view('user.mentor.user-student-detail', ['client' => Client::find($id)]);
    }
}