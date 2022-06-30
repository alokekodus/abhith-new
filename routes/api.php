<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\website\WebsiteAuthController;

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

//singup api
// Route::post('signup', [WebsiteAuthController::class, 'signup']);
Route::post('verify-otp', [WebsiteAuthController::class, 'verifyOtp']);
Route::post('signup', [WebsiteAuthController::class, 'mobileSignUp']);
Route::post('login', [WebsiteAuthController::class, 'login']);





Route::post('get-course-details', [CourseController::class, 'index']);
Route::post('get-class', [CourseController::class, 'findClass'])->name('board.class');
Route::post('board-class-subject', [CourseController::class, 'findBoardClassSubject'])->name('board.class.subject');
