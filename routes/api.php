<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\RoomTypeController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('/login', [userController::class, 'login']);
    Route::post('/register', [userController::class, 'register']);
    Route::post('/logout', [userController::class, 'logout']);
    Route::post('/refresh', [userController::class, 'refresh']);
    Route::get('/user-profile', [userController::class, 'userProfile']);
    Route::post('/change-pass', [userController::class, 'changePassWord']);    
});

Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('/room-types', [RoomTypeController::class, 'addRoomTypes']);
    Route::post('/edit-roomtypes/{id}', [RoomTypeController::class, 'editRoomTypes']);
    Route::get('/delete-roomtypes/{id}', [RoomTypeController::class, 'deleteRoomTypes']);
});


