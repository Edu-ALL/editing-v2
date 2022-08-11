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

<<<<<<< HEAD
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
Route::get('/mentor/new-request', function () {
    return view('user.mentor.new-request');
=======
Route::get('/admin/user/mentor', function () {
    return view('user.admin.users.user-mentor');
});

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

Route::get('/admin/essay-list/completed', function () {
    return view('user.admin.essay-list.essay-completed');
});
Route::get('/admin/essay-list/completed/detail', function () {
    return view('user.admin.essay-list.essay-completed-detail');
>>>>>>> 8b38495aca7214cb9175848c1515148d56edecac
});