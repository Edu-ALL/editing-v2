<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayEditors;
use Illuminate\Support\Facades\Mail;

class Reminder extends Controller
{
    public function sendReminderEmailEditor(){
        // Essay Assigned
        $essayAssigned = EssayEditors::where('status_essay_editors', '=', 1)->get();
        // Email Editor
        $emailEditors = array_unique(array_column(EssayEditors::where('status_essay_editors', '=', 1)->get()->toArray(), 'editors_mail'));
        // Check Essay Editor
        $resultEssayAssigned = array();
        foreach($emailEditors as $editor){
            $essays = array();
            foreach($essayAssigned as $essay){
                if ($essay->editors_mail == $editor) {
                    array_push($essays, $essay);
                } else {
                    continue;
                }
            }
            $temp = array($editor, $essays);
            array_push($resultEssayAssigned, $temp);
        }
        // Check Date and Send Email
        foreach($resultEssayAssigned as $data){
            if (count($data[1]) == 0) {
                continue;
            } elseif ((count($data[1]) > 0)) {
                $status = 'false';
                $essays = array();
                $total = 0;
                foreach($data[1] as $essay){
                    $yesterday = date('Y-m-d',strtotime("yesterday"));
                    $uploaded_date = date('Y-m-d',strtotime($essay['uploaded_at']));
                    // check if there is an essay uploaded yesterday
                    if ($uploaded_date == $yesterday) {
                        $status = 'true';
                        array_push($essays, $essay);
                        $total++;
                    } else {
                        continue;
                    }
                }
                $editor = Editor::where('email', $data[0])->first();
                $editorName = $editor->first_name.' '.$editor->last_name;
                $dataEditor = [
                    'email' => $data[0],
                    'name' => $editorName,
                    'role' => 'editor',
                    'status' => $status,
                    'essays' => $essays,
                ];
                $this->sendEmail($dataEditor);
            }
        }
    }
    public function sendReminderEmailManagingEditor(){
        // Essay Submitted and Revised
        $essaySubmitted = EssayEditors::where('status_essay_editors', '=', 3)->orWhere('status_essay_editors', '=', 8)->orderBy('uploaded_at', 'desc')->get();
        // Email Managing Editor
        $emailEditors = array_column(Editor::where('position', '=', 3)->get()->toArray(), 'email');
        // Check Date and Send Email
        $status = 'false';
        foreach($essaySubmitted as $essay){
            $yesterday = date('Y-m-d',strtotime("yesterday"));
            $uploaded_date = date('Y-m-d',strtotime($essay['uploaded_at']));
            // check if there is an essay uploaded yesterday
            if ($uploaded_date == $yesterday) {
                $status = 'true';
            } else {
                continue;
            }
        }
        if ($status == 'true') {
            $dataEditor = [
                'email' => $emailEditors,
                'role' => 'managing',
                'status' => $status,
                'essays' => $essaySubmitted,
            ];
            $this->sendEmail($dataEditor);
        }
    }

    public function sendEmail($data)
    {
        if ($data['role'] == 'editor' && $data['status'] == 'true') {
            Mail::send('mail.reminder.reminder-essay', $data, function($mail) use ($data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($data['email']);
                $mail->subject('Essay Reminder');
            });
        } elseif ($data['role'] == 'managing' && $data['status'] == 'true'){
            Mail::send('mail.reminder.reminder-essay', $data, function($mail) use ($data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($data['email'][0]);
                $mail->cc($data['email']);
                $mail->subject('Essay Reminder');
            });
        }

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }
    }
}