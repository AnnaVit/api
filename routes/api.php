<?php

use App\Http\Controllers\GetRequests;
use App\Http\Controllers\PutResponseToRequest;
use App\Http\Controllers\SendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function()
{
    /**
     *получение заявок ответственным лицом, с фильтрацией по статусу
     */

    Route::get('/requests', [GetRequests::class, 'getRequests'])
        ->name('getRequests');

    /**
     *ответ на конкретную задачу ответственным лицом
     */

    Route::put('/requests/{id}', [PutResponseToRequest::class, 'putResponseToRequest'])
        ->name('putResponseToRequest');

    /**
     *отправка заявки пользователями системы
     */

    Route::post('/requests', [sendRequest::class, 'sendRequest'])
        ->name('sendRequest');
});
