<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EssaysMenu extends Controller
{
    public function index(Request $request)
    {
        $mentor = Auth::guard('web-mentor')->user();
        $keyword = $request->get('keyword');
        $essays = EssayClients::where('mentors_mail', '=', $mentor->email)->with(['status', 'editor', 'university', 'program', 'program.category', 'client_by_id', 'client_by_email', 'client_by_id.mentors', 'client_by_email.mentors'])->where('status_essay_clients', '!=', 7)->paginate(10);
// dd($essays);
        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        return view('user.mentor.essay-completed', ['essays' => $essays]);
    }
}