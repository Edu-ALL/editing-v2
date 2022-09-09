<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\EssayClients;
use App\Models\Editor;
use Illuminate\Http\Request;

class Essays extends Controller
{
    public function index(Request $request){
        $ongoing_essay = EssayClients::where('status_essay_clients', '!=', 7)->paginate(10);
        $completed_essay = EssayClients::where('status_essay_clients', '=', 7)->paginate(10);

        return view('user.per-editor.essay-list.essay-list', [
            'ongoing_essay' => $ongoing_essay,
            'completed_essay' => $completed_essay,
        ]);
    }

    public function detailEssay($id_essay, Request $request)
    {
        $editors = Editor::paginate(10);
        $essay = EssayClients::find($id_essay);
        if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4 || $essay->status_essay_clients == 5) {
            return view('user.per-editor.essay-list.essay-list-ongoing-detail', [
                'ongoing' => EssayClients::find($id_essay),
                'editors' => $editors
            ]);
        } else if ($essay->status_essay_clients == 1) {
            return view('user.admin.essay-list.essay-ongoing-assign', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6) {
            return view('user.admin.essay-list.essay-ongoing-submitted', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 7) {
            return view('user.per-editor.essay-list.essay-list-completed-detail', [
                'essay' => EssayClients::find($id_essay)
            ]);
        }
    }
}
