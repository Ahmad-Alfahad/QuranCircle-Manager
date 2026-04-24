<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CircleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::resource('circles', CircleController::class);
    Route::resource('students' , StudentController::class );
    Route::resource('records', RecordController::class);
    Route::resource('attendance' , AttendanceController::class);
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/make-student', [UserController::class, 'makeStudent'])
    ->name('users.makeStudent');
});

require __DIR__.'/auth.php';
