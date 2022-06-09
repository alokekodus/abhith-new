<?php
use App\Http\Controllers\teacher\CourseController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('course')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('teacher.course');
        Route::get('/create', [CourseController::class, 'create'])->name('teacher.course.create');
        Route::get('/view/{subject_id}', [CourseController::class, 'view'])->name('teacher.course.view');
    });
    
});
