<?php

namespace App\Http\Controllers\Admin;

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

class Dashboard extends Controller
{
    public function index(Request $request)
    {

        $query = $request->query();
        $month = $query['active-month'] ??  Carbon::now()->month;
        $year = $query['active-year'] ?? Carbon::now()->year;

        $editorsActive = DB::table('tbl_editors')
            ->join('tbl_essay_editors', 'tbl_editors.email', '=', 'tbl_essay_editors.editors_mail')
            ->select('tbl_editors.email', 'tbl_editors.first_name', 'tbl_editors.last_name', 'tbl_editors.position', DB::raw('COUNT(tbl_essay_editors.status_essay_editors) AS completed_essay'), DB::raw('SUM(tbl_essay_editors.work_duration) AS total_duration'))
            ->where('tbl_essay_editors.status_essay_editors', '=', 7)
            ->whereMonth('tbl_essay_editors.uploaded_at', $month)
            ->whereYear('tbl_essay_editors.uploaded_at', $year)
            ->groupBy('tbl_editors.email')
            ->orderBy('completed_essay', 'desc')
            ->paginate(5);

        return view('user.admin.dashboard', [
            'count_student' => Client::count(),
            'count_mentor' => Mentor::count(),
            'count_editor' => Editor::count(),
            'count_ongoing_essay' => EssayClients::where('status_essay_clients', '!=', 7)->count(),
            'count_completed_essay' => EssayEditors::where('status_essay_editors', '=', 7)->count(),
            'editors_active' => $editorsActive,
            'date' => ['month' => $month, 'year' => $year]
        ]);
    }
}
