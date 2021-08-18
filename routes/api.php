<?php

use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->name('api.v1.')->group(function () {

    // User
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('{user}', [UserController::class, 'show'])->name('show');
    });
    // End User
});
