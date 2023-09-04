<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Dashboard extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $editor = Auth::guard('web-editor')->user();

        $ongoing_essay = EssayClients::where('id_editors', $editor->id_editors)->where('status_essay_clients', '!=', 7)->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 5);
        $completed_essay = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 7);

        $duetomorrow = $this->essayDeadline('0', '1');
        $duethree = $this->essayDeadline('1', '3');
        $duefive = $this->essayDeadline('3', '5');

        $essayAssigned = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 1)->where('uploaded_at', '<', $today)->get();

        return view('user.per-editor.dashboard', [
            'ongoing_essay' => $ongoing_essay->count(),
            'completed_essay' => $completed_essay->count(),
            'duetomorrow' => $duetomorrow,
            'duethree' => $duethree,
            'duefive' => $duefive,
            'assigned' => $essayAssigned,
        ]);
    }

    public function essayDeadline($start, $num)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $editor = Auth::guard('web-editor')->user();
        $essay = EssayClients::where('id_editors', '=', $editor->id_editors)->where('status_essay_clients', '!=', 7)->where('status_essay_clients', '!=', 0)->where('status_essay_clients', '!=', 5);
        // $essay->whereBetween('essay_deadline', [$start, $dueDate]);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay;
    }
}
