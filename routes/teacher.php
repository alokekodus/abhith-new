<?php
use App\Http\Controllers\teacher\CourseController;
use App\Http\Controllers\teacher\LessonController;
use App\Http\Controllers\teacher\StudentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('teacher.course');
        Route::get('/create', [CourseController::class, 'create'])->name('teacher.course.create');
        Route::get('/view/{subject_id}', [CourseController::class, 'view'])->name('teacher.course.view');
        Route::get('/details/{subject_id}', [CourseController::class, 'details'])->name('teacher.course.details');
      
    });
    Route::prefix('lesson')->group(function () {
        Route::get('/', [LessonController::class, 'index'])->name('teacher.lesson');
        Route::get('/{lesson_id}',[LessonController::class,'view'])->name('teacher.lesson.view');
        Route::prefix('topic')->group(function () {
            Route::get('/', [LessonController::class, 'topicView'])->name('teacher.topic.view');
        });
    });
    Route::prefix('student')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('teacher.student.index');
        Route::get('/{subject_id}', [StudentController::class, 'subjectWiseStudent'])->name('teacher.subject.student');
       
     
    });
   
});
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('preview')->group(function () {
        Route::get('/{type}', [CourseController::class, 'preview'])->name('teacher.course.preview');
    });
    
});