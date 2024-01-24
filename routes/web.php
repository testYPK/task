<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('components.loginOrRegister');
});

// AuthController
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//Route::middleware(['auth'])->group(function () {

    // AdminController
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/update-settings', [AdminController::class, 'update'])->name('admin.update');

    // FileController
    Route::post('/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::post('/manual-upload', [FileController::class, 'manualUpload'])->name('files.manualUpload');

    // AwardController
    Route::get('/awards', [AwardController::class, 'showAwardList'])->name('awards.awardList');

    // LogController
    Route::get('/logs', [LogController::class, 'showLogList'])->name('logs.logList');

//});
