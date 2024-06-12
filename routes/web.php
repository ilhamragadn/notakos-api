<?php

use App\Http\Controllers\Admin\AdminLiteraturController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Mail\RekapBulananController;
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

Route::get('/admin/login', function () {
    return view('admin.pages.auth.login');
})->middleware('guest')->name('admin.login');

Route::get('/admin/register', function () {
    return view('admin.pages.auth.register');
})->middleware('guest')->name('admin.register');

// ADMIN
Route::post('/admin/register', [RegisteredUserController::class, 'storeWeb'])
    ->middleware('guest')
    ->name('admin.register');

Route::post('/admin/login', [AuthenticatedSessionController::class, 'storeWeb'])
    ->middleware('guest')
    ->name('admin.login');

Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroyWeb'])
    ->middleware('auth')
    ->name('admin.logout');

// Rute admin dengan middleware 'web' dan 'auth'
Route::middleware(['auth', 'checkrole:admin'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return view('admin.pages.dashboard');
    })->name('admin.dashboard');

    Route::resource('/admin-literature', AdminLiteraturController::class);
    Route::resource('/admin-user', AdminUserController::class);
});

// require __DIR__.'/auth.php';
