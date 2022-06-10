<?php
use App\Http\Controllers\teacher\CourseController;
use App\Http\Controllers\teacher\LessonController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('teacher.course');
        Route::get('/create', [CourseController::class, 'create'])->name('teacher.course.create');
        Route::get('/view/{subject_id}', [CourseController::class, 'view'])->name('teacher.course.view');
    });
    Route::prefix('lesson')->group(function () {
        Route::get('/', [LessonController::class, 'index'])->name('teacher.lesson');
    });
   
});
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('preview')->group(function () {
        Route::get('/{type}', [CourseController::class, 'preview'])->name('teacher.course.preview');
    });
    
});