<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Editor\Authentication;
use App\Http\Controllers\ManagingEditor\CategoriesTags;
use App\Http\Controllers\ManagingEditor\EssayListMenu;
use App\Http\Controllers\ManagingEditor\ProfileManaging;
use App\Http\Controllers\ManagingEditor\Universities;

Route::post('authenticate', [Authentication::class, '_loginEditor'])->name('editor-login');
Route::get('logout', [Authentication::class, 'logout'])->name('editor-logout');

Route::post('profile/{id_editors}', [ProfileManaging::class, 'update'])->name('update-profile');

Route::post('ongoing/accept/{id_essay}', [EssayListMenu::class, 'accept'])->name('accept-essay');
Route::post('ongoing/reject/{id_essay}', [EssayListMenu::class, 'reject'])->name('reject-essay');
Route::post('ongoing/upload/{id_essay}', [EssayListMenu::class, 'uploadEssay'])->name('upload-essay');
Route::post('ongoing/addcomment/{id_essay}', [EssayListMenu::class, 'addComment'])->name('add-comment');
Route::post('ongoing/uploadrevise/{id_essay}', [EssayListMenu::class, 'uploadRevise'])->name('upload-revise');

Route::post('university', [Universities::class, 'store'])->name('add-universities');
Route::post('university/{uni_id}', [Universities::class, 'update'])->name('update-universities');
Route::delete('university/{uni_id}', [Universities::class, 'delete'])->name('delete-universities');

Route::post('tag', [CategoriesTags::class, 'store'])->name('add-tags');
Route::post('tag/{tag_id}', [CategoriesTags::class, 'update'])->name('update-tags');
Route::delete('tag/{tag_id}', [CategoriesTags::class, 'delete'])->name('delete-tags');