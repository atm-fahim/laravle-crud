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
Route::get('student-info', [App\Http\Controllers\StudentInfoTwoController::class, 'addStudentInfo'])->name('student-info');


/*Route::post('/save-uptade-student-info',[App\Http\Controllers\StudentInfoController::class, 'addStudentInfo']);
Route::get('/edit-student-info/{id}',[App\Http\Controllers\StudentInfoController::class, 'addStudentInfo']);
Route::get('/publish-student-info/{id}',[App\Http\Controllers\StudentInfoController::class, 'addStudentInfo']);
Route::get('/unpublish-student-info/{id}',[App\Http\Controllers\StudentInfoController::class, 'addStudentInfo']);*/

