<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    
    Route::get('/users', 'UserController@index');
    Route::get('/profile-edit/{id}','UserController@edit');
    Route::put('/profile-update/{id}','UserController@update');
    Route::get('/salary-add/{id}','SalaryController@create');
    Route::post('/salary-add/{eid}','SalaryController@store');

});



Route::get('/home', 'HomeController@index')->name('home');
