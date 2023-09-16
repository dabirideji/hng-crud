<?php

use App\Http\Controllers\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('', [PersonController::class, 'store']);
Route::get('', PersonController::class);
Route::get('{user_id}', [PersonController::class, 'show'])->where('user_id', '[0-9]+');
Route::put('{user_id}', [PersonController::class, 'update'])->where('user_id', '[0-9]+');
Route::delete('{user_id}', [PersonController::class, 'destroy'])->where('user_id', '[0-9]+');
Route::any('{user_id}', function ($user_id) {
    return response()->json(['error' => 'Invalid parameter. Integer needed, string ' . $user_id . ' provided']);
})->where('user_id', '[a-zA-Z]+');
