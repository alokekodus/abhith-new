<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\LessonController;
use App\Http\Controllers\website\DashboardController;
use App\Http\Controllers\website\BlogController;
use App\Http\Controllers\website\GalleryController;
use App\Http\Controllers\website\CourseController;
use App\Http\Controllers\website\WebsiteAuthController;
use App\Http\Controllers\website\UserDetailsController;
use App\Http\Controllers\website\KnowledgeForumPostController;
use App\Http\Controllers\website\KnowledgeForumController;
use App\Http\Controllers\website\KnowledgeForumCommentsController;
use App\Http\Controllers\website\ReportPostController;
use App\Http\Controllers\website\ReportBlogController;
use App\Http\Controllers\admin\MultipleChoiceController;
use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\RazorpayPaymentController;
use App\Http\Controllers\website\PaymentController;
use App\Http\Controllers\admin\TimeTableController;
use App\Http\Controllers\website\SubjectController;
use App\Http\Controllers\website\UserCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('',[DashboardController::class,'index'])->name('website.dashboard');

Route::get('dashboard', function () {
    return view('admin.dashboard.dashboard');
})->name('admin.dashboard')->middleware('admin');
/* ------------------------------- Course ------------------------------------ */
Route::prefix('course')->group(function(){
    Route::get('', [CourseController::class,'index'])->name('website.course');
    Route::get('details/{id}', [CourseController::class,'details'])->name('website.course.details');
    Route::post('package', [CourseController::class,'coursePackageFilter'])->name('website.course.package.filter');
    Route::any('all', [CourseController::class,'coursePackageAll'])->name('website.course.package.filter.all');
    Route::get('start/{subject_id}', [CourseController::class,'subjectDetails'])->name('website.course.package.subject.detatils');
    
    
});
Route::prefix('subject')->group(function(){
    Route::get('/{subject_id}', [SubjectController::class,'subjectDetails'])->name('website.subject.detatils');
    Route::get('mcq/{set_id}', [SubjectController::class,'subjectMCQ'])->name('website.subject.mcq');
});

/* ------------------------------- Blog ------------------------------------ */
Route::prefix('blog')->group(function(){
    Route::get('', [BlogController::class,'getBlog'])->name('website.blog');
    Route::get('details/{id}',[BlogController::class,'details'])->name('website.blog.details');
    Route::post('create-blog',[BlogController::class,'createBlog'])->name('website.blog.create');

    Route::get('report-blog',[ReportBlogController::class,'getReportedBlog'])->name('website.blog.report.get');
    Route::post('report-blog',[ReportBlogController::class,'reportBlog'])->name('website.blog.report');
    Route::post('remove-reported-blog',[ReportBlogController::class,'removeReportedBlog'])->name('website.blog.report.remove');
});


/* ------------------------------- Gallery ------------------------------------ */
Route::prefix('gallery')->group(function(){
    Route::get('', [GalleryController::class,'index'])->name('website.gallery');
});




/* ------------------------------- Admin Login ------------------------------------ */
Route::view('login','admin.auth.login')->middleware('customRedirect')->name('login');
Route::post('signin',[AuthController::class,'customLogin'])->name('custom.signin');


/* ------------------------------- Website Login ---------------------------------- */
Route::prefix('auth')->group(function(){
    Route::post('signup', [WebsiteAuthController::class,'signup'])->name('website.auth.signup');
    Route::post('login', [WebsiteAuthController::class,'login'])->name('website.auth.login');
    Route::post('logout', [WebsiteAuthController::class,'logout'])->name('website.auth.logout');
    Route::post('verify-otp', [WebsiteAuthController::class,'verifyOtp'])->name('website.auth.verify.otp');
    Route::post('complete-signup', [WebsiteAuthController::class,'completeSignup'])->name('website.auth.complete.signup');
});

