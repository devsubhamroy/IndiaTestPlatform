<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('/dashboard', 'student.index')->name('student.dashboard');
Route::view('/student/test', 'student/test')->name('student.test');

Route::view('/', 'admin.index')->name('admin.dashboard');
Route::view('/manage-test', 'admin.manage')->name('admin.manage');
Route::view('/student-result', 'admin.student_result')->name('admin.student_result');
Route::view('/student-info', 'admin.student_info')->name('admin.student_info');
Route::view('/student-qns', 'admin.create_qns')->name('admin.student_qns');


use App\Http\Controllers\{
    RoleController, UserController, TestController,
    QuestionController, AttemptController, ResultController, ChatController
};

Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('tests', TestController::class);
Route::resource('questions', QuestionController::class);
Route::resource('attempts', AttemptController::class);
Route::resource('results', ResultController::class);
Route::resource('chats', ChatController::class);

