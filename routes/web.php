<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\formController;
use App\Http\Controllers\StudentController;
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


Route::resource('courses', CourseController::class);
Route::resource('stuRegistration', StudentController::class);
Route::get('/studentPanel.confirmation', [StudentController::class, 'confirm'])->name('confirm');

Route::view('success', 'studentPanel.successpage')->name('success');
Route::get('/studentPanel.registeredStudent', [StudentController::class, 'registeredStudent'])->name('registeredStudent');


// Ajax Task

Route::resource('ajax', formController::class);

require __DIR__.'/auth.php';
