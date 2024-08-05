<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\CRM\Client as CRMClient;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\Log;

class Clients extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $clients = Client::with('mentors')->when($keyword, function($query) use ($keyword) {
            $query->where(DB::raw("CONCAT(`first_name`, ' ',COALESCE(`last_name`, ''))"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`, ' ',COALESCE(`last_name`, ''))"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $clients->appends(['keyword' => $keyword]);

        return view('user.admin.users.user-student', ['clients' => $clients]);
    }

    public function getStudent(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::with(['mentors', 'mentors2'])->orderBy('first_name', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($client) {
                    $result = $client->first_name . ' ' . $client->last_name;
                    return " " . $result . " ";
                })
                ->editColumn('mentor_name', function ($client) {
                    $result = $client->mentors->first_name . ' ' . $client->mentors->last_name;
                    return " " . $result . " ";
                })
                ->editColumn('backup_mentor', function ($client) {
                    $result = $client->mentors2 ? $client->mentors2->first_name . ' ' . $client->mentors2->last_name : '-';
                    return " " . $result . " ";
                })
                ->editColumn('email', function ($client) {
                    $result = $client->email ? $client->email : '-';
                    return " " . $result . " ";
                })
                ->editColumn('phone', function ($client) {
                    $result = $client->phone ? $client->phone : '-';
                    return " " . $result . " ";
                })
                ->editColumn('city', function ($client) {
                    $result = $client->address ? strip_tags($client->address) : '-';
                    return " " . $result . " ";
                })
                ->rawColumns(['student_name', 'mentor_name', 'backup_mentor', 'email', 'phone', 'city'])
                ->make();
        }
    }

    public function detail($id)
    {
        if (!Client::find($id)) {
            return abort(404);
        }
        return view('user.admin.users.user-student-detail', [
            'client' => Client::find($id),
            'mentors' => Mentor::get()
        ]);
    }

    public function updateStatus($id_clients, Request $request)
    {
        DB::beginTransaction();
        try {
            $client = Client::find($id_clients);
            $client->status = $request->status;
            $client->save();
            DB::commit();
            Log::notice('Status has been successfully update : '.$client->first_name.' '.$client->last_name);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to change status : '.$e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to change status. Please try again.']);
        }

        return response()->json(['success' => true, 'message' => 'Status has been changed']);
    }

    public function updateMentor($id_clients, Request $request)
    {
        DB::beginTransaction();
        try {
            $client = Client::find($id_clients);
            $client->id_mentor = $request->id_mentor;
            $client->save();
            DB::commit();
            Log::notice('Mentor : '.Mentor::find($client->id_mentor)->first_name.' '.Mentor::find($client->id_mentor)->last_name.'  was set as a Mentor for Student : '.$client->first_name.' '.$client->last_name);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to assign Student Mentor : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/user/student/detail/' . $id_clients);
    }

    public function updateBackupMentor($id_clients, Request $request)
    {
        DB::beginTransaction();
        try {
            $client = Client::find($id_clients);
            $client->id_mentor_2 = $request->id_mentor_2;
            $client->save();
            DB::commit();
            Log::notice('Mentor : '.Mentor::find($client->id_mentor_2)->first_name.' '.Mentor::find($client->id_mentor_2)->last_name.'  was set as a Backup Mentor for Client : '.$client->first_name.' '.$client->last_name);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to assign Student Backup Mentor : '.$e->getMessage());
            return Redirect::back()->withErrors($e->getMessage());
        }
        return redirect('admin/user/student/detail/' . $id_clients);
    }
}
