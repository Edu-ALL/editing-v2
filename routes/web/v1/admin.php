<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Essays;
use App\Http\Controllers\Admin\Export;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Editors;
use App\Http\Controllers\Admin\Program;
use App\Http\Controllers\Admin\EssayPrompt;
use App\Http\Controllers\Admin\Universities;
use App\Http\Controllers\Admin\Authentication;
use App\Http\Controllers\Admin\CategoriesTags;
use App\Http\Controllers\CRM\Clients as CRMClients;
use App\Http\Controllers\CRM\Mentors as CRMMentors;
use App\Models\Editor;

Route::post('authenticate', [Authentication::class, '_loginAdmins'])->name('admin-login');
Route::get('logout', [Authentication::class, 'logout'])->name('logout');

// Route::get('sync/clients', [CRMClients::class, 'syncCRMClients'])->name('sync-clients'); # version 1
Route::get('sync/clients', [CRMClients::class, 'syncCRMV2Clients'])->name('sync-clients'); # version 2
// Route::post('sync/clients', [CRMClients::class, 'doSyncCRMClients'])->name('do-sync-clients');
Route::post('sync/clients', [CRMClients::class, 'doSyncCRMV2Clients'])->name('do-sync-clients');

// Route::get('sync/mentors', [CRMMentors::class, 'doSyncCRMMentors'])->name('do-sync-mentors');
Route::get('sync/mentors', [CRMMentors::class, 'doSyncCRMV2Mentors'])->name('do-sync-mentors');

Route::post('university', [Universities::class, 'store'])->name('add-university');
Route::post('university/{uni_id}', [Universities::class, 'update'])->name('update-university');
Route::delete('university/{uni_id}', [Universities::class, 'delete'])->name('delete-university');

Route::post('tag', [CategoriesTags::class, 'store'])->name('add-tag');

Route::middleware(['cors'])->group(function () {
    Route::put('tag/{tag_id}', [CategoriesTags::class, 'update'])->name('update-tag');
    Route::delete('tag/{tag_id}', [CategoriesTags::class, 'delete'])->name('delete-tag');
});

Route::post('essay-prompt', [EssayPrompt::class, 'store'])->name('add-prompt');
Route::post('essay-prompt/{prompt_id}', [EssayPrompt::class, 'update'])->name('update-prompt');
Route::delete('essay-prompt/{prompt_id}', [EssayPrompt::class, 'delete'])->name('delete-prompt');

Route::post('program', [Program::class, 'store'])->name('add-program');
Route::post('program/{program_id}', [Program::class, 'update'])->name('update-program');
Route::delete('program/{program_id}', [Program::class, 'delete'])->name('delete-program');

Route::post('editor', [Editors::class, 'store'])->name('add-editor');
Route::post('editor/{id_editors}', [Editors::class, 'update'])->name('update-editor');
Route::post('editor/deactivate/{id_editors}', [Editors::class, 'deactivate'])->name('deactivate-editor');
Route::post('editor/activate/{id_editors}', [Editors::class, 'activate'])->name('activate-editor');

Route::post('student/mentor/{id_clients}', [Clients::class, 'updateMentor'])->name('update-mentor');
Route::post('student/backup/{id_clients}', [Clients::class, 'updateBackupMentor'])->name('update-backup-mentor');

Route::post('essay-list/ongoing/assign/{id_essay}', [Essays::class, 'assignEditor'])->name('assign-editor');
Route::post('essay-list/ongoing/cancel/{id_essay}', [Essays::class, 'cancel'])->name('cancel-editor');
// Route::post('essay-list/ongoing/verify/{id_essay}', [Essays::class, 'verifyEssay'])->name('verify-essay');
// Route::post('essay-list/ongoing/revise/{id_essay}', [Essays::class, 'reviseEssay'])->name('revise-essay');


