<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
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

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::prefix('attendances')->middleware('auth')->group(function () {
    Route::get('index', [AttendanceController::class, 'index'])->name('attendance.index');

    Route::patch('clock-in/{attendance}', [AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
    Route::patch('clock-out/{attendance}', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');
    Route::patch('break-start/{attendance}', [AttendanceController::class, 'breakStart'])->name('attendance.break-start');
    Route::patch('break-end/{attendance}', [AttendanceController::class, 'breakEnd'])->name('attendance.break-end');

    // Route::get('search', [AttendanceController::class, 'search'])->name('attendance.search');
    Route::get('detail', [AttendanceController::class, 'detail'])->name('attendance.detail');
    Route::get('request/{attendance}', [AttendanceController::class, 'requestForm'])->name('attendance.requestForm');

    Route::post('request/{attendance}', [AttendanceController::class, 'request'])->name('attendance.request');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('users/add', [RegisterController::class, 'index'])->name('admin.add');
    Route::post('users/register', [RegisterController::class, 'register'])->name('admin.register');

    Route::get('users/index', [AdminController::class, 'usersIndex'])->name('admin.users.index');
    Route::get('/users/{user}/requests', [AdminController::class, 'userRequests'])->name('admin.user.request');
    Route::get('requests/index', [AdminController::class, 'requestsIndex'])->name('admin.requests.index');
    // Route::get('search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('request/{attendanceRequest}/edit', [AdminController::class, 'edit'])->name('admin.request.edit');
    Route::patch('request/{attendanceRequest}', [AdminController::class, 'update'])->name('admin.request.update');

});



