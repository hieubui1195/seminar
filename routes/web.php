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

    Route::resource('seminar', 'SeminarController')->except('destroy');
    Route::post('/seminar/validate/{id}', 'SeminarController@validateCode')->name('seminar.validate');
    Route::group(['middleware' => 'checkChairman'], function() {
        Route::get('/seminar/editor/{id}', 'SeminarController@getEditor');
        Route::post('/seminar/editor/{id}', 'SeminarController@postEditor');
    });
    Route::group(['middleware' => 'checkReport'], function() {
        Route::get('/seminar/report/{id}', 'SeminarController@getReport')
                ->name('seminar.report');
        Route::get('/seminar/report/preview/{id}', 'SeminarController@previewReport')
                ->name('seminar.preview');
        Route::post('/seminar/report/publish/{id}','SeminarController@postReport');
        Route::get('/seminar/report/download/{id}', [
            'uses' => 'SeminarController@downloadReport',
            'as' => 'seminar.download',
            'middleware' => 'checkPublished',
        ]);
    });

    Route::resource('user', 'UserController');
    Route::get('/user/video/{id}', 'UserController@callVideo');
    Route::post('/user/call-noti/{callerId}/{receiverId}', 'UserController@notifyCall');
    Route::get('/notifications', 'UserController@getNotifications')->name('notifications');
    Route::post('/notification/view', 'UserController@changeViewed');
    Route::post('/notification/marked', 'UserController@markedAll');

    Route::post('/create-call', 'CallController@createCall');
    Route::post('/update-call', 'CallController@updateCall');
    Route::post('/call/get', 'CallController@getCall');
    Route::post('/call/publish', 'CallController@publishReport');

    Route::resource('message', 'MessageController');   

    Route::get('/search', 'HomeController@search')->name('search');   
});

