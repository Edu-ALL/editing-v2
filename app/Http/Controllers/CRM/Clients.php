<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\CRM\Client as CRMClient;
use Illuminate\Support\Facades\Redirect;

class Clients extends Controller
{
    public function syncCRMClients()
    {
        $local_clients = Client::pluck('id_clients')->toArray();
        $crm_clients = CRMClient::withAndWhereHas('student_mentors', function($query) {
            $query->with('mentors')->whereHas('student_programs', function ($query1) {
                $query1->whereHas('programs', function ($query2) {
                    $query2->where('prog_sub', 'Admissions Mentoring')->where('stprog_status', 1);
                });
            })->where('mt_id1', '!=', '')->where('stmentor_id', '>', 0);
        })->whereNotIn('st_num', $local_clients)->get();

        $collection = $crm_clients->map(function ($crm_client) {
            return [
                'id_clients' => $crm_client->st_num,
                'first_name' => $crm_client->st_firstname,
                'last_name' => $crm_client->st_lastname,
                'phone' => $crm_client->st_phone,
                'email' => $crm_client->st_mail,
                'address' => $crm_client->st_address,
                'id_mentor' => $crm_client->student_mentors->first()->mt_id1,
                'mentor_name' => $crm_client->student_mentors->first()->mentors->mt_firstn.' '.$crm_client->student_mentors->first()->mentors->mt_lastn,
                'status' => 1,
                'password' => $crm_client->st_password,
            ];
        });
        
        return response()->json($collection);
    }

    public function doSyncCRMClients()
    {
        $get_new_clients = $this->syncCRMClients();
        $new_clients = $get_new_clients->getData();
        foreach ($new_clients as $new_client) {
            $client = new Client;
            $client->id_clients = $new_client->id_clients;
            $client->first_name = $new_client->first_name;
            $client->last_name = $new_client->last_name;
            $client->phone = $new_client->phone;
            $client->email = $new_client->email;
            $client->address = $new_client->address;
            $client->id_mentor = $new_client->id_mentor;
            $client->status = $new_client->status;
            $client->password = $new_client->password;
            $client->deleted_at = "0000-00-00 00:00:00";
            $client->save();
        }

        return Redirect::to('admin/user/student')->withSuccess('Sync has been completed');
    }
}
