<?php

use App\Http\Controllers\StudentController;
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





//Route::middleware([
//    'auth:sanctum',
//    config('jetstream.auth_session'),
//    'verified'
//])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});
Route::get('students', [App\Http\Controllers\StudentInfoController::class, 'index']);
Route::get('students/save', [App\Http\Controllers\StudentInfoController::class, 'store'])->name('students.save');
//Route::get('student-info', [App\Http\Controllers\StudentInfoTwoController::class, 'addStudentInfo'])->name('student-info');
