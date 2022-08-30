<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programs;
use Illuminate\Http\Request;

class Program extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $programs = Programs::when($keyword, function($query) use ($keyword) {
            $query->where('program_name', 'like', '%'.$keyword.'%');
        })->orderBy('program_name', 'asc')->paginate(10);

        if ($keyword)
            $programs->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-programs', ['programs' => $programs]);
    }

    public function detail($id){
        return view('user.admin.settings.setting-detail-programs', ['program' => Programs::find($id)]);
    }
}
