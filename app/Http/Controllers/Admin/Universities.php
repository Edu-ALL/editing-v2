<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class Universities extends Controller
{
    public function index(){
        $universities = University::orderBy('university_name', 'asc')->paginate(10);
        // dd($universities);
        return view('user.admin.settings.setting-universities', ['universities' => $universities]);
    }

    public function detail($id){
        return view('user.admin.settings.setting-detail-universities', ['university' => University::find($id)]);
    }
}
