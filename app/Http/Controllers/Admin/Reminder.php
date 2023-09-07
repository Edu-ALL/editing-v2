<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayEditors;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class Reminder extends Controller
{
    public function sendReminderEmailEditor()
    {
        // Essay Assigned
        $today = Carbon::now();
        $essayAssigned = EssayEditors::where('status_essay_editors', '=', 1)->where('uploaded_at', '<', $today)->orderBy('uploaded_at', 'desc')->get();
        // Email Editor
        $emailEditors = array_unique(array_column($essayAssigned->toArray(), 'editors_mail'));
        // Check Essay Editor

        $resultEssayAssigned = array();
        foreach ($emailEditors as $editor) {
            $essays = array();
            foreach ($essayAssigned as $essay) {
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
        foreach ($resultEssayAssigned as $data) {
            if (count($data[1]) == 0) {
                continue;
            } elseif ((count($data[1]) > 0)) {
                $status = 'false';
                $essays = array();
                $total = 0;
                foreach ($data[1] as $essay) {
                    $status = 'true';
                    array_push($essays, $essay);
                    $total++;
                }
                $editor = Editor::where('email', $data[0])->first();
                $editorName = $editor->first_name . ' ' . $editor->last_name;
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
    public function sendReminderEmailManagingEditor()
    {
        // Essay Submitted and Revised
        $today = Carbon::now();
        $essaySubmitted = EssayEditors::where(function ($query) {
            $query->where('status_essay_editors', '=', 3)
                ->orWhere('status_essay_editors', '=', 8);
        })->where('uploaded_at', '<', $today)->orderBy('uploaded_at', 'desc')->get();

        // Managing Editor data
        $managingEditors = Editor::where('position', '=', 3)->get();
        $managingEditorsName = array();
        foreach ($managingEditors as $editor) {
            array_push($managingEditorsName, $editor->first_name . ' ' . $editor->last_name);
        }
        $emailEditors = array_column($managingEditors->toArray(), 'email');

        // Check Date and Send Email
        $dataEditor = [
            'email' => $emailEditors,
            'name' => $managingEditorsName,
            'role' => 'managing',
            'status' => 'true',
            'essays' => $essaySubmitted,
        ];
        $this->sendEmail($dataEditor);
    }

    public function sendEmail($data)
    {
        if ($data['role'] == 'editor' && $data['status'] == 'true') {
            Mail::send('mail.reminder.reminder-essay', $data, function ($mail) use ($data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($data['email']);
                $mail->cc('essay.editor@all-inedu.com');
                $mail->subject('Pending Essay Awaiting Your Review');
            });
        } elseif ($data['role'] == 'managing' && $data['status'] == 'true') {
            Mail::send('mail.reminder.reminder-essay', $data, function ($mail) use ($data) {
                $mail->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->to($data['email']);
                $mail->subject('Managing Editors: Unchecked Essay Edits Need Your Approval');
            });
        }

        if (Mail::failures()) {
            return response()->json(Mail::failures());
        }
    }
}