/* ------------------------------- Account ------------------------------------ */
Route::prefix('account')->group(function(){
    Route::get('my-account',[UserDetailsController::class,'myAccount'])->name('website.user.account');
    Route::post('user-details',[UserDetailsController::class,'userDetails'])->name('website.user.details');
    Route::post('user-photo',[UserDetailsController::class,'uploadPhoto'])->name('website.user.upload.photo');
    Route::post('update-password',[UserDetailsController::class,'updatePassword'])->name('website.update.password');
    Route::get('my-courses/{order_id}',[UserCourseController::class,'displayUserSubjects'])->name('website.user.courses');
    Route::get('my-lesson/{order_id}/{subject_id}',[UserCourseController::class,'myLesson'])->name('website.user.lesson');
    Route::get('my-lesson/{topic_id}',[UserDetailsController::class,'myLessonDetails'])->name('website.user.lesson.details');
    Route::post('attachment', [UserDetailsController::class,'displayAttachment'])->name('website.user.lesson.attachment');
    Route::get('lesson/{id',[LessonController::class,'LessonDetails'])->name('website.user.lessonbyid');
});


/* ------------------------------- Knowledge Forum------------------------------------ */

Route::prefix('knowledge')->group(function(){
    Route::get('knowledge-forum',[KnowledgeForumController::class,'index'])->name('website.knowledge.forum');
    Route::post('add-knowledge-question',[KnowledgeForumPostController::class,'addKnowledgeQuestion'])->name('website.add.knowledge.question');
    Route::get('knowledge-details-post/{id}',[KnowledgeForumController::class,'knowledgeDetailPost'])->name('website.knowledge.details.post');
    Route::post('knowledge-comment',[KnowledgeForumCommentsController::class,'knowledgeComment'])->name('website.knowledge.comment');
    Route::get('knowledge-tab', [KnowledgeForumController::class,'knowledgeTab'])->name('website.knowledge.tab');
    Route::get('get-report-knowledge-post',[ReportPostController::class,'getReportedPost'])->name('website.get.report.knowledge.post');
    Route::post('report-knowledge-post', [ReportPostController::class, 'reportPost'])->name('website.report.knowledge.post');
    Route::post('remove-reported-post',[ReportPostController::class, 'moveToTrash'])->name('website.remove.reported.post');
});


/* ------------------------------- Multiple Choice Question ------------------------------------ */

Route::post('check-is-correct-mcq',[MultipleChoiceController::class,'checkIsCorrectMcq'])->name('website.check.is.correct-mcq');
Route::view('mcq-result','website.multiple-choice.review-mcq')->name('website.mcq-result');

/* ------------------------------- Cart ------------------------------------ */

Route::prefix('cart')->group(function(){
    Route::get('cart-details',[CartController::class,'index'])->name('website.cart');
    Route::post('add-to-cart',[CartController::class,'addToCart'])->name('website.add-to-cart');
    Route::post('remove-from-cart',[CartController::class,'removeFromCart'])->name('website.remove-from-cart');
});


/* ------------------------------- Checkout / Payment------------------------------------ */
Route::get('checkout', [PaymentController::class, 'checkout'])->name('website.checkout');

Route::prefix('payment')->group(function(){
    Route::post('verify-payment', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
});

/* ------------------------------- Time table ------------------------------------ */
Route::prefix('time-table')->group(function(){
    Route::get('', [TimeTableController::class, 'websiteViewTimeTable'])->name('website.get.time.table');
});


/* ------------------------------- Views -> Alok ------------------------------------ */
Route::view('about-us','website.about.about')->name('website.about');

Route::view('contact','website.contact.contact')->name('website.contact');

Route::view('website/login','website.auth.login')->name('website.login');
Route::view('website/forgot-password','website.auth.forgot')->name('website.forgot.password');
Route::view('website/new-password','website.auth.newpassword')->name('website.new.password');
Route::view('admin/course/view','admin.course.view')->name('admin.course.view');

Route::view('website/faq', 'website.docs.faq')->name('website.faq');
Route::view('website/privacy-policy', 'website.docs.privacy')->name('website.privacy');
Route::view('website/terms-and-conditions', 'website.docs.terms')->name('website.terms');
Route::view('website/refund-and-cancellation-policy', 'website.docs.refund')->name('website.refund');


