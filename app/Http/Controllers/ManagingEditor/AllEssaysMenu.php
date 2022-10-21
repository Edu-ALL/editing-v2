<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\EssayClients;
use App\Models\EssayEditors;
use App\Models\EssayFeedbacks;
use App\Models\EssayTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllEssaysMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function assignList(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayEditors::where('status_essay_editors', 1)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%'.$keyword.'%');
                    })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                    ->orWhereHas('status', function ($query_status) use ($keyword) {
                        $query_status->where('status_title', 'like', '%'.$keyword.'%');
                    });
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        // dd($essays);
        return view('user.editor.all-essays.essay-assign', ['essays' => $essays]);
    }

    public function notAssignList(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayClients::where('status_essay_clients', 0)->orWhere('status_essay_clients', 4)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_client) use ($keyword) {
                    $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                        $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });;
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                ->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.essay-not-assign', ['essays' => $essays]);
    }

    public function ongoingList(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayEditors::where('status_essay_editors', '=', 2)->orWhere('status_essay_editors', '=', 3)->orWhere('status_essay_editors', '=', 6)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%'.$keyword.'%');
                    })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                    ->orWhereHas('status', function ($query_status) use ($keyword) {
                        $query_status->where('status_title', 'like', '%'.$keyword.'%');
                    });
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        
        return view('user.editor.all-essays.essay-ongoing', ['essays' => $essays]);
    }

    public function essayCompleted(Request $request)
    {
        $keyword = $request->get('keyword');
        $essays = EssayEditors::where('status_essay_editors', 7)->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('essay_clients', function ($query_essay) use ($keyword) {
                    $query_essay->whereHas('client_by_id', function ($query_client) use ($keyword) {
                        $query_client->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor) use ($keyword) {
                            $query_mentor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                        });;
                    })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                        $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    })->orWhereHas('program', function ($query_program) use ($keyword) {
                        $query_program->where('program_name', 'like', '%'.$keyword.'%');
                    })->orWhere('essay_title', 'like', '%'.$keyword.'%')
                    ->orWhereHas('status', function ($query_status) use ($keyword) {
                        $query_status->where('status_title', 'like', '%'.$keyword.'%');
                    });
                });
            });
        })->orderBy('uploaded_at', 'desc')->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
        
        return view('user.editor.all-essays.essay-completed', ['essays' => $essays]);
    }
    public function detailEssayCompleted($id){
        $essay = EssayEditors::where('id_essay_clients', $id)->first();
        $essay_client = EssayClients::where('id_essay_clients', $id)->first();
        if ($essay_client->essay_deadline > $essay->uploaded_at) {
            $status_essay = 'On Time';
        } else {
            $status_essay = 'Late';
        }

        return view('user.editor.all-essays.essay-completed-detail', [
            'essay' => $essay,
            'tags' => EssayTags::where('id_essay_clients', $id)->get(),
            'feedback' => EssayFeedbacks::where('id_essay_clients', $id)->first(),
            'status_essay' => $status_essay
        ]);
    }

    public function detailEssayOngoing($id){
        $essay = EssayEditors::where('id_essay_clients', $id)->first();
        $essay_client = EssayClients::where('id_essay_clients', $id)->first();
        if ($essay_client->essay_deadline > $essay->uploaded_at) {
            $status_essay = 'On Time';
        } else {
            $status_essay = 'Late';
        }

        return view('user.editor.all-essays.essay-completed-detail', [
            'essay' => $essay,
            'tags' => EssayTags::where('id_essay_clients', $id)->get(),
            'feedback' => EssayFeedbacks::where('id_essay_clients', $id)->first(),
            'status_essay' => $status_essay
        ]);
    }

    public function detailEssay($id_essay, Request $request)
    {
        $editors = Editor::paginate(10);
        $essay = EssayClients::find($id_essay);
        $essay_editor = EssayEditors::where('id_essay_clients', $id_essay)->first();

        if ($essay_editor->read == 0) {
            DB::beginTransaction();
            $essay_editor->read = 1;
            $essay_editor->save();
            DB::commit();
        }

        if ($essay->status_essay_clients == 0 || $essay->status_essay_clients == 4) {
            return view('user.per-editor.essay-list.essay-list-ongoing-detail', [
                'essay' => $essay,
                'editors' => $editors
            ]);
        } else if ($essay->status_essay_clients == 1) {
            return view('user.per-editor.essay-list.essay-list-ongoing-detail', [
                'essay' => $essay
            ]);
        } else if ($essay->status_essay_clients == 2) {
            return view('user.per-editor.essay-list.essay-list-ongoing-accepted', [
                'essay' => $essay,
                'tags' => Tags::get()
            ]);
        } else if ($essay->status_essay_clients == 3 || $essay->status_essay_clients == 8) {
            return view('user.per-editor.essay-list.essay-list-ongoing-submitted', [
                'essay' => $essay,
                'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
            ]);
        } else if ($essay->status_essay_clients == 6) {
            return view('user.per-editor.essay-list.essay-list-ongoing-revise', [
                'essay' => $essay,
                'tags' => EssayTags::where('id_essay_clients', $id_essay)->get(),
                'list_tags' => Tags::get(),
                'essay_revise' => EssayRevise::where('id_essay_clients', $id_essay)->get()
            ]);
        } else if ($essay->status_essay_clients == 7) {
            return view('user.per-editor.essay-list.essay-list-completed-detail', [
                'essay' => $essay_editor,
                'tags' => EssayTags::where('id_essay_clients', $id_essay)->get()
            ]);
        }
    }

    public function allEssayDeadline($start, $num){
        $today = date('Y-m-d');
        $start = date('Y-m-d', strtotime('+'.$start.' days', strtotime($today)));
        $dueDate = date('Y-m-d', strtotime('+'.$num.' days', strtotime($today)));
        $essay = EssayClients::where('status_essay_clients', '!=', 7);
        $essay->where('essay_deadline', '>', $start);
        $essay->where('essay_deadline', '<=', $dueDate);
        return $essay;
    }

    public function dueTomorrow(Request $request){
        $keyword = $request->get('keyword');
        $essays = $this->allEssayDeadline('0', '1')->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.editor-list-due-tomorrow', ['essays' => $essays]);
    }
    public function dueThree(Request $request){
        $keyword = $request->get('keyword');
        $essays = $this->allEssayDeadline('1', '3')->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->paginate(10);
        
        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);

        return view('user.editor.all-essays.editor-list-due-within-three', ['essays' => $essays]);
    }
    public function dueFive(Request $request){
        $keyword = $request->get('keyword');
        $essays = $this->allEssayDeadline('3', '5')->when($keyword, function ($query_) use ($keyword) {
            $query_->where(function ($query) use ($keyword) {
                $query->whereHas('client_by_id', function ($query_by_id) use ($keyword) {
                    $query_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($query_mentor_by_id) use ($keyword) {
                        $query_mentor_by_id->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                    });
                })->orWhereHas('editor', function ($query_editor) use ($keyword) {
                    $query_editor->where(DB::raw("CONCAT(`first_name`, ' ',`last_name`)"), 'like', '%'.$keyword.'%');
                })->orWhereHas('program', function ($query_program) use ($keyword) {
                    $query_program->where('program_name', 'like', '%'.$keyword.'%');
                })->orWhere('essay_title', 'like', '%'.$keyword.'%')->orWhereHas('status', function ($query_status) use ($keyword) {
                    $query_status->where('status_title', 'like', '%'.$keyword.'%');
                });
            });
        })->paginate(10);

        if ($keyword) 
            $essays->appends(['keyword' => $keyword]);
            
        return view('user.editor.all-essays.editor-list-due-within-five', ['essays' => $essays]);
    }

    public function detailEssayDue($id){
        $essay_client = EssayClients::where('id_essay_clients', $id)->first();

        if ($essay_client->status_read_editor == 0) {
            DB::beginTransaction();
            $essay_client->status_read_editor = 1;
            $essay_client->save();
            DB::commit();
        }
        return view('user.editor.all-essays.editor-list-due-detail', [
            'essay' => $essay_client,
        ]);
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}