<?php

use App\Models\Client;
use App\Models\Editor;
use App\Models\Mentor;
use App\Http\Controllers\Admin\Tag;
use App\Http\Controllers\Admin\CategoriesTags;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Essays;
use App\Http\Controllers\Admin\Export;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Editors;
use App\Http\Controllers\Admin\EssayPrompt;
use App\Http\Controllers\Admin\Mentors;
use App\Http\Controllers\Admin\Program;
use App\Http\Controllers\Admin\UserStudent;
use App\Http\Controllers\Admin\Universities;
use App\Http\Controllers\Editor\Dashboard;
use App\Http\Controllers\Editor\Essays as EditorEssays;
use App\Http\Controllers\Editor\Profile;
use App\Http\Controllers\ManagingEditor\AllEditorMenu;
use App\Http\Controllers\ManagingEditor\CategoriesTags as ManagingEditorCategoriesTags;
use App\Http\Controllers\ManagingEditor\Universities as ManagingEditorUniversities;
use App\Models\Category;
use App\Models\EssayClients;
use App\Models\PositionEditor;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Mentor\EssaysMenu;
use App\Http\Controllers\Mentor\NewRequestMenu;
use App\Http\Controllers\Mentor\StudentsMenu;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('register/editor', [Editors::class, 'selfAddEditor'])->name('self-add-editor');

// Login
Route::middleware('check.login')->group(function() {

    Route::get('/', function () {
        return view('home.home');
    });

    Route::get('/login/mentor', function () {   
        return view('login.login-mentor');
    });
    Route::get('/login/editor', function () {
        return view('login.login-editor');
    });
    Route::get('/login/admin', function () {
        return view('login.login-admin');
    })->name('login.admin');
    
    
    Route::get('/forgot/mentor', function () {
        return view('forgot.mentor-forgot-password');
    });
    Route::get('/forgot/editor', function () {
        return view('forgot.editor-forgot-password');
    });
    Route::get('/forgot/admin', function () {
        return view('forgot.admin-forgot-password');
    });
});

// Admin
// Help
Route::middleware('is_admin')->group(function(){

    Route::get('/admin/help', function () {
        return view('user.admin.help.help');
    });
    // Dashboard
    Route::get('/admin/dashboard', function () {
        return view('user.admin.dashboard', [
            'count_student' => Client::count(),
            'count_mentor' => Mentor::count(),
            'count_editor' => Editor::count(),
            'count_ongoing_essay' => EssayClients::where('status_essay_clients', '!=', 7)->count(),
            'count_completed_essay' => EssayClients::where('status_essay_clients', '=', 7)->count(),
        ]);
    })->name('admin.dashboard');
    
    // Student
    Route::get('/admin/user/student', [Clients::class, 'index'])->name('list-client');
    Route::get('/admin/user/student/detail/{id}', [Clients::class, 'detail']);
    
    // Mentor
    Route::get('/admin/user/mentor', [Mentors::class, 'index'])->name('list-mentor');
    
    // Editor
    Route::get('/admin/user/editor', [Editors::class, 'index'])->name('list-editor');
    Route::get('/admin/user/editor/detail/{id}', [Editors::class, 'detail']);
    Route::get('/admin/user/editor/add', function () {
        return view('user.admin.users.user-editor-add', [
            'position' => PositionEditor::get()
        ]);
    });
    Route::get('/admin/user/editor/invite', function () {
        return view('user.admin.users.user-editor-invite');
    });
    
    // Essay List
    Route::get('/admin/essay-list/ongoing', [Essays::class, 'index'])->name('list-ongoing-essay');
    Route::get('/admin/essay-list/ongoing/detail/{id_essay}', [Essays::class, 'detailEssayOngoing']);
    
    Route::get('/admin/essay-list/completed', [Essays::class, 'essayCompleted'])->name('list-completed-essay');
    Route::get('/admin/essay-list/completed/detail/{id}', [Essays::class, 'detailEssayCompleted']);

    // Export to Excel
    Route::get('/admin/export-excel/student', function () {
        return view('user.admin.export-excel.export-student-essay');
    });
    Route::get('/admin/export-excel/editor', [Export::class, 'index'])->name('export-excel');

    // Setting
    // University
    Route::get('/admin/setting/universities', [Universities::class, 'index'])->name('list-university');
    Route::get('/admin/setting/universities/detail/{id}', [Universities::class, 'detail']);

    Route::get('/admin/setting/universities/add', function () {
        return view('user.admin.settings.setting-add-universities');
    });

    // Essay Prompt
    Route::get('/admin/setting/essay-prompt', [EssayPrompt::class, 'index'])->name('list-essay-prompt');
    Route::get('/admin/setting/essay-prompt/detail/{id}', [EssayPrompt::class, 'detail']);
    Route::get('/admin/setting/essay-prompt/add', function () {
        return view('user.admin.settings.setting-add-essay-prompt', [
            'univ' => University::get()
        ]);
    });

    // Programs
    Route::get('/admin/setting/programs', [Program::class, 'index'])->name('list-program');
    Route::get('/admin/setting/programs/detail/{id}', [Program::class, 'detail']);
    Route::get('/admin/setting/programs/add', function () {
        return view('user.admin.settings.setting-add-programs', [
            'category' => Category::get()
        ]);
    });

    // Categories / Tags
    Route::get('/admin/setting/categories-tags', [CategoriesTags::class, 'index'])->name('list-tag');
    Route::get('/admin/setting/categories-tags/detail/{tag_id}', [CategoriesTags::class, 'detail']);
});

//**********Role Mentor**********//
Route::get('/mentor/essay-list', [EssaysMenu::class, 'index'])->name('list-essay');
Route::get('/admin/essay-list/detail', function () {
    return view('user.admin.essay-list.essay-ongoing-detail');
});
Route::get('/mentor/essay-list/completed', [EssaysMenu::class, 'index'])->name('list-essay-completed');

Route::get('/mentor/dashboard', function () {
    return view('user.mentor.dashboard');
});
Route::get('/mentor/user/student', [StudentsMenu::class, 'index'])->name('list-student');
Route::get('/mentor/user/student/detail/{id}', [StudentsMenu::class, 'detail']);
// Route::get('/mentor/user/student', function () {
//     return view('user.mentor.user-student');
// });
Route::get('/mentor/user/student/detail', function () {
    return view('user.mentor.user-student-detail');
});
// Route::get('/mentor/essay/list', function () {
//     return view('user.mentor.essay-list');
// });
// Route::get('/mentor/essay/list/detail', function () {
//     return view('user.mentor.essay-list-detail');
// });
Route::get('/mentor/new-request', [NewRequestMenu::class, 'index'])->name('new-request');
Route::get('/mentor/new-request/save', [NewRequestMenu::class, 'store'])->name('save-new-request');
// Route::get('/mentor/new-request', function () {
//     return view('user.mentor.new-request');
// });




//**********Role Editor**********//
Route::get('/editor/dashboard', function () {
    return view('user.editor.dashboard');
});
//Editor List Menu
Route::get('/editor/list', [AllEditorMenu::class, 'index'])->name('list-editor');
// Route::get('/editor/list', function () {
//     return view('user.editor.editor-list.editor-list');
// });
Route::get('/editor/list/detail', function () {
    return view('user.editor.editor-list.editor-list-detail');
});
//All Essays Menu
Route::get('/editor/all-essays', function () {
    return view('user.editor.all-essays.editor-all-essays');
});
Route::get('/editor/all-essays/not-assign-essay-list', function () {
    return view('user.editor.all-essays.editor-not-assign-essays-list');
});
Route::get('/editor/all-essays/assigned-essay-list', function () {
    return view('user.editor.all-essays.editor-assigned-essays-list');
});
Route::get('/editor/all-essays/ongoing-essay-list', function () {
    return view('user.editor.all-essays.editor-ongoing-essays-list');
});
Route::get('/editor/all-essays/completed-essay-list', function () {
    return view('user.editor.all-essays.editor-completed-essays-list');
});
Route::get('/editor/all-essays/essay-list-due-tommorow', function () {
    return view('user.editor.all-essays.editor-list-due-tomorrow');
});
Route::get('/editor/all-essays/essay-list-due-within-three', function () {
    return view('user.editor.all-essays.editor-list-due-within-three');
});
Route::get('/editor/all-essays/essay-list-due-within-five', function () {
    return view('user.editor.all-essays.editor-list-due-within-five');
});
Route::get('/editor/all-essays/essay-list-due-tomorrow-detail', function () {
    return view('user.editor.all-essays.editor-list-due-detail');
});
//All Essays detail
Route::get('/editor/all-essays/not-assign-essay-list-detail', function () {
    return view('user.editor.all-essays.editor-not-assign-essays-list-detail');
});
Route::get('/editor/all-essays/assign-essay-list-detail', function () {
    return view('user.editor.all-essays.editor-assign-essays-list-detail');
});
Route::get('/editor/all-essays/ongoing-essay-list-detail', function () {
    return view('user.editor.editor-ongoing-essays-list-detail');
});
Route::get('/editor/all-essays/completed-essay-list-detail', function () {
    return view('user.editor.all-essays.editor-completed-essays-list-detail');
});
//Essay List Menu
Route::get('/editor/essay-list', function () {
    return view('user.editor.essay-list.editor-essay-list');
});
Route::get('/editor/essay-list-detail', function () {
    return view('user.editor.essay-list.editor-list-detail');
});
Route::get('/editor/essay-list-due-tommorow', function () {
    return view('user.editor.essay-list.editor-list-due-tomorrow');
});
Route::get('/editor/essay-list-due-within-three', function () {
    return view('user.editor.essay-list.editor-list-due-within-three');
});
Route::get('/editor/essay-list-due-within-five', function () {
    return view('user.editor.essay-list.editor-list-due-within-five');
});

//Setting Menu
Route::get('/editor/setting/universities', [ManagingEditorUniversities::class, 'index'])->name('list-university');
Route::get('/editor/setting/universities/detail/{id}', [ManagingEditorUniversities::class, 'detail']);
Route::get('/editor/setting/universities/add', function () {
    return view('user.editor.settings.setting-add-universities');
});

Route::get('/editor/setting/categories-tags', [ManagingEditorCategoriesTags::class, 'index'])->name('list-tag');
Route::get('/editor/setting/categories-tags/detail/{tag_id}', [ManagingEditorCategoriesTags::class, 'detail']);

//Report List Menu
// Route::get('/editor/report-list', [Reportlist::class, 'index'])->name('list-tag');
Route::get('/editor/report-list', function () {
    return view('user.editor.report-list.report-list');
});


// **** Per Editor *****
Route::middleware('is_editor')->group(function(){
    Route::get('/editors/dashboard', [Dashboard::class, 'index']);
    
    Route::get('/editors/profile', [Profile::class, 'index']);

    Route::get('/editors/essay-list', [EditorEssays::class, 'index'])->name('list-essay');
    Route::get('/editors/essay-list/completed/detail/{id_essay}', [EditorEssays::class, 'detailEssay']);
    Route::get('/editors/essay-list/ongoing/detail/{id_essay}', [EditorEssays::class, 'detailEssay']);
});
