<?php

use App\Http\Controllers\Admin\Authentication;
use App\Http\Controllers\Admin\CategoriesTags;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Export;
use App\Http\Controllers\Admin\Universities;
use App\Http\Controllers\CRM\Clients as CRMClients;
use App\Http\Controllers\CRM\Mentors as CRMMentors;
use Illuminate\Support\Facades\Route;

Route::post('authenticate', [Authentication::class, '_loginAdmins'])->name('admin-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');

Route::get('sync/clients', [CRMClients::class, 'syncCRMClients'])->name('sync-clients');
Route::post('sync/clients', [CRMClients::class, 'doSyncCRMClients'])->name('do-sync-clients');

Route::get('sync/mentors', [CRMMentors::class, 'doSyncCRMMentors'])->name('do-sync-mentors');

Route::post('university', [Universities::class, 'store'])->name('add-university');
Route::post('university/{uni_id}', [Universities::class, 'update'])->name('update-university');
Route::delete('university/{uni_id}', [Universities::class, 'delete'])->name('delete-university');

Route::post('tag', [CategoriesTags::class, 'store'])->name('add-tag');

Route::middleware(['cors'])->group(function () {
    Route::put('tag/{tag_id}', [CategoriesTags::class, 'update'])->name('update-tag');
    Route::delete('tag/{tag_id}', [CategoriesTags::class, 'delete'])->name('delete-tag');
});