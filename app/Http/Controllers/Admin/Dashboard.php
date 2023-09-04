<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Reminder;
use App\Models\Client;
use App\Models\Editor;
use App\Models\Mentor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index(Request $request)
    {

        $query = $request->query();
        $month = $query['active-month'] ??  Carbon::now()->month;
        $year = $query['active-year'] ?? Carbon::now()->year;
        $today = Carbon::now();

        $editorsActive = DB::table('tbl_editors')
            ->join('tbl_essay_editors', 'tbl_editors.email', '=', 'tbl_essay_editors.editors_mail')
            ->select('tbl_editors.email', 'tbl_editors.first_name', 'tbl_editors.last_name', 'tbl_editors.position', DB::raw('COUNT(tbl_essay_editors.status_essay_editors) AS completed_essay'), DB::raw('SUM(tbl_essay_editors.work_duration) AS total_duration'))
            ->where('tbl_essay_editors.status_essay_editors', '=', 7)
            ->whereMonth('tbl_essay_editors.uploaded_at', $month)
            ->whereYear('tbl_essay_editors.uploaded_at', $year)
            ->groupBy('tbl_editors.email')
            ->orderBy('completed_essay', 'desc')
            ->get();

        $essayPerMonth = EssayEditors::whereMonth('uploaded_at', $month)->whereYear('uploaded_at', $year)->count();
        $essayPerMonthCompleted = EssayEditors::where('status_essay_editors', '=', 7)->whereMonth('uploaded_at', $month)->whereYear('uploaded_at', $year)->count();

        $essayAssigned = EssayEditors::where('status_essay_editors', '=', 1)->where('uploaded_at', '<', $today)->orderBy('uploaded_at', 'desc')->get();

        $essaySubmited = EssayEditors::where(function ($query) {
            $query->where('status_essay_editors', '=', 3)
                ->orWhere('status_essay_editors', '=', 8);
        })->where('uploaded_at', '<', $today)->orderBy('uploaded_at', 'desc')->get();

        // Testing Reminder
        // $reminder = new Reminder();
        // $reminder->sendReminderEmailEditor();
        // $reminder->sendReminderEmailManagingEditor();

        return view('user.admin.dashboard', [
            'count_student' => Client::count(),
            'count_mentor' => Mentor::count(),
            'count_editor' => Editor::where('status', '1')->count(),
            'count_ongoing_essay' => EssayClients::where('status_essay_clients', '!=', 7)->count(),
            'count_completed_essay' => EssayEditors::where('status_essay_editors', '=', 7)->count(),
            'editors_active' => $editorsActive,
            'essay_per_month' => $essayPerMonth,
            'essay_per_month_completed' => $essayPerMonthCompleted,
            'date' => ['month' => $month, 'year' => $year],
            'assigned' => $essayAssigned,
            'submited' => $essaySubmited,
        ]);
    }
}
