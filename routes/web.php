<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\View;

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

// Route::get('/', function () {
//     return view('index');
// });

// Home Routes
Route::get('/',[HomeController::class, 'index'])->name('home');

// Service Routes
Route::get('/services',[ServiceController::class, 'index'])->name('service.index');
Route::get('/services/{slug}',[ServiceController::class, 'show'])->name('service.single');
Route::get('/reservation',[ServiceController::class, 'reservation'])->name('service.reservation');
Route::get('/conditions',[ServiceController::class, 'condition'])->name('service.condition');

// Contact Routes
Route::get('/contact',[ContactController::class, 'index'])->name('contact.index');

Route::get('/test',function()
	{
		return view('test');
	});

// Admin panel routes 
Route::group(array('prefix' => 'panel','namespace'=>'panel'), function()
{
	Route::get('/',function()
	{
		return view('panel.auth.login');
	});
	Route::get('/login',function()
	{
		return view('panel.auth.login');
	});
	Route::get('/{any}',function()
	{
		return view('panel.dashboard');
	})->where('any','.*');
});

