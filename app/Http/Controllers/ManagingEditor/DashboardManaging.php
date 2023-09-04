<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Editor;
use Illuminate\Support\Facades\Auth;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\Mentor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardManaging extends Controller
{
    public function getEditorActiveDuration(Request $request){
        if ($request->ajax()) {
            $query = $request->query();
            $month = $query['active-month'] ??  Carbon::now()->month;
            $year = $query['active-year'] ?? Carbon::now()->year;
            $data = DB::table('tbl_editors')
                ->join('tbl_essay_editors', 'tbl_editors.email', '=', 'tbl_essay_editors.editors_mail')
                ->select('tbl_editors.email', 'tbl_editors.first_name', 'tbl_editors.last_name', 'tbl_editors.position', DB::raw('COUNT(tbl_essay_editors.status_essay_editors) AS completed_essay'), DB::raw('SUM(tbl_essay_editors.work_duration) AS total_duration'))
                ->where('tbl_essay_editors.status_essay_editors', '=', 7)
                ->whereMonth('tbl_essay_editors.uploaded_at', $month)
                ->whereYear('tbl_essay_editors.uploaded_at', $year)
                ->groupBy('tbl_editors.email')
                ->orderBy('completed_essay', 'desc')
                ->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('editor_name', function($d){
                $result = $d->first_name . ' ' . $d->last_name;
                return $result;
            })
            ->editColumn('position', function($d){
                if ($d->position == 1) {
                    $result = 'Associate';
                } else if ($d->position == 2) {
                    $result = 'Senior';
                } else if ($d->position == 3) {
                    $result = 'Managing';
                }
                return $result;
            })
            ->make(true);
        }
    }

    public function index(Request $request)
    {
        $today = Carbon::now();
        $editor = Auth::guard('web-editor')->user();

        $ongoing_essay = EssayClients::where('status_essay_clients', '!=', 7);
        $completed_essay = EssayEditors::where('status_essay_editors', '=', 7);
        $your_essay_ongoing = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '!=', 7);
        $your_essay_completed = EssayEditors::where('editors_mail', $editor->email)->where('status_essay_editors', '=', 7);

        $duetomorrow = $this->essayDeadline('0', '1');
        $duethree = $this->essayDeadline('2', '3');
        $duefive = $this->essayDeadline('4', '5');

        $allduetomorrow = $this->allEssayDeadline('0', '1');
        $allduethree = $this->allEssayDeadline('2', '3');
        $allduefive = $this->allEssayDeadline('4', '5');

        $query = $request->query();
        $month = $query['active-month'] ??  Carbon::now()->month;
        $year = $query['active-year'] ?? Carbon::now()->year;

        $essayPerMonth = EssayEditors::whereMonth('uploaded_at', $month)->whereYear('uploaded_at', $year)->count();
        $essayPerMonthCompleted = EssayEditors::where('status_essay_editors', '=', 7)->whereMonth('uploaded_at', $month)->whereYear('uploaded_at', $year)->count();
    
        $essayAssigned = EssayEditors::where('status_essay_editors', '=', 1)->where('uploaded_at', '<', $today)->orderBy('uploaded_at', 'desc')->get();


        $essaySubmited = EssayEditors::where(function ($query) {
            $query->where('status_essay_editors', '=', 3)
                ->orWhere('status_essay_editors', '=', 8);
        })->where('uploaded_at', '<', $today)->orderBy('uploaded_at', 'desc')->get();
       
        return view('user.editor.dashboard', [
            'ongoing_essay' => $ongoing_essay->count(),
            'completed_essay' => $completed_essay->count(),
            'your_essay_ongoing' => $your_essay_ongoing->count(),
            'your_essay_completed' => $your_essay_completed->count(),
            'duetomorrow' => $duetomorrow,
            'duethree' => $duethree,
            'duefive' => $duefive,
            'allduetomorrow' => $allduetomorrow,
            'allduethree' => $allduethree,
            'allduefive' => $allduefive,
            'count_student' => Client::count(),
            'count_mentor' => Mentor::count(),
            'count_editor' => Editor::where('status', '1')->count(),
            'count_ongoing_essay' => EssayClients::where('status_essay_clients', '!=', 7)->count(),
            'count_completed_essay' => EssayEditors::where('status_essay_editors', '=', 7)->count(),
            'essay_per_month' => $essayPerMonth,
            'essay_per_month_completed' => $essayPerMonthCompleted,
            'date' => ['month' => $month, 'year' => $year],
            'assigned' => $essayAssigned,
            'submited' => $essaySubmited,
        ]);
    }

    public function essayDeadline($start, $num)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $editor = Auth::guard('web-editor')->user();
        $essay = EssayEditors::where('editors_mail', '=', $editor->email)->where('status_essay_editors', '!=', 0)->where('status_essay_editors', '!=', 4)->where('status_essay_editors', '!=', 5)->where('status_essay_editors', '!=', 7);
        $essay->whereHas('essay_clients', function ($query) use ($start, $dueDate) {
            $query->whereBetween('essay_deadline', [$start, $dueDate]);
        });
        return $essay;
    }

    public function allEssayDeadline($start, $num)
    {
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+' . $start . ' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+' . $num . ' days', strtotime($today)));
        $essay = EssayClients::where('status_essay_clients', '!=', 7)->whereBetween('essay_deadline', [$start, $dueDate]);
        return $essay;
    }
}
