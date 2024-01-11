<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', 'App\Http\Controllers\ProductController');
Route::resource('service', 'App\Http\Controllers\ServicesController');
Route::resource('constructor', 'App\Http\Controllers\ConstructorController');

//Route::get('test', 'App\Http\Controllers\TestController@index');



Auth::routes();

Route::get('/logout', function ()
{
    Auth::logout();
    return redirect('/login');
})->name('force-logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'my',
    'as' => 'my.',
    'middleware' => 'auth',
], function () {
    Route::get('/parse/json/{keywords}')->name('parse.json.keywords');
    Route::get('/parse/xml/{keywords}')->name('parse.xml.keywords');

    Route::get('/parse/json/')->name('parse.json');
    Route::get('/parse/xml/')->name('parse.xml');
    Route::view('/parse/products/', 'profile.parse.products')->name('parse.products');
    Route::view('/parse/services/', 'profile.parse.services')->name('parse.services');
    Route::view('/parse/constructor/', 'profile.parse.constructor')->name('parse.constructor');

    Route::view('/plan', 'profile.plan.show')->name('plan');
    Route::get('/plan/upgrade/{plan}', 'App\Http\Controllers\Profile\PlanController@upgrade');

    Route::get('/balance', 'App\Http\Controllers\Profile\BalanceController@show')->name('balance.show');
    Route::get('/balance/edit', 'App\Http\Controllers\Profile\BalanceController@edit')->name('balance.edit');
    Route::patch('/balance', 'App\Http\Controllers\Profile\BalanceController@update')->name('balance.update');

    #ADMIN
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function (){
        Route::get('/', 'App\Http\Controllers\Admin\HomeController@show')->name('admin.index');
        Route::get('/users', 'App\Http\Controllers\Admin\HomeController@users')->name('admin.users');
        Route::get('/notifications', 'App\Http\Controllers\Admin\HomeController@notifications')->name('admin.notifications');
    });
});


