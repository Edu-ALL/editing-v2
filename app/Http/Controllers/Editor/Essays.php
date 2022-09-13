<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\EssayClients;
use App\Models\Editor;
use App\Models\EssayEditors;
use App\Models\EssayStatus;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Exception;

class Essays extends Controller
{
    public function index(Request $request){
        $editor = Auth::guard('web-editor')->user();
        $essays = EssayClients::where('id_editors', '=', $editor->id_editors);
        $ongoing_essay = $essays->where('status_essay_clients', '!=', 7)->where('status_essay_clients', '!=', 0)->paginate(10);
        $completed_essay = EssayClients::where('id_editors', '=', $editor->id_editors)->where('status_essay_clients', '=', 7)->paginate(10);

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
                'essay' => EssayClients::find($id_essay),
                'editors' => $editors
            ]);
        } else if ($essay->status_essay_clients == 1) {
            return view('user.per-editor.essay-list.essay-list-ongoing-detail', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 2) {
            return view('user.per-editor.essay-list.essay-list-ongoing-accepted', [
                'essay' => EssayClients::find($id_essay),
                'tags' => Tags::get()
            ]);
        } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 6) {
            return view('user.per-editor.essay-list.essay-ongoing-submitted', [
                'essay' => EssayClients::find($id_essay)
            ]);
        } else if ($essay->status_essay_clients == 7) {
            return view('user.per-editor.essay-list.essay-list-completed-detail', [
                'essay' => EssayClients::find($id_essay)
            ]);
        }
    }

    public function accept($id_essay)
    {
        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id_essay);
            $essay->status_essay_clients = 2;
            $essay->save();

            $essay_editor = EssayEditors::where('id_essay_clients', '=', $id_essay)->first();
            $essay_editor->status_essay_editors = 2;
            $essay_editor->save();

            $essay_status = new EssayStatus;
            $essay_status->id_essay_clients = $id_essay;
            $essay_status->status = 2;
            $essay_status->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('editors/essay-list/ongoing/detail/'.$id_essay);
    }
}
