<?php

use App\Http\Controllers\RegisterController;
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

Route::middleware('auth')->group(function () {

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('users/create', [RegisterController::class, 'index'])->name('admin.add');
    Route::post('users/create', [RegisterController::class, 'register'])->name('admin.register');
});



