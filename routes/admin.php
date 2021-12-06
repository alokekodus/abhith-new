<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\ChapterController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\MultipleChoiceController;
use App\Http\Controllers\admin\EnrolledController;
use App\Http\Controllers\admin\TimeTableController;


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
Route::get('logout',[AuthController::class,'logout'])->name('log.out');

Route::get('dashboard', function () {
    return view('admin.dashboard.dashboard');
})->name('admin.dashboard');

/* ------------------------------- COURSE ------------------------------------ */
Route::prefix('course')->group(function () {

    /* ------------------------------- COURSE ------------------------------------ */
    Route::get('',[CourseController::class,'index'])->name('admin.get.course');
    Route::view('create', 'admin.course.create')->name('admin.create.course');
    Route::post('creating',[CourseController::class,'create'])->name('admin.creating.course');
    Route::post('ckeditorImage',[CourseController::class,'ckeditorImage'])->name('admin.course.upload');
    Route::get('edit/{id}',[CourseController::class,'editCourse'])->name('admin.edit.course');
    Route::post('editing',[CourseController::class,'edit'])->name('admin.editing.course');
    Route::post('active',[CourseController::class,'active'])->name('admin.active.course');
    Route::get('price/{id}',[CourseController::class,'chapterPrice'])->name('admin.price.course');

});

/* ------------------------------- CHAPTER ------------------------------------ */
Route::prefix('chapter')->group(function () {

    /* ------------------------------- CHAPTER ------------------------------------ */
    Route::get('{id}',[ChapterController::class,'index'])->name('admin.get.chapter');
    // Route::view('create', 'admin.course.create')->name('admin.create.course');
    Route::post('creating',[ChapterController::class,'create'])->name('admin.creating.chapter');
    Route::post('editChapter',[ChapterController::class,'editChapter'])->name('admin.edit.chapter');
    Route::post('changeChapterVisibility',[ChapterController::class,'changeChapterVisibility'])->name('admin.change.visibility.chapter');

});

/* ------------------------------- Master ------------------------------------ */
Route::prefix('master')->group(function () {

    /* ------------------------------- COURSE ------------------------------------ */
    Route::prefix('subject')->group(function () {
        Route::get('',[SubjectController::class,'index'])->name('admin.get.subject');
        Route::view('create', 'admin.master.subjects.create')->name('admin.create.subject');
        Route::post('creating',[SubjectController::class,'create'])->name('admin.creating.subject');
        Route::post('active',[SubjectController::class,'active'])->name('admin.active.subject');
        Route::get('edit/{id}',[SubjectController::class,'editSubject'])->name('admin.edit.subject');
        Route::post('editing',[SubjectController::class,'edit'])->name('admin.editing.subject');

    });

    /* ------------------------------- Banner ------------------------------------ */
    Route::prefix('banner')->group(function () {
        Route::get('',[BannerController::class,'index'])->name('admin.get.banner');
        Route::view('create', 'admin.master.banner.create')->name('admin.create.banner');
        Route::post('creating',[BannerController::class,'create'])->name('admin.creating.banner');
        Route::post('active',[BannerController::class,'active'])->name('admin.active.banner');
        Route::get('edit/{id}',[BannerController::class,'editBanner'])->name('admin.edit.banner');
        Route::post('editing',[BannerController::class,'edit'])->name('admin.editing.banner');

    });

    /* ------------------------------- Blog ------------------------------------ */
    Route::prefix('blog')->group(function () {
        // Route::get('',[BlogController::class,'index'])->name('admin.get.blog');
        Route::get('blog/{id?}',[BlogController::class,'index'])->name('admin.get.blog.by.id');
        Route::view('create','admin.master.blog.create')->name('admin.create.blog');
        Route::post('creating',[BlogController::class,'create'])->name('admin.creating.blog');
        Route::post('ckeditorImage',[BlogController::class,'ckeditorImage'])->name('upload');
        Route::post('active',[BlogController::class,'active'])->name('admin.active.blog');
        Route::get('edit/{id}',[BlogController::class,'editBlog'])->name('admin.edit.blog');
        Route::post('editing',[BlogController::class,'edit'])->name('admin.editing.blog');
        Route::get('view/{id}',[BlogController::class,'viewBlog'])->name('admin.read.blog');
    });

     /* ------------------------------- Gallery ------------------------------------ */
     Route::prefix('gallery')->group(function () {
        Route::get('',[GalleryController::class,'index'])->name('admin.get.gallery');
        Route::view('create','admin.master.gallery.create')->name('admin.create.gallery');
        Route::post('creating',[GalleryController::class,'create'])->name('admin.creating.gallery');
        Route::post('active',[GalleryController::class,'active'])->name('admin.active.gallery');
        Route::get('edit/{id}',[GalleryController::class,'editGallery'])->name('admin.edit.gallery');
        Route::post('editing',[GalleryController::class,'edit'])->name('admin.editing.gallery');
    });

    
});


/* ------------------------------- Multiple Choice Questions ------------------------------------ */
Route::prefix('multiple-choice')->group(function(){
    Route::get('multiple-choice-question',[MultipleChoiceController::class,'index'])->name('admin.index.multiple.choice');
    Route::get('add-multiple-choice',[MultipleChoiceController::class,'addMultipleChoice'])->name('admin.add.multiple.choice');
    Route::post('insert-multiple-choice',[MultipleChoiceController::class,'insertMultipleChoice'])->name('admin.insert.multiple.choice');
    Route::post('is-activate-multiple-choice',[MultipleChoiceController::class,'isActivateMultipleChoice'])->name('admin.is.activate.multiple.choice');
});


/* ------------------------------- Enrolled Students ------------------------------------ */
Route::prefix('enrolled')->group(function(){
    Route::get('students',[ EnrolledController::class, 'getEnrolledStudents'])->name('admin.get.enrolled.students');
});

/* ------------------------------- Time Table ------------------------------------ */
Route::prefix('time-table')->group(function(){
    Route::get('view-time-table',[ TimeTableController::class, 'adminViewTimeTable'])->name('admin.view.time.table');
    Route::get('create-time-table',[ TimeTableController::class, 'adminCreateTimeTable'])->name('admin.create.time.table');
    Route::post('save-time-table',[ TimeTableController::class, 'saveTimeTable'])->name('admin.save.time.table');
    Route::post('change-visibility-time-table',[ TimeTableController::class, 'changeVisibility'])->name('admin.change.visibility.time.table');
});