<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thehse
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('home');
    
});

//Route::resource('company',CompanyController::class)->middleware('auth');

//Route::get('/company', [CompanyController::class, 'index'])->name('company')->middleware('auth');

Route::view('noaccess','noaccess');

Route::group(['middleware'=>['auth','protectedPage']], function(){
      //Route::view('company','company');
      Route::get('/company', [CompanyController::class, 'index'])->name('company');
});

// disable register
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

