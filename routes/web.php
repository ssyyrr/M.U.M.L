<?php


Route::get('/', function () {
    return view('welcome');
});



//sécuriser vos routes pour autoriser uniquement les utilisateurs vérifiés, utilisez le Middleware verified :
//Route::get('profile', function () {
//    // Seuls les utilisateurs vérifiés peuvent entrer ...
//})->middleware('verified');

//            Route::get('auth/confirm/{token}', 'Auth\AuthController@getConfirm');

//Auth::routes();
//Auth::routes(['verify' => true]);

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');


//Activer la vérification des e-mails
Auth::routes(['verify' => true]);


Route::get('/ajax-etab', 'Auth\RegisterController@ajaxetab')->name('ajaxetab');


// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');








Route::get('/home', 'HomeController@index')->name('home');
Route::get('invoice', function(){
    return view('invoice');
});

Route::get('{anypath}',"HomeController@index")->where( 'path', '([A-z\d-\/_.]+)?' );

//Route::controller('universite', 'UniversiteController');
