<?php

use App\Http\Controllers\admin\BoardController;
use App\Http\Controllers\api\BannerController;
use App\Http\Controllers\api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\GalleryController;
use App\Http\Controllers\Api\MobileEmailVerificationController;
use App\Http\Controllers\api\SubjectController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\website\WebsiteAuthController;
use App\Models\MobileAndEmailVerification;

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

//singup verify otp
Route::post('send-mobile-otp', [WebsiteAuthController::class, 'sendMobileOtp']);
Route::post('verify-mobile-otp', [WebsiteAuthController::class, 'verifyMobileOtp']);
Route::post('send-email-otp', [WebsiteAuthController::class, 'sendEmailOtp']);
Route::post('verify-email-otp', [WebsiteAuthController::class, 'verifyEmailOtp']);


Route::get('/video-url', function () {
    $path = storage_path('app/public/1_480.mp4');
    return response()->json($path); 
});
//get banner
Route::get('/banner',[BannerController::class,'index']);
Route::post('get-course-details', [CourseController::class, 'index']);
//courses
Route::prefix('homepage')->group(function(){
    //homepage courses
    Route::get('courses',[CourseController::class,'allCourses']);
    //homepage  upcomming courses
    Route::get('upcomming',[CourseController::class,'allUpcommingCourses']);
    Route::post('get-class', [CourseController::class, 'findClass'])->name('board.class');
   
});
Route::get('all-class', [CourseController::class, 'findAllClass']);
Route::post('subjects',[SubjectController::class,'findSubject']);
Route::get('subject-details',[SubjectController::class,'subjectDetails']);
Route::get('subject/lessons',[SubjectController::class,'LessonDetails']);
Route::get('subject/lesson/topic',[SubjectController::class,'LessonTopics']);
Route::get('subject/lesson/video',[SubjectController::class,'LessonVideoDetails']);
Route::get('subject/lesson/pdf',[SubjectController::class,'LessonPdfDetails']);
Route::get('subject/lesson/content',[SubjectController::class,'LessonContentDetails']);
Route::get('subject/mcq',[SubjectController::class,'LessonMCQ']);
Route::get('subject/mcq-question',[SubjectController::class,'LessonMcqQuestion']);
Route::middleware('auth:sanctum')->post('subject/mcq/submit',[SubjectController::class,'startMcq']);

Route::get('/gallery',[GalleryController::class,'index']);
//get board
Route::get('/board',[BoardController::class,'index']);


Route::post('board-class-subject', [CourseController::class, 'findBoardClassSubject'])->name('board.class.subject');

//laravel cart
Route::group(['prefix' => 'cart','middleware' => ['auth:sanctum']], function() {
    Route::get('/',[CartController::class,'index']);
    Route::get('/cart-details',[CartController::class,'cartDetails']);
    Route::post('/store', [CartController::class,'store']);
    Route::get('/remove', [CartController::class,'remove']);
});
Route::group(['prefix' => 'user','middleware' => ['auth:sanctum']], function() {
    Route::get('/',[UserController::class,'index']);
});
Route::post('/upload-note',[GalleryController::class,'testapi']);