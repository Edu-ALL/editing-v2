<?php

namespace App\Http\Controllers\ManagingEditor;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllEditorMenu extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $editors = Editor::when($keyword, function($query) use ($keyword) {
            // $query->where('first_name', 'like', '%'.$keyword.'%');
            $query->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%')->orWhereHas('mentors', function ($querym) use ($keyword) {
                $querym->where(DB::raw("CONCAT(`first_name`,`last_name`)"), 'like', '%'.$keyword.'%');
            })->orWhere('email', 'like', '%'.$keyword.'%');
        })->orderBy('first_name', 'asc')->paginate(10);

        if ($keyword) 
            $editors->appends(['keyword' => $keyword]);

        return view('user.editor.editor-list.editor-list', ['editors' => $editors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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