<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NovelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::apiResource('novels', NovelController::class);
    Route::apiResource('tags', TagController::class);
    Route::get('/lastNovel', [NovelController::class, 'lastNovel']);
    Route::get('/getNovelByAuthor/{id}', [NovelController::class, 'getNovelByAuthor']);
    Route::apiResource('categories', CategoryController::class);
    
    Route::apiResource('chapters', ChapterController::class);
    Route::get('/chapters/novel/{novel_id}', [ChapterController::class, 'fetchChaptersByNovelId']);

});