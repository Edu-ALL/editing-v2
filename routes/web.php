<?php

use App\Events\EssayStatus;
use App\Events\MentorNotif;
use App\Models\Client;
use App\Models\Editor;
use App\Models\Mentor;
use App\Http\Controllers\Admin\Tag;
use App\Http\Controllers\Admin\CategoriesTags;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Essays;
use App\Http\Controllers\Admin\Export;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Dashboard as AdminDashboard;
use App\Http\Controllers\Admin\Editors;
use App\Http\Controllers\Admin\EssayPrompt;
use App\Http\Controllers\Admin\Mentors;
use App\Http\Controllers\Admin\Program;
use App\Http\Controllers\Admin\UserStudent;
use App\Http\Controllers\Admin\Universities;
use App\Http\Controllers\Admin\Authentication as AdminAuth;
use App\Http\Controllers\Editor\Dashboard;
use App\Http\Controllers\Editor\Essays as EditorEssays;
use App\Http\Controllers\Editor\Profile;
use App\Http\Controllers\Editor\Authentication as EditorAuth;
use App\Http\Controllers\ManagingEditor\AllEditorMenu;
use App\Http\Controllers\ManagingEditor\AllEssaysMenu;
use App\Http\Controllers\ManagingEditor\CategoriesTags as ManagingEditorCategoriesTags;
use App\Http\Controllers\ManagingEditor\EssayListMenu;
use App\Http\Controllers\ManagingEditor\ReportList;
use App\Http\Controllers\ManagingEditor\DashboardManaging;
use App\Http\Controllers\ManagingEditor\ProfileManaging;
use App\Http\Controllers\ManagingEditor\Universities as ManagingEditorUniversities;
use App\Http\Controllers\Mentor\Dashboard as MentorDashboard;
use App\Http\Controllers\Mentor\Authentication as MentorAuth;
use App\Models\Category;
use App\Models\EssayClients;
use App\Models\PositionEditor;
use App\Models\University;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Mentor\EssaysMenu;
use App\Http\Controllers\Mentor\NewRequestMenu;
use App\Http\Controllers\Mentor\StudentsMenu;
use App\Models\EssayEditors;

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
Route::post('invite-editor', [Editors::class, 'invite'])->name('invite-editor');
Route::get('joined-editor', [Editors::class, 'join_editor'])->name('join-editor');


// Login
Route::middleware('check.login')->group(function () {

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

    Route::post('send-reset-password/editor', [EditorAuth::class, 'send_reset_password'])->name('send-reset-password-editor');
    Route::get('form-reset-password/editor', [EditorAuth::class, 'form_reset_password'])->name('form-reset-password-editor');
    Route::post('reset-password/editor', [EditorAuth::class, 'reset_password'])->name('reset-password-editor');
    Route::post('delete-token', [EditorAuth::class, 'delete_token'])->name('delete-token');

    Route::get('/forgot/admin', function () {
        return view('forgot.admin-forgot-password');
    });
});

//**********Role Admin**********//
Route::middleware('is_admin')->group(function () {
    // Help
    Route::get('/admin/help', function () {
        return view('user.admin.help.help');
    });
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboard::class, 'index'])->name('admin-dashboard');

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
Route::middleware('is_mentor')->group(function () {
    // Dashboard
    Route::get('/mentor/dashboard', [MentorDashboard::class, 'index']);

    // Essay List
    Route::get('/mentor/essay-list/ongoing', [EssaysMenu::class, 'ongoingEssay'])->name('mentor-essay-list-ongoing');
    Route::get('/mentor/essay-list/ongoing/detail/{id}', [EssaysMenu::class, 'detailOngoingEssay'])->name('mentor-essay-list-ongoing-detail');
    Route::post('/mentor/essay-list/ongoing/delete/{id}', [EssaysMenu::class, 'deletEssay'])->name('mentor-essay-delete');;

    Route::get('/mentor/essay-list/completed', [EssaysMenu::class, 'completedEssay'])->name('mentor-essay-list-completed');
    Route::get('/mentor/essay-list/completed/detail/{id}', [EssaysMenu::class, 'detailCompletedEssay']);

    // User List
    Route::get('/mentor/user/student', [StudentsMenu::class, 'index'])->name('list-student');
    Route::get('/mentor/user/student/detail/{id}', [StudentsMenu::class, 'detail']);
    Route::post('/mentor/user/student/update/{id}', [StudentsMenu::class, 'update'])->name('update-student');

    // New Request
    Route::get('/mentor/new-request', [NewRequestMenu::class, 'index'])->name('new-request');
    Route::post('/mentor/new-request/save', [NewRequestMenu::class, 'store'])->name('save-new-request');
});

//**********Role Managing**********//
Route::middleware('is_editor')->group(function () {
    // Dashboard
    Route::get('/editor/dashboard', [DashboardManaging::class, 'index'])->name('editor-dashboard');

    // Help
    Route::get('/editor/help', function () {
        return view('user.editor.help.help');
    });

    //Editor List Menu
    Route::get('/editor/list', [AllEditorMenu::class, 'index'])->name('list-editor');
    Route::get('/editor/list/detail/{id}', [AllEditorMenu::class, 'detail']);

    //All Essays Menu
    Route::get('/editor/all-essays', [AllEssaysMenu::class, 'index']);

    //List All Essays
    Route::get('/editor/all-essays/completed-essay-list', [AllEssaysMenu::class, 'essayCompleted'])->name('editor-list-completed-essay');
    Route::get('/editor/all-essays/ongoing-essay-list', [AllEssaysMenu::class, 'ongoingList'])->name('editor-list-ongoing-essay');
    Route::get('/editor/all-essays/assigned-essay-list', [AllEssaysMenu::class, 'assignList'])->name('editor-list-assign-essay');
    Route::get('/editor/all-essays/not-assign-essay-list', [AllEssaysMenu::class, 'notAssignList'])->name('editor-list-not-assign-essay');

    //Detail All Essays
    Route::get('/editor/all-essays/ongoing/detail/{id}', [AllEssaysMenu::class, 'detailEssayManaging']);
    Route::get('/editor/all-essays/completed/detail/{id}', [AllEssaysMenu::class, 'detailEssayManagingCompleted']);

    //List All Essays Due
    Route::get('/editor/all-essays/essay-list-due-tommorow', [AllEssaysMenu::class, 'dueTomorrow'])->name('editor-list-due-tomorrow');
    Route::get('/editor/all-essays/essay-list-due-within-three', [AllEssaysMenu::class, 'dueThree'])->name('editor-list-due-within-three');
    Route::get('/editor/all-essays/essay-list-due-within-five', [AllEssaysMenu::class, 'dueFive'])->name('editor-list-due-within-five');

    //Essay List Menu
    Route::get('/editor/essay-list', [EssayListMenu::class, 'index'])->name('editor-essay-list');
    Route::get('/editor/essay-list/ongoing/detail/{id_essay}', [EssayListMenu::class, 'detailEssayList']);
    Route::get('/editor/essay-list/completed/detail/{id_essay}', [EssayListMenu::class, 'detailEssayList']);

    //List Essays List Due
    Route::get('/editor/essay-list-due-tommorow', [EssayListMenu::class, 'dueTomorrow'])->name('editor-list-due-tomorrow');
    Route::get('/editor/essay-list-due-within-three', [EssayListMenu::class, 'dueThree'])->name('editor-list-due-within-three');
    Route::get('/editor/essay-list-due-within-five', [EssayListMenu::class, 'dueFive'])->name('editor-list-due-within-five');

    //Setting Menu
    Route::get('/editor/setting/universities', [ManagingEditorUniversities::class, 'index'])->name('list-university');
    Route::get('/editor/setting/universities/detail/{id}', [ManagingEditorUniversities::class, 'detail']);
    Route::get('/editor/setting/universities/add', function () {
        return view('user.editor.settings.setting-add-universities');
    });
    Route::get('/editor/setting/categories-tags', [ManagingEditorCategoriesTags::class, 'index'])->name('list-tag');
    Route::get('/editor/setting/categories-tags/detail/{tag_id}', [ManagingEditorCategoriesTags::class, 'detail']);

    // Report List
    Route::get('/editor/report-list', [ReportList::class, 'index'])->name('report-list');

    // Profile
    Route::get('/editor/profile', [ProfileManaging::class, 'index']);
});


// **** Per Editor *****
Route::middleware('is_editor')->group(function () {
    Route::get('/editors/dashboard', [Dashboard::class, 'index']);

    Route::get('/editors/profile', [Profile::class, 'index']);

    Route::get('/editors/essay-list', [EditorEssays::class, 'index'])->name('list-essay');
    Route::get('/editors/essay-list/completed/detail/{id_essay}', [EditorEssays::class, 'detailEssayCompleted']);
    Route::get('/editors/essay-list/ongoing/detail/{id_essay}', [EditorEssays::class, 'detailEssay']);

    Route::get('/editor/invite', function () {
        return view('user/editor/editor-list/user-editor-invite');
    });
});

Route::get('/event', function () {
    event(new MentorNotif('test@gmail.com', 'Essay has been completed'));
});
