<?php

//posts section
Route::resource('posts', 'PostsController');

Route::get('posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
Route::get('posts/{post}', 'PostsController@edit')->name('posts.show');

// Route::get('auth/bitsense', '\App\Oauth2\Socialite\MSAuthController@redirectToProvider');



// Route::get('auth/custom-api', '\App\Oauth2\Socialite\MSAuthController@handleProviderCallback');


Route::get('/', function () {
    return view('welcome');
});

Route::redirect('mission', 'chi-siamo', 301);

Route::get('mission', function () {
    return redirect()->route('chiSiamo');
});

// Route::get('users/{id?}', 'RouteTestingController@users');
// Route::get('posts/{id?}', function ($id = 9999999999) {
//     return $id;
// });

// Route::get('users/{id?}', function ($id = 9999999999) {
//     return 'numeric id: ' . $id;
// })->where('id', '[0-9]+');

// Route::get('users/{nick?}', function ($nick = 'na') {
//     return 'side effect: ' . $nick;
// })->where('nick', '[A-Za-z]+');

// Route::get('users/{nick?}', function ($nick = 'na') {
//     return 'nickname: ' . $nick;
// })->where('nick', '[a-z]+');

Route::view('nuovo-chi-siamo', 'chi-siamo')->name('chiSiamo');


// Route::name('admin.')
//     ->prefix('admin')
//     ->middleware('auth')
//     ->group(function () {
//         Route::get('componente1', function () {
//             return 'componente 1';
//         })->name('componente1');

//         Route::get('componente2', function () {
//             return 'componente 2';
//         })->name('componente2');

//         Route::get('componente3', function () {
//             return 'componente 3';
//         })->name('componente3');
//     });


Auth::routes();

// Route::get('/test-namespace', '\App\Http\Controllers\RouteTestingController@testNamespace');

// Route::get('lang', '\App\Http\Controllers\RouteTestingController@lang');

// Route::namespace('Admin')->group(function () {
//     Route::get('/admin', 'AdminController@index');
//     Route::get('/admin2', 'AdminController@index');
//     Route::get('/admin3', 'AdminController@index');
// });

Route::get('/home', 'HomeController@index')->name('home');

// Route::domain('{account}.example.com')->group(function () {
//     Route::get('user/{id}', function ($account, $id) {
//         return $id;
//     });
// });

// Route::middleware('throttle: 5,1')->group(function () {
//     Route::get('test', function () {
//         return 'Call went fine';
//     });
// });


// Route::middleware('throttle: rate_limit,1')->group(function () {
//     Route::get('test-dynamic', function () {
//         return 'Dynamic call went fine';
//     });
// });
