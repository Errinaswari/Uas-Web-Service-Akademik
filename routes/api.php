<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');


Route::group(['middleware' => ['auth:api']], function () {

    Route::apiResource('/mahasiswa', App\Http\Controllers\Api\MahasiswaController::class);
    Route::apiResource('/dosen', App\Http\Controllers\Api\DosenController::class);
    Route::apiResource('/matakuliah', App\Http\Controllers\Api\MatakuliahController::class);
    Route::apiResource('/perkuliahan', App\Http\Controllers\Api\PerkuliahanController::class);

    Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');
});
