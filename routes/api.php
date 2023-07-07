<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mentor\EssaysMenu;
use App\Http\Controllers\Mentor\NewRequestMenu;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('mentor/essay-list', [EssaysMenu::class, 'listEssayMentee']);
Route::post('mentor/upload/essay', [NewRequestMenu::class, 'mentorUploadEssay']);
Route::get('student/essay-list', [EssaysMenu::class, 'listEssayByStudent']);
