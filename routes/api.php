<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CashController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1'], function() {
    Route::group([
        'prefix' => 'clients',
        'as' => 'clients.',
    ], function() {
        Route::get('', [ClientController::class, 'listClients']);
        Route::post('store', [ClientController::class, 'store']);
        Route::put('update/{client}', [ClientController::class, 'update']);
        Route::delete('delete/{client}', [ClientController::class, 'destroy']);
    });

    Route::group([
        'prefix' => 'cash',
        'as' => 'cash.',
    ], function() {
        Route::get('', [CashController::class, 'getList']);
        Route::post('', [CashController::class, 'store']);
        Route::put('update/{cash}', [CashController::class, 'update']);
        Route::get('{cash}', [CashController::class, 'showClient']);
        Route::get('showHistory/{cash}', [CashController::class, 'showHistory']);
    });
});
