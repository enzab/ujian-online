<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// prefix "admin"
Route::prefix('admin')->group(function() {

    // middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        // route dashboard
        Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');

        // route resource lessons
        Route::resource('/lessons', \App\Http\Controllers\Admin\LessonController::class, ['as' => 'admin']);

        // route resource classrooms
        Route::resource('/classrooms', \App\Http\Controllers\Admin\ClassroomController::class, ['as' => 'admin']);

        // route student import
        Route::get('/students/import', [\App\Http\Controllers\Admin\StudentController::class, 'import'])->name('admin.students.import');

        // route student store import
        Route::post('/students/import', [\App\Http\Controllers\Admin\StudentController::class, 'storeImport'])->name('admin.student.storeImport');

        // route resource students
        Route::resource('/students', \App\Http\Controllers\Admin\StudentController::class, ['as' => 'admin']);

        // route resource exams
        Route::resource('/exams', \App\Http\Controllers\Admin\ExamController::class, ['as' => 'admin']);
    });
});