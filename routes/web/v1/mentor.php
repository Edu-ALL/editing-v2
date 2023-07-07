<?php

use App\Http\Controllers\Mentor\Authentication;
// use App\Http\Controllers\Mentor\Clients;
use App\Http\Controllers\CRM\Clients as CRMClients;
use App\Http\Controllers\Mentor\EssaysMenu;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [Authentication::class, '_loginMentors'])->name('mentor-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout-mentor');

// Route::get('sync/clients', [CRMClients::class, 'syncCRMClients'])->name('sync-mentors');
// Route::post('sync/clients', [CRMClients::class, 'doSyncCRMClients'])->name('do-sync-mentors');

Route::post('feedback/{id}', [EssaysMenu::class, 'feedback'])->name('add-feedback');