<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Essays;
use App\Http\Controllers\Admin\Editors;
use App\Http\Controllers\Admin\Mentors;
use App\Http\Controllers\Admin\UserStudent;

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

    Route::get('/', function () {
        return view('home.home');
    });

    // Login
    Route::get('/login/mentor', function () {   
        return view('login.login-mentor');
    });
    Route::get('/login/editor', function () {
        return view('login.login-editor');
    });
    Route::get('/login/admin', function () {
        return view('login.login-admin');
    })->middleware('check.login')->name('login.admin');


Route::get('/forgot/mentor', function () {
    return view('forgot.mentor-forgot-password');
});
Route::get('/forgot/editor', function () {
    return view('forgot.editor-forgot-password');
});
Route::get('/forgot/admin', function () {
    return view('forgot.admin-forgot-password');
});

// Admin
// Help
Route::get('/admin/help', function () {
    return view('user.admin.help.help');
});
// User
Route::get('/admin/dashboard', function () {
    return view('user.admin.dashboard');
})->name('admin.dashboard');
Route::get('/admin/user/student', [Clients::class, 'index'])->name('list-client');
Route::get('/admin/user/student/detail', function () {
    return view('user.admin.users.user-student-detail');
});

// Mentor
Route::get('/admin/user/mentor', [Mentors::class, 'index'])->name('list-mentor');

// Editor
Route::get('/admin/user/editor', [Editors::class, 'index'])->name('list-editor');
Route::get('/admin/user/editor/add', function () {
    return view('user.admin.users.user-editor-add');
});
Route::get('/admin/user/editor/invite', function () {
    return view('user.admin.users.user-editor-invite');
});
Route::get('/admin/user/editor/detail', function () {
    return view('user.admin.users.user-editor-detail');
});


// Essay List
Route::get('/admin/essay-list/ongoing', [Essays::class, 'index'])->name('list-ongoing-essay');
Route::get('/admin/essay-list/ongoing/detail', function () {
    return view('user.admin.essay-list.essay-ongoing-detail');
});
Route::get('/admin/essay-list/ongoing/assign', function () {
    return view('user.admin.essay-list.essay-ongoing-assign');
});
Route::get('/admin/essay-list/ongoing/submitted', function () {
    return view('user.admin.essay-list.essay-ongoing-submitted');
});
Route::get('/admin/essay-list/ongoing/accepted', function () {
    return view('user.admin.essay-list.essay-ongoing-accepted');
});

Route::get('/admin/essay-list/completed', function () {
    return view('user.admin.essay-list.essay-completed');
});
Route::get('/admin/essay-list/completed/detail', function () {
    return view('user.admin.essay-list.essay-completed-detail');
});


//**********Role Mentor**********//
Route::get('/mentor/dashboard', function () {
    return view('user.mentor.dashboard');
});
Route::get('/mentor/user/student', function () {
    return view('user.mentor.user-student');
});
Route::get('/mentor/user/student/detail', function () {
    return view('user.mentor.user-student-detail');
});
Route::get('/mentor/essay/list', function () {
    return view('user.mentor.essay-list');
});
Route::get('/mentor/essay/list/detail', function () {
    return view('user.mentor.essay-list-detail');
});
Route::get('/mentor/new-request', function () {
    return view('user.mentor.new-request');
});
Route::get('/mentor/new-request', function () {
    return view('user.mentor.new-request');
});



//**********Role Editor**********//
Route::get('/editor/dashboard', function () {
    return view('user.editor.dashboard');
});
//Editor List Menu
Route::get('/editor/list', function () {
    return view('user.editor.editor-list.editor-list');
});
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




// Export to Excel
Route::get('/admin/export-excel/student', function () {
    return view('user.admin.export-excel.export-student-essay');
});
Route::get('/admin/export-excel/editor', function () {
    return view('user.admin.export-excel.export-editor-essay');
});

// Setting
// University
Route::get('/admin/setting/universities', function () {
    return view('user.admin.settings.setting-universities');
});
Route::get('/admin/setting/universities/add', function () {
    return view('user.admin.settings.setting-add-universities');
});
Route::get('/admin/setting/universities/detail', function () {
    return view('user.admin.settings.setting-detail-universities');
});

// Essay Prompt
Route::get('/admin/setting/essay-prompt', function () {
    return view('user.admin.settings.setting-essay-prompt');
});
Route::get('/admin/setting/essay-prompt/add', function () {
    return view('user.admin.settings.setting-add-essay-prompt');
});
Route::get('/admin/setting/essay-prompt/detail', function () {
    return view('user.admin.settings.setting-detail-essay-prompt');
});

// Programs
Route::get('/admin/setting/programs', function () {
    return view('user.admin.settings.setting-programs');
});
Route::get('/admin/setting/programs/add', function () {
    return view('user.admin.settings.setting-add-programs');
});
Route::get('/admin/setting/programs/detail', function () {
    return view('user.admin.settings.setting-detail-programs');
});


Route::get('/admin/setting/categories-tags', function () {
    return view('user.admin.settings.setting-categories');
});
Route::get('/admin/setting/categories-tags/detail', function () {
    return view('user.admin.settings.setting-detail-categories');
});

// Per Editor
Route::get('/editors/dashboard', function () {
    return view('user.per-editor.dashboard');
});
Route::get('/editors/profile', function () {
    return view('user.per-editor.profile.profile');
});

Route::get('/editors/essay-list', function () {
    return view('user.per-editor.essay-list.essay-list');
});
Route::get('/editors/essay-list/completed/detail', function () {
    return view('user.per-editor.essay-list.essay-list-completed-detail');
});

Route::get('/editors/essay-list/ongoing/detail', function () {
    return view('user.per-editor.essay-list.essay-list-ongoing-detail');
});
Route::get('/editors/essay-list/ongoing/accepted', function () {
    return view('user.per-editor.essay-list.essay-list-ongoing-accepted');
});
Route::get('/editors/essay-list/ongoing/submitted', function () {
    return view('user.per-editor.essay-list.essay-list-ongoing-submitted');
});
Route::get('/editors/essay-list/ongoing/revise', function () {
    return view('user.per-editor.essay-list.essay-list-ongoing-revise');
});
Route::get('/editors/essay-list/ongoing/revised', function () {
    return view('user.per-editor.essay-list.essay-list-ongoing-revised');
});