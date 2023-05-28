<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/auth/')->group(function () {
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/register', [AuthenticationController::class, 'register']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    // route for logout
    Route::post('/auth/logout', [AuthenticationController::class, 'logout']);
    // route for data
    Route::apiResources([
        'user' => UserController::class,
        'company' => CompanyController::class,
        'report' => ReportController::class,
        'comment' => CommentController::class,
    ]);
});
