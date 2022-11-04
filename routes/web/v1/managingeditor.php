<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\Authentication;
use App\Http\Controllers\ManagingEditor\AllEditorMenu;
use App\Http\Controllers\ManagingEditor\AllEssaysMenu;
use App\Http\Controllers\ManagingEditor\CategoriesTags;
use App\Http\Controllers\ManagingEditor\EssayListMenu;
use App\Http\Controllers\ManagingEditor\ProfileManaging;
use App\Http\Controllers\ManagingEditor\Universities;

Route::post('authenticate', [Authentication::class, '_loginEditor'])->name('editor-login');
Route::get('logout', [Authentication::class, 'logout'])->name('editor-logout');

Route::post('profile/managing/{id_editors}', [ProfileManaging::class, 'update'])->name('update-managing-profile');

Route::post('all-essay/ongoing/managing/assign/{id_essay}', [AllEssaysMenu::class, 'assignEditor'])->name('assign-editor');
Route::post('all-essay/ongoing/managing/cancel/{id_essay}', [AllEssaysMenu::class, 'cancel'])->name('cancel-editor');
Route::post('all-essay/ongoing/managing/verify/{id_essay}', [AllEssaysMenu::class, 'verify'])->name('verify-editor-essay');
Route::post('all-essay/ongoing/managing/revise/{id_essay}', [AllEssaysMenu::class, 'revise'])->name('revise-editor-essay');
Route::post('all-essay/ongoing/managing/sendEmail/{id_essay}', [AllEssaysMenu::class, 'send_email'])->name('send-email-mentor');
Route::post('all-essay/ongoing/managing/cancelRevise/{id_essay}', [AllEssaysMenu::class, 'cancel_revise'])->name('cancel-revise-essay');

Route::post('ongoing/managing/accept/{id_essay}', [EssayListMenu::class, 'accept'])->name('accept-your-essay');
Route::post('ongoing/managing/reject/{id_essay}', [EssayListMenu::class, 'reject'])->name('reject-your-essay');
Route::post('ongoing/managing/upload/{id_essay}', [EssayListMenu::class, 'uploadEssay'])->name('upload-your-essay');
Route::post('ongoing/managing/addcomment/{id_essay}', [EssayListMenu::class, 'addComment'])->name('add-your-comment');
Route::post('ongoing/managing/uploadrevise/{id_essay}', [EssayListMenu::class, 'uploadRevise'])->name('upload-your-revise');

Route::post('university', [Universities::class, 'store'])->name('add-universities');
Route::post('university/{uni_id}', [Universities::class, 'update'])->name('update-universities');
Route::delete('university/{uni_id}', [Universities::class, 'delete'])->name('delete-universities');

Route::post('tag', [CategoriesTags::class, 'store'])->name('add-tags');
Route::post('tag/{tag_id}', [CategoriesTags::class, 'update'])->name('update-tags');
Route::delete('tag/{tag_id}', [CategoriesTags::class, 'delete'])->name('delete-tags');

Route::post('editor/managing/{id_editors}', [AllEditorMenu::class, 'update'])->name('update-managing-editor');
Route::post('editor/managing/deactivate/{id_editors}', [AllEditorMenu::class, 'deactivate'])->name('deactivate-editor');
Route::post('editor/managing/activate/{id_editors}', [AllEditorMenu::class, 'activate'])->name('activate-editor');