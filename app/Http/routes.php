<?php
/*
|--------------------------------------------------------------------------
| User routes
|--------------------------------------------------------------------------
|
*/
Route::group(['middleware' => 'guest'], function () {
    get('/login', 'GithubAuthController@login');
    get('/github/authenticate', 'GithubAuthController@authorise');
});

Route::group(['middleware' => 'auth'], function () {
    get('/', 'DashboardController@index');
    get('/logout', 'DashboardController@logout');
});

/*
|--------------------------------------------------------------------------
| Api routes
|--------------------------------------------------------------------------
|
|1. Authenticate using github.
*/

Route::group(['prefix' => 'api', 'middleware' => 'guest'], function () {
    get('/authenticated/user', 'GithubAuthController@getAuthenticatedUserWithToken');
});