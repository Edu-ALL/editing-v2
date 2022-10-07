<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Editor;
use Illuminate\Support\Facades\Auth;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\Mentor;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        return view('user.admin.dashboard', [
            'count_student' => Client::count(),
            'count_mentor' => Mentor::count(),
            'count_editor' => Editor::count(),
            'count_ongoing_essay' => EssayClients::where('status_essay_clients', '!=', 7)->count(),
            'count_completed_essay' => EssayEditors::where('status_essay_editors', '=', 7)->count()
        ]);
    }
}
