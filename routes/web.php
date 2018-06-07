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
    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('change-language');

    Route::get('/', 'HomeController@welcome')->name('welcome');
});

Route::group(['middleware' => 'locale', 'auth'], function() {

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('seminar', 'SeminarController');
    Route::post('/seminar/validate/{id}', 'SeminarController@validateCode')->name('seminar.validate');
    Route::group(['middleware' => 'checkChairman'], function() {
        Route::get('/seminar/editor/{id}', 'SeminarController@getEditor')->name('seminar.editor');
        Route::post('/seminar/editor/{id}', 'SeminarController@postEditor');
    });
    Route::get('/seminar/report/preview/{id}', 'SeminarController@previewReport')
            ->name('seminar.preview');
    Route::group(['middleware' => 'checkReport'], function() {
        Route::get('/seminar/report/{id}', 'SeminarController@getReport')
                ->name('seminar.report');
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
    Route::post('/user/change-role/{id}', 'UserController@changeRole');

    Route::post('/create-call', 'CallController@createCall');
    Route::post('/update-call', 'CallController@updateCall');
    Route::get('/call/get', 'CallController@getCall');
    Route::post('/call/finish', 'CallController@finishCall');
    Route::post('/call/publish', 'CallController@publishReport');

    Route::resource('message', 'MessageController')->only(['store']);   

    Route::get('/search', 'HomeController@search')->name('search');

    Route::get('/report', 'HomeController@report')->name('report');
    Route::get('/report/preview/{id}', 'HomeController@previewReport')->name('report.preview');
});

