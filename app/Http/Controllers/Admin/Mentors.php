<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Mentors extends Controller
{
    public function index(Request $request){
        $keyword = $request->get('keyword');
        $mentors = Mentor::when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%')->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $mentors->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-mentor', ['mentors' => $mentors]);
    }
}
