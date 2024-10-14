<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\CRM\Client as CRMClient;
use App\Models\CRM_V2\Client as CRMV2Client;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class Clients extends Controller
{
    // crm version 1 //
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
    // crm version 1 end //

    // crm version 2 //
    public function syncCRMV2Clients()
    {
        $crm_host = 'https://crm-allinedu.com';
        $response = Http::get($crm_host.'/api/v1/get/mentees');
        $crm_mentees = collect(json_decode($response)->data);
        $collection = [];

        $local_clients_fullname = Client::select(DB::raw('(CASE WHEN last_name IS NULL THEN first_name ELSE CONCAT(first_name, " ", last_name) END) as fullname'))->pluck('fullname')->toArray();

        $new_mentees = $crm_mentees->whereNotIn('full_name', $local_clients_fullname);

        foreach ($new_mentees as $new_mentee) {

            if (count($new_mentee->client_program[0]->client_mentor) > 0) {

                if ($new_mentee->id == 505)
                    $ids = 10428;
                else
                    $ids = $new_mentee->id;
                    
                $collection[] = [
                    'id_clients' => $ids,
                    'first_name' => $new_mentee->first_name,
                    'last_name' => $new_mentee->last_name,
                    'phone' => $new_mentee->phone,
                    'email' => $new_mentee->mail ?? null,
                    'address' => $new_mentee->address,
                    'id_mentor' => $new_mentee->client_program[0]->client_mentor[0]->roles[0]->pivot->extended_id,
                    'mentor_name' => $new_mentee->client_program[0]->client_mentor[0]->first_name.' '.$new_mentee->client_program[0]->client_mentor[0]->last_name,
                    'status' => 1,
                    'password' => $new_mentee->st_password,
                    'created_at' => $new_mentee->created_at
                ];
            }

        }

        DB::table('temp_new_clients')->delete();
        DB::table('temp_new_clients')->insert($collection);

        $collections = DB::table('temp_new_clients')->orderBy('created_at', 'desc')->get();
        return response()->json($collections);
    }
    // crm version 2 end //

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

    public function doSyncCRMV2Clients(Request $request)
    {
        $selectedClient = $request->selectedClient;

        $new_clients = DB::table('temp_new_clients')->whereIn('id_clients', $selectedClient)->get();

        DB::beginTransaction();
        try {

            foreach ($new_clients as $new_client)
            {
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
            
            DB::table('temp_new_clients')->whereIn('id_clients', $selectedClient)->delete();
            DB::commit();

        } catch (Exception $e) {

            DB::rollBack();
            echo $e->getMessage();exit;
        }

        return true;
    }
}
