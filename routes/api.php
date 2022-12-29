<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\postController;
use App\Http\Controllers\characteristicsController;

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

Route::get('/posts', [postController::class, 'index']);
Route::post('/postsSave', [postController::class, 'store']);
Route::get('/SinglePostd', [postController::class, 'singlePost']);
Route::get('/characteristics', [characteristicsController::class, 'index']);
