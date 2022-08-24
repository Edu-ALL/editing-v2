<?php

use App\Http\Controllers\Admin\Authentication;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [Authentication::class, '_loginAdmins'])->name('admin-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');