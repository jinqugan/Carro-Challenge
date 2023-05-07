<?php

namespace App\Http\Controllers\V1;
// use App\Http\Controllers\V1\InternetServiceProviderController;
// use App\Http\Controllers\V1\JobController;
// use App\Http\Controllers\V1\LoginController;
// use App\Http\Controllers\V1\PostController;
// use App\Http\Controllers\V1\StaffController;
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

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'list']);
        Route::post('reaction', [PostController::class, 'toggleReaction']);
    });

    Route::get('invoice-amount/{type}', [InternetServiceProviderController::class, 'service']);

    Route::post('job/apply', [JobController::class, 'apply']);
    Route::post('staff/salary', [StaffController::class, 'payroll']);
});
