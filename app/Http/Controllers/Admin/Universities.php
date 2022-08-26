<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;

class Universities extends Controller
{
    public function index()
    {
        $universities = University::orderBy('university_name', 'asc')->paginate(10);
        return view('user.admin.settings.setting-universities', ['universities' => $universities]);
        
    }
}
