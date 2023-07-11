<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class Mentors extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $mentors = Mentor::when($keyword, function ($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword)
            $mentors->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-mentor', ['mentors' => $mentors]);
    }

    public function getMentor(Request $request)
    {
        if ($request->ajax()) {
            $data = Mentor::orderBy('first_name', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($mentor) {
                    $result = $mentor->first_name . ' ' . $mentor->last_name;
                    return " " . $result . " ";
                })
                ->editColumn('email', function ($mentor) {
                    $result = $mentor->email ? $mentor->email : '-';
                    return " " . $result . " ";
                })
                ->editColumn('phone', function ($mentor) {
                    $result = $mentor->phone ? $mentor->phone : '-';
                    return " " . $result . " ";
                })
                ->editColumn('address', function ($mentor) {
                    $result = $mentor->address ? strip_tags($mentor->address) : '-';
                    return " " . $result . " ";
                })
                ->rawColumns(['name', 'email', 'phone', 'address'])
                ->make();
        }
    }
}
