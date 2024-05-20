<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CommentController;

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

Route::prefix('comments')->group(function () {
    Route::get('',  [CommentController::class, 'index'])->name('comments.index');
    Route::post('{article:ext_id}', [CommentController::class, 'store'])->name('comments.store');
});
