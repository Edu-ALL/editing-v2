<?php

use Illuminate\Support\Facades\Route;

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
});


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
// User
Route::get('/admin/dashboard', function () {
    return view('user.admin.dashboard');
});
Route::get('/admin/user/student', function () {
    return view('user.admin.users.user-student');
});
Route::get('/admin/user/mentor', function () {
    return view('user.admin.user-mentor');
});
Route::get('/admin/user/student/detail', function () {
    return view('user.admin.users.user-student-detail');
});

Route::get('/admin/user/mentor', function () {
    return view('user.admin.users.user-mentor');
});


// Mentor
Route::get('/admin/user/mentor', function () {
    return view('user.admin.users.user-mentor');
});

// Editor
Route::get('/admin/user/editor', function () {
    return view('user.admin.users.user-editor');
});
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
Route::get('/admin/essay-list/ongoing', function () {
    return view('user.admin.essay-list.essay-ongoing');
});
Route::get('/admin/essay-list/ongoing/detail', function () {
    return view('user.admin.essay-list.essay-completed-detail');
});

Route::get('/admin/essay-list/completed', function () {
    return view('user.admin.essay-list.essay-completed');
});
Route::get('/admin/essay-list/completed/detail', function () {
    return view('user.admin.essay-list.essay-completed-detail');
});


// Mentor
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

// Mentor
Route::get('/editor/dashboard', function () {
    return view('user.editor.dashboard');
});
Route::get('/editor/essay/list', function () {
    return view('user.editor.editor-list');
});
Route::get('/editor/essay/list/detail', function () {
    return view('user.editor.essay-list-detail');
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
    return view('user.admin.setting');
});