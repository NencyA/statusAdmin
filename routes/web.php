<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\VideoController;

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
    return view('login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-check', [AuthController::class, 'loginCheck'])->name('login-check');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
Route::get('forgot-password',function () { return view("forgotpwd"); });
Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/user-list', [UserController::class, 'userList'])->name('user-list');
    Route::post('/user-edit', [UserController::class, 'userEdit'])->name('user-edit');
    Route::post('/user-create', [UserController::class, 'userCreate'])->name('user-create');
    Route::post('/user-update', [UserController::class, 'userUpdate'])->name('user-update');
    Route::post('/user-status', [UserController::class, 'userStatus'])->name('user-status');
    Route::delete('/user-delete', [UserController::class, 'userDelete'])->name('user-delete');
    Route::get('/settings', [AuthController::class, 'settings'])->name('settings');
    Route::get('/reported-video', [VideoController::class, 'reportedVideo'])->name('reported-video');
    Route::post('/get-video-data', [VideoController::class, 'reportedVideoData'])->name('reported-video-data');
});
