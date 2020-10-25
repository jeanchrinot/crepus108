<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ServicesubcategoryController;
use App\Http\Controllers\Api\ServicecategoryController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\ConditionController;

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

    // Get Active Reservations
    Route::get('/reservation', [ContactController::class,'getRS']); 

    // Route for newsletter
    Route::post('/newsletter', [ContactController::class,'newsletter']); 
});

Route::group([
    'prefix' => 'auth','namespace'=>'Api'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user']);
    });
});

Route::group([
    'prefix' => 'panel','namespace'=>'Api'
], function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        // AuthController
        Route::get('logout', [AuthController::class,'logout']);
        Route::get('user', [AuthController::class,'user']);

        // UserController
        Route::get('user/current', [UserController::class,'currentUser']);

        // Contact Message Controller
        Route::get('message',[MessageController::class,'getMessages']);
        Route::delete('message/{id}',[MessageController::class,'destroy']);
        Route::put('message/viewed/{id}',[MessageController::class,'viewed']);

        // Reservation Controller 
        Route::get('reservation',[ReservationController::class,'getItems']);
        Route::delete('reservation/{id}',[ReservationController::class,'destroy']);
        Route::put('reservation/status/{id}/{status}',[ReservationController::class,'updateStatus']);

        // Service Controller
        Route::get('service',[ServiceController::class,'getItems']);
        Route::get('service/all',[ServiceController::class,'getAllItems']);
        Route::post('service',[ServiceController::class,'store']);
        Route::put('service/{id}',[ServiceController::class,'update']);

        Route::get('service/subcategory',[ServicesubcategoryController::class,'getItems']);
        Route::get('service/subcategory/all',[ServicesubcategoryController::class,'getAllItems']);
        Route::delete('service/subcategory/{id}',[ServicesubcategoryController::class,'destroy']);
        Route::post('service/subcategory',[ServicesubcategoryController::class,'store']);
        Route::put('service/subcategory/{id}',[ServicesubcategoryController::class,'update']);

        Route::get('service/category',[ServicecategoryController::class,'getItems']);
        Route::get('service/category/all',[ServicecategoryController::class,'getAllItems']);
        Route::delete('service/category/{id}',[ServicecategoryController::class,'destroy']);
        Route::post('service/category',[ServicecategoryController::class,'store']);
        Route::put('service/category/{id}',[ServicecategoryController::class,'update']);

        Route::delete('service/{id}',[ServiceController::class,'destroy']);

        // Slider Controller
        Route::get('slider',[SliderController::class,'getItems']);
        Route::delete('slider/{id}',[SliderController::class,'destroy']);
        Route::post('slider',[SliderController::class,'store']);
        Route::put('slider/{id}',[SliderController::class,'update']);

        // Testimonial Controller
        Route::get('testimonial',[TestimonialController::class,'getItems']);
        Route::delete('testimonial/{id}',[TestimonialController::class,'destroy']);
        Route::post('testimonial',[TestimonialController::class,'store']);
        Route::put('testimonial/{id}',[TestimonialController::class,'update']);

        // Brand Controller
        Route::get('brand',[BrandController::class,'getItems']);
        Route::delete('brand/{id}',[BrandController::class,'destroy']);
        Route::post('brand',[BrandController::class,'store']);
        Route::put('brand/{id}',[BrandController::class,'update']);

        // Contact Controller
        Route::get('contact',[App\Http\Controllers\Api\ContactController::class,'getItems']);
        Route::delete('contact/{id}',[App\Http\Controllers\Api\ContactController::class,'destroy']);
        Route::post('contact',[App\Http\Controllers\Api\ContactController::class,'store']);
        Route::put('contact/{id}',[App\Http\Controllers\Api\ContactController::class,'update']);

        // Social Controller
        Route::get('social',[SocialController::class,'getItems']);
        Route::delete('social/{id}',[SocialController::class,'destroy']);
        Route::post('social',[SocialController::class,'store']);
        Route::put('social/{id}',[SocialController::class,'update']);

        // Condition Controller
        Route::get('condition',[ConditionController::class,'getItems']);
        Route::delete('condition/{id}',[SocialController::class,'destroy']);
        Route::post('condition',[ConditionController::class,'store']);
        Route::put('condition/{id}',[ConditionController::class,'update']);
        
    });
});