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

//Route::resource('ajaxproducts',ProductAjaxController::class);
//Route::get('/admin_dashboard', 'Admin\DashboardController@index')->middleware('role:admin');

//Route::resource('company',CompanyController::class);
Route::get('/company', [CompanyController::class, 'index'])->name('company.index')->middleware('role:admin');
Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');



// disable register
Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

