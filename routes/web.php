<?php

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
Route::group(['middleware' => 'locale'], function() {
    
    Route::get('change-language/{language}', function($language){
        Session::put('website_language', $language);
        return redirect()->back();
    })->name('change-language');

    Route::get('/', function () {
        return view('welcome');
    });
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('seminar', 'SeminarController')->except([
        'create',
        'edit',
    ]);

    Route::get('/mail', 'HomeController@mail');
    Route::resource('user', 'UserController');

    Route::resource('message', 'MessageController');

    Route::get('listen', function () {
        return view('listen');
    });
    
});

