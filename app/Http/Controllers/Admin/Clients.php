<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class Clients extends Controller
{
    public function index()
    {
        $clients = Client::with('mentors')->orderBy('first_name', 'asc')->paginate(10);
        return view('user.admin.users.user-student', ['clients' => $clients]);
    }
}
