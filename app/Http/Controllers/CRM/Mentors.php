<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Mentor as CRMMentor;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

class Mentors extends Controller
{
    public function doSyncCRMMentors(Request $request)
    {
        $local_mentors = Mentor::get('id_mentors');
        $crm_mentors = CRMMentor::with('university')->where('mt_status', 1)->where('mt_istutor', '<', 3)->where('mt_email', '!=', NULL)->where('mt_email', '!=', '')->whereNotIn('mt_id', $local_mentors)->get();
        if (count($crm_mentors) == 0) {
            echo json_encode(['success' => false, 'message' => 'No data found'], 400);exit;
        }

        $collections = $crm_mentors->map(function ($crm_mentor) {
            return [
                'id_mentors' => $crm_mentor->mt_id,
                'first_name' => $crm_mentor->mt_firstn,
                'last_name' => $crm_mentor->mt_lastn,
                'phone' => $crm_mentor->mt_phone,
                'email' => $crm_mentor->mt_email,
                'graduated_from' => $crm_mentor->univ_name,
                'address' => $crm_mentor->mt_address,
            ];
        });

        DB::beginTransaction();
        try {
            
            foreach ($collections as $collection) {
                $mentor = new Mentor;
                $mentor->id_mentors = $collection['id_mentors'];
                $mentor->first_name = $collection['first_name'];
                $mentor->last_name = $collection['last_name'];
                $mentor->phone = $collection['phone'];
                $mentor->email = $collection['email'];
                $mentor->graduated_from = $collection['graduated_from'];
                $mentor->address = $collection['address'];
                $mentor->status = 1;
                $mentor->password = Hash::make('all-in mentor');
                $mentor->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);exit;
        }
        
        echo json_encode(['success' => true]);
    }
}
