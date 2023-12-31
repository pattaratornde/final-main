<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController; 
use App\Http\Controllers\TAController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\TainfoController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\WorkloadController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdmincourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AddBookbankController;
use App\Http\Controllers\ClassAttendanceController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('Usertype');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('request',RequestController::class);
    Route::resource('create',RequestController::class);
    Route::resource('tainfo',TainfoController::class);
    Route::resource('course',DetailController::class);
    Route::resource('calendar',CalendarController::class);
    //Route::resource('workload',WorkloadController::class);
    Route::resource('attendance',AttendanceController::class);

    Route::get('/download/{filename}', [FileController::class, 'download'])->name('download');

    Route::resource('admin', AdminController::class);
    Route::resource('admincourse',AdmincourseController::class);
    
    Route::get('/searchTa/search',[AdmincourseController::class, 'search'])->name('search');
    Route::delete('reqs/{id}', [RequestController::class, 'delete'])->name('delete');

    Route::get('users/export/{id}', [TainfoController::class, 'export'])->name('export');
    Route::get('users/export/september/{id}', [TainfoController::class, 'monthsep'])->name('monthsep');
    Route::get('users/exportattendance/{id}', [TainfoController::class, 'exportattendace'])->name('exportattendace');
    
    Route::get('attendexport', [TainfoController::class])->name('attendexport');

    Route::resource('teacher',TeacherController::class);
    Route::get('/teacherpage/{teacher_id}',[TeacherController::class, 'showTeacher'])->name('showTeacher');
    Route::get('/subjectpage/{subject_id}',[TeacherController::class, 'showSubject'])->name('showSubject');
    Route::resource('classattend',ClassAttendanceController::class);

    Route::resource('adbookbank',AddBookbankController::class);

    



});

require __DIR__.'/auth.php';
