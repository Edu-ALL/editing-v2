<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index(){
        $editor = Editor::where('position', '!=', 3)->find(3);
        return view('user.per-editor.profile.profile', [
            'editor' => $editor
        ]);
    }
}
