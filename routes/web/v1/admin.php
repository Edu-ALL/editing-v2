<?php

use App\Http\Controllers\Admin\Authentication;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Export;
use App\Http\Controllers\Admin\Universities;
use App\Http\Controllers\CRM\Clients as CRMClients;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [Authentication::class, '_loginAdmins'])->name('admin-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');

Route::get('sync/clients', [CRMClients::class, 'syncCRMClients'])->name('sync-clients');
Route::post('sync/clients', [CRMClients::class, 'doSyncCRMClients'])->name('do-sync-clients');

Route::post('university', [Universities::class, 'store'])->name('add-university');