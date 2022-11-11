<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\EssayClients;
use App\Models\Client;
use App\Models\EssayEditors;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $mentor = Auth::guard('web-mentor')->user();

        $ongoing_essay = EssayClients::where('mentors_mail', '=', $mentor->email)->where('status_essay_clients', '!=', 7);
        $completed_essay = EssayClients::where('mentors_mail', '=', $mentor->email)->where('status_essay_clients', '=', 7);
        $clients = Client::where('id_mentor', '=', $mentor->id_mentors)->orWhere('id_mentor_2', '=', $mentor->id_mentors);
        $new_request = EssayClients::where('status_essay_clients', '=', 0);

        return view('user.mentor.dashboard', [
            'ongoing_essay' => $ongoing_essay->count(),
            'completed_essay' => $completed_essay->count(),
            'clients' => $clients->count(),
            'new_request' => $new_request->count(),
        ]);
    }
}