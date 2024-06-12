<?php

use App\Http\Controllers\Api\Admin\CatatanController as AdminCatatanController;
use App\Http\Controllers\Api\Admin\LiteraturController as AdminLiteraturController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AlokasiController;
use App\Http\Controllers\Api\User\CatatanController;
use App\Http\Controllers\Api\User\LiteraturController;
use App\Http\Controllers\Api\User\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'checkrole:user'])->group(function () {
    Route::get('/profil', [ProfileController::class, 'show']);
    Route::put('/profil', [ProfileController::class, 'updateProfile']);
    Route::put('/profil/password', [ProfileController::class, 'updatePassword']);

    Route::apiResource('/catatan', CatatanController::class);
    Route::apiResource('/alokasi', AlokasiController::class);
    Route::get('/literatur', [LiteraturController::class, 'index']);
});
