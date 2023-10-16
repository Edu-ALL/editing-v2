<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayFeedbacks;
use App\Models\EssayTags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class EssaysMenu extends Controller
{
    public function ongoingEssay()
    {
        return view('user.mentor.essay-ongoing');
    }

    public function getOngoingEssay(Request $request)
    {
        if ($request->ajax()) {
            $mentor = Auth::guard('web-mentor')->user();

            $data = EssayClients::with('client_by_id', 'mentor', 'client_by_email', 'status')->where('status_essay_clients', '!=', 7)->where('mentors_mail', $mentor->email)->orderBy('uploaded_at', 'desc')->get();
            // $data = EssayClients::where('status_essay_clients', '!=', 7)->where('mentors_mail', $mentor->email)->orderBy('uploaded_at', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($essay) {
                    if ($essay->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' . (isset($essay->client_by_id) ? $essay->client_by_id->first_name . ' ' . $essay->client_by_id->last_name : $essay->client_by_email->first_name . ' ' . $essay->client_by_email->last_name) . ' </div>';
                    return $result;
                })
                ->editColumn('mentor_name', function ($essay) {
                    if ($essay->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        ($essay->mentor->first_name . ' ' . $essay->mentor->last_name)
                        . ' </div>';
                    return $result;
                })
                ->editColumn('editor_name', function ($essay) {
                    if ($essay->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        ($essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-')
                        . ' </div>';
                    return $result;
                })
                ->editColumn('essay_title', function ($essay) {
                    if ($essay->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        ($essay->essay_title)
                        . ' </div>';
                    return $result;
                })
                ->editColumn('essay_deadline', function ($essay) {
                    if ($essay->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        (date('D, d M Y', strtotime($essay->essay_deadline)))
                        . ' </div>';
                    return $result;
                })
                ->editColumn('status', function ($essay) {
                    if ($essay->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" style="color: var(--red)" title="' . ($title) . '"> ' .
                        ($essay->status->status_title)
                        . ' </div>';
                    return $result;
                })
                ->rawColumns(['student_name', 'mentor_name', 'editor_name', 'essay_title', 'essay_deadline', 'status'])
                ->make();
        }
    }


    public function completedEssay()
    {
        return view('user.mentor.essay-completed');
    }

    public function getCompletedEssay(Request $request)
    {
        if ($request->ajax()) {
            $mentor = Auth::guard('web-mentor')->user();

            $data = EssayEditors::with('essay_clients.client_by_id', 'essay_clients.client_by_email', 'status', 'editor')->where('status_essay_editors', 7)
                ->whereHas('essay_clients', function ($query) use ($mentor) {
                    $query->where('mentors_mail', $mentor->email);
                })->orderBy('uploaded_at', 'desc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('student_name', function ($essay) {
                    if ($essay->essay_clients->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' . (isset($essay->essay_clients->client_by_id) ? $essay->essay_clients->client_by_id->first_name . ' ' . $essay->essay_clients->client_by_id->last_name : $essay->essay_clients->client_by_email->first_name . ' ' . $essay->essay_clients->client_by_email->last_name) . ' </div>';
                    return $result;
                })
                ->editColumn('mentor_name', function ($essay) {
                    if ($essay->essay_clients->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        ($essay->essay_clients->mentor->first_name . ' ' . $essay->essay_clients->mentor->last_name)
                        . ' </div>';
                    return $result;
                })
                ->editColumn('editor_name', function ($essay) {
                    if ($essay->essay_clients->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        ($essay->editor ? $essay->editor->first_name . ' ' . $essay->editor->last_name : '-')
                        . ' </div>';
                    return $result;
                })
                ->editColumn('essay_title', function ($essay) {
                    if ($essay->essay_clients->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        ($essay->essay_clients->essay_title)
                        . ' </div>';
                    return $result;
                })
                ->editColumn('essay_deadline', function ($essay) {
                    if ($essay->essay_clients->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" title="' . ($title) . '"> ' .
                        (date('D, d M Y', strtotime($essay->essay_clients->essay_deadline)))
                        . ' </div>';
                    return $result;
                })
                ->editColumn('status', function ($essay) {
                    if ($essay->essay_clients->status_read == 0) {
                        $read = "text-dark fw-bold";
                        $title = "Unread";
                    } else {
                        $read = "";
                        $title = "Read";
                    }

                    $result = '<div class="' . ($read) . '" style="color: var(--green)" title="' . ($title) . '"> ' .
                        ($essay->status->status_title)
                        . ' </div>';
                    return $result;
                })
                ->rawColumns(['student_name', 'mentor_name', 'editor_name', 'essay_title', 'essay_deadline', 'status'])
                ->make();
        }
    }



    public function detailOngoingEssay($id)
    {
        if (!$essay = EssayClients::find($id)) {
            return abort(404);
        }

        # update status read
        if ($essay->status_read == 0) {
            $essay->status_read = 1;
            $essay->save();
        }

        return view('user.mentor.essay-list-ongoing-detail', [
            'essay' => $essay
        ]);
    }

    public function detailCompletedEssay($id)
    {
        if (!$essay = EssayEditors::where('id_essay_clients', $id)->first()) {
            return abort(404);
        }

        $essay_client = EssayClients::where('id_essay_clients', $id)->first();
        if ($essay_client->essay_deadline > $essay->uploaded_at) {
            $status_essay = 'On Time';
        } else {
            $status_essay = 'Late';
        }

        # update status read
        if ($essay_client->status_read == 0) {
            $essay_client->status_read = 1;
            $essay_client->save();
        }

        return view('user.mentor.essay-list-completed-detail', [
            'essay' => $essay,
            'tags' => EssayTags::where('id_essay_clients', $id)->get(),
            'feedback' => EssayFeedbacks::where('id_essay_clients', $id)->first(),
            'status_essay' => $status_essay
        ]);
    }

    public function deletEssay($id)
    {
        // $essay = EssayClients::find($id);
        // $delete = EssayEditors::where('id_essay_clients', '=', $essay->id_essay_clients)->delete();

        // $fileName = $request->attached_of_clients->getClientOriginalName();
        // $filePath = 'uploads/essay/mentor/'.$fileName;
        // Storage::disk('public')->put($filePath, file_get_contents($request->attached_of_clients));

        DB::beginTransaction();
        try {
            $essay = EssayClients::find($id);

            $file_path = app_path("uploaded_files/program/essay/mentors/{$essay->attached_of_clients}");

            // dd($essay);
            if (File::exists($file_path)) {
                //File::delete($file_path);
                File::delete($file_path);
            }
            // EssayClients::where($id)->delete();
            $essay->delete();

            Log::notice("Essay : " . $essay->essay_title . " was deleted by Mentor : " . Auth::guard('web-mentor')->user()->first_name . " " . Auth::guard('web-mentor')->user()->last_name);
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
            return redirect('mentor/essay-list/ongoing')->with('delete-essay-successful', 'Essay has failed ');
        }

        return redirect('mentor/essay-list/ongoing')->with('delete-essay-successful', 'Essay has been deleted');
    }

    public function feedback(Request $request, $id)
    {
        $rate_1 = $request->rating_1;
        $rate_2 = $request->rating_2;
        $rate_3 = $request->rating_3;
        $rate_4 = $request->rating_4;
        $rate_5 = $request->rating_5;
        $rate_6 = $request->rating_6;

        DB::beginTransaction();
        try {
            $essay_feedback = new EssayFeedbacks;
            $essay_feedback->id_essay_clients = $id;
            $essay_feedback->option1 = $rate_1;
            $essay_feedback->option2 = $rate_2;
            $essay_feedback->option3 = $rate_3;
            $essay_feedback->option4 = $rate_4;
            $essay_feedback->option5 = $rate_5;
            $essay_feedback->option6 = $rate_6;
            $essay_feedback->add_comments = $request->comment;
            $essay_feedback->save();

            $essay = EssayClients::find($id);
            $essay->essay_rating = ($rate_1 + $rate_2 + $rate_3 + $rate_4 + $rate_5 + $rate_6) / 6;
            # update status read editor
            $essay->status_read_editor = 0;
            $essay->save();

            Log::notice("Essay : " . $essay->essay_title . " has feedback from Mentor : " . Auth::guard('web-mentor')->user()->first_name . " " . Auth::guard('web-mentor')->user()->last_name);
            DB::commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }

        return redirect('mentor/essay-list/completed/detail/' . $id);
    }

     public function listEssayMentee(Request $request)
    {
        $email = $request->get('email') ?? null;

        if (!$mentor = Mentor::where('email', $email)) {
            return response()->json(['success' => false, 'error' => 'Failed to get list essay.']);
        }

        $essays = EssayClients::where('mentors_mail', $email)->orderBy('uploaded_at', 'desc')->paginate(10);

        return response()->json(['success' => true, 'data' => $essays]);
    }

    public function listEssayByStudent(Request $request)
    {
        $email = $request->get('email') ?? null;

        if (!$student = Client::where('email', $email)) {
            return response()->json(['success' => false, 'error' => 'Failed to get list essay.']);
        }

        $essays = EssayClients::where('email', $email)->orderBy('uploaded_at', 'desc')->paginate(10);

        return response()->json(['success' => true, 'data' => $essays]);
    }
}
