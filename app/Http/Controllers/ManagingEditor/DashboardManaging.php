<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Http\Request;

class DashboardManaging extends Controller
{
    public function index(){
        $editor = Auth::guard('web-editor')->user();

        $ongoing_essay = EssayClients::where('id_editors', $editor->id_editors)->where('status_essay_clients', '!=', 7);
        $completed_essay = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 7);

        $duetomorrow = $this->essayDeadline('0', '1');
        $duethree = $this->essayDeadline('1', '3');
        $duefive = $this->essayDeadline('3', '5');

        $allduetomorrow = $this->allEssayDeadline('0', '1');
        $allduethree = $this->allEssayDeadline('1', '3');
        $allduefive = $this->allEssayDeadline('3', '5');

        return view('user.editor.dashboard', [
            'ongoing_essay' => $ongoing_essay->count(),
            'completed_essay' => $completed_essay->count(),
            'duetomorrow' => $duetomorrow,
            'duethree' => $duethree,
            'duefive' => $duefive,
            'allduetomorrow' => $allduetomorrow,
            'allduethree' => $allduethree,
            'allduefive' => $allduefive,
        ]);
    }

    public function essayDeadline($start, $num){
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+'.$start.' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+'.$num.' days', strtotime($today)));
        $editor = Auth::guard('web-editor')->user();
        $essay = EssayEditors::where('editors_mail', '=', $editor->email)->where('status_essay_editors', '!=', 0)->where('status_essay_editors', '!=', 4)->where('status_essay_editors', '!=', 5)->where('status_essay_editors', '!=', 7);
        $essay->whereHas('essay_clients', function ($query) use ($start, $dueDate) {
            $query->where('essay_deadline', '>', $start)->where('essay_deadline', '<=', $dueDate);
        });
        // $essay->where('essay_deadline', '>', $start);
        // $essay->where('essay_deadline', '<=', $dueDate);
        return $essay;
    }


    public function allEssayDeadline($start, $num){
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+'.$start.' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+'.$num.' days', strtotime($today)));
        $essay = EssayClients::where('status_essay_clients', '!=', 7);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay;
    }
}