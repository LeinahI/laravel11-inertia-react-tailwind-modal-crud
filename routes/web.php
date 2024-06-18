<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /* Students */
    Route::get('/studentsdashboard', [StudentsController::class, 'index'])->name('studentsdashboard.index');
    Route::post('/addStudent', [StudentsController::class, 'store'])->name('addStudent.store');
    Route::patch('/updateStudent/{id}', [StudentsController::class, 'update'])->name('updateStudent.update');
    Route::delete('/deleteStudent/{id}', [StudentsController::class, 'destroy'])->name('deleteStudent.destroy');
});


require __DIR__ . '/auth.php';
