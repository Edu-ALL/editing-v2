<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class Universities extends Controller
{

    public function detail($id){
        return view('user.admin.settings.setting-detail-universities', ['university' => University::find($id)]);
    }

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $universities = University::when($keyword, function($query) use ($keyword) {
            $query->where('university_name', 'like', '%'.$keyword.'%')->
                orWhere('website', 'like', '%'.$keyword.'%')->
                orWhere('univ_email', 'like', '%'.$keyword.'%')->
                orWhere('country', 'like', '%'.$keyword.'%')->
                orWhere('phone', 'like', '%'.$keyword.'%')->
                orWhere('address', 'like', '%'.$keyword.'%');
        })->orderBy('university_name', 'asc')->paginate(10);

        if ($keyword)
            $universities->appends(['keyword' => $keyword]);

        return view('user.admin.settings.setting-universities', ['universities' => $universities]);
    }
}
