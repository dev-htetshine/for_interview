<?php
use Illuminate\Support\Facades\Route;

Route::post('/v1/login', 'Api\LoginController@authenticate');
Route::post('/v1/password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
Route::post('/v1/password/reset', 'Api\ResetPasswordController@reset');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:web'], function () {
    Route::post('logout', 'Api\LoginController@logout');

    Route::post('create-post', 'Api\PostController@store');
    Route::get('list-post', 'Api\PostController@list');
    Route::post('update-post/{postId}', 'Api\PostController@update');
    Route::get('view-post/{postId}', 'Api\PostController@view');
    Route::post('delete-post/{postId}', 'Api\PostController@destroy');
    Route::post('upload-csv', 'Api\PostController@upload');

    Route::post('create-user', 'Api\UserController@store');
    Route::get('list-user', 'Api\UserController@list');
    Route::post('update-user/{userId}', 'Api\UserController@update');
    Route::get('view-user/{userId}', 'Api\UserController@view');
    Route::post('delete-user/{userId}', 'Api\UserController@destroy');
    Route::post('update-password/{userId}', 'Api\UserController@passwordUpdate');
});
