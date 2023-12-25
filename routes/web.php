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

//Route::get('test', 'App\Http\Controllers\TestController@index');



Auth::routes();

Route::get('/logout', function ()
{
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'my',
    'as' => 'my.'
], function () {
    Route::get('/parse/json/{keywords}')->name('parse.json.keywords');
    Route::get('/parse/xml/{keywords}')->name('parse.xml.keywords');

    Route::get('/parse/json/')->name('parse.json');
    Route::get('/parse/xml/')->name('parse.xml');
    Route::view('/parse/products/', 'profile.parse.products')->name('parse.products');

    Route::view('/plan', 'profile.plan.show')->name('plan');

    Route::get('/balance', 'App\Http\Controllers\Profile\BalanceController@show')->name('balance.show');
});
