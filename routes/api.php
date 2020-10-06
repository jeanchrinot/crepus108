<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

Route::group([
    'prefix' => 'contact','namespace' => 'Api'
], function () {
    Route::get('test', [ContactController::class,'test']);

    // Route for storing contact messages
    Route::post('/', [ContactController::class,'store']);
    // Route for reservation
    Route::post('/reservation', [ContactController::class,'reservation']); 
    // Route for newsletter
    Route::post('/newsletter', [ContactController::class,'newsletter']); 
});