<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\CRM\Client as CRMClient;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;

class Clients extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $clients = Client::with('mentors')->when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $clients->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-student', ['clients' => $clients]);
    }

    public function detail($id){
        return view('user.admin.users.user-student-detail', [
            'client' => Client::find($id), 
            'mentors' => Mentor::get()
        ]);
    }

    public function updateMentor($id_clients, Request $request){
        DB::beginTransaction();
        try {
            $client = Client::find($id_clients);
            $client->id_mentor = $request->id_mentor;
            $client->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/user/student/detail/'.$id_clients);
    }

    public function updateBackupMentor($id_clients, Request $request){
        DB::beginTransaction();
        try {
            $client = Client::find($id_clients);
            $client->id_mentor_2 = $request->id_mentor_2;
            $client->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/user/student/detail/'.$id_clients);
    }
}
