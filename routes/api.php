<?php

use Illuminate\Http\Request;

/*php
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user' => 'API\UserController']);

Route::get('profile', 'API\UserController@profile');
Route::get('findUser', 'API\UserController@search');
Route::put('profile', 'API\UserController@updateProfile');



Route::middleware('auth:api')->get('/universite', function (Request $request) {
    return $request->universite();
});
Route::apiResources(['universite' => 'UniversiteController']);
Route::get('findUniversite', 'UniversiteController@search');




Route::middleware('auth:api')->get('/etablissement', function (Request $request) {
    return $request->etablissement();
});
Route::apiResources(['etablissement' => 'EtablissementController']);
Route::get('findEtablissement', 'EtablissementController@search');
