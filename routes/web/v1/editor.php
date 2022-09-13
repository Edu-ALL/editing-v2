<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\Authentication;
use App\Http\Controllers\Editor\Profile;
use App\Http\Controllers\Editor\Essays;

Route::post('authenticate', [Authentication::class, '_loginEditor'])->name('editor-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');

Route::post('profile/{id_editors}', [Profile::class, 'update'])->name('update-profile');

Route::post('ongoing/accept/{id_essay}', [Essays::class, 'accept'])->name('accept-essay');