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

Auth::routes();

Route::get('/logout', function ()
{
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
