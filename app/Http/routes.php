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
    /*
     * Dashboard Routes
     */
    get('/', 'DashboardController@index');
    /*
     * Project Routes
     */
    get('/all/projects', 'ProjectController@index');
    get('/create/project', 'ProjectController@create');
    post('/store/project', 'ProjectController@store');
    get('/edit/project/{project}', 'ProjectController@edit');
    post('/update/project/{project}', 'ProjectController@update');
    get('/delete/project/{project}', 'ProjectController@destroy');

    /*
     * Task Routes
     */
    get('/all/tasks', 'TaskController@index');
    get('/create/task', 'TaskController@create');
    post('/store/task', 'TaskController@store');

    /*
     * Logout Route
     */
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