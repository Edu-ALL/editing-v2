<?php

use App\Http\Controllers\Mentor\Authentication;
use App\Http\Controllers\Mentor\Clients;
use App\Http\Controllers\CRM\Clients as CRMClients;
use Illuminate\Support\Facades\Route;

Route::post('authenticate/mentor', [Authentication::class, '_loginMentors'])->name('mentor-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');

Route::get('sync/clients', [CRMClients::class, 'syncCRMClients'])->name('sync-clients');
Route::post('sync/clients', [CRMClients::class, 'doSyncCRMClients'])->name('do-sync-clients');