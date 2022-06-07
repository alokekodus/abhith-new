<?php

use Illuminate\Routing\Route;

Route::group(['middleware' => ['auth'] ],function(){
    Route::prefix('course-management')->group(function(){

    });
});