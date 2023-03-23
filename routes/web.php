<?php

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

$controller_path = 'App\Http\Controllers';

// authentication
Route::get('/login-page', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/register-page', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/forgot-password', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

Route::post('/register', $controller_path . '\authentications\RegisterBasic@registerUser');
Route::post('/login', $controller_path . '\authentications\LoginBasic@customLogin');
    


Route::middleware('auth')->group(function() {
    $controller_path = 'App\Http\Controllers';
    Route::get('/logout', $controller_path . '\authentications\LoginBasic@logout')->name('logout');

    // Main Page Route
    Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
    

    //blog
    
    Route::get('/blog-list', $controller_path . '\BlogController@index')->name('blog-list');
    Route::get('/create-blog', $controller_path . '\BlogController@create')->name('create-blog');
    Route::post('/add-blog', $controller_path . '\BlogController@store');
    Route::get('/edit-blog/{key}', $controller_path . '\BlogController@edit');
    Route::post('/update/{key}', $controller_path . '\BlogController@update');
    Route::get('/delete/{key}', $controller_path . '\BlogController@destroy');

    //user profile
    Route::get('/profile', $controller_path . '\dashboard\Analytics@userProfile')->name('profile');;
    
});



