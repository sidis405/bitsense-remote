<?php

Route::group(['middleware' => ['api']], function () {
    // Route::group(['middleware' => ['api','cors']], function () {
    Route::post('auth/login', 'ApiController@login');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user', 'ApiController@getAuthUser');
        Route::resource('posts', '\App\Http\Controllers\Api\PostsController');
    });
});

// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
