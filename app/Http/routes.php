<?php

Route::get('/backend/user/login', ['as' => 'backend.user.login', 'uses' => 'Backend\AccountController@getLogin']);
Route::post('/backend/user/login', ['as' => 'admin.authenticate', 'uses' => 'Backend\AccountController@postLogin']);
Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'middleware' => 'backend'], function () {
    get('/', ['as' => 'backend.dashboard.index', 'uses' => 'DashboardController@getIndex']);

    // Account
    get('/logout', ['as' => 'backend.account.logout', 'uses' => 'AccountController@getLogout']);
    get('/profile', ['as' => 'backend.account.profile', 'uses' => 'AccountController@getProfile']);
    put('/update-profile', ['as' => 'backend.account.update-profile', 'uses' => 'AccountController@updateProfile']);
    put('/change-password', ['as' => 'backend.account.change-password', 'uses' => 'AccountController@changePassword']);
    post('/change-avatar', ['as' => 'backend.account.change-avatar', 'uses' => 'AccountController@changeAvatar']);

    // Users
    Route::group(['prefix' => 'users'], function () {
        get('/', ['as' => 'backend.users.index', 'uses' => 'UserController@index']);
        get('/create', ['as' => 'backend.users.create', 'uses' => 'UserController@create']);
        post('/store', ['as' => 'backend.users.store', 'uses' => 'UserController@store']);
        get('{user}/edit', ['as' => 'backend.users.edit', 'uses' => 'UserController@edit']);
        put('{user}', ['as' => 'backend.users.update', 'uses' => 'UserController@update']);
        get('{user}/delete', ['as' => 'backend.users.delete', 'uses' => 'UserController@delete']);
    });

    //Groups
    Route::group(['prefix' => 'groups'], function () {
        get('/', ['as' => 'backend.groups.index', 'uses' => 'GroupController@index']);
        get('/create', ['as' => 'backend.groups.create', 'uses' => 'GroupController@create']);
        post('/store', ['as' => 'backend.groups.store', 'uses' => 'GroupController@store']);
        get('{group}/edit', ['as' => 'backend.groups.edit', 'uses' => 'GroupController@edit']);
        put('{group}', ['as' => 'backend.groups.update', 'uses' => 'GroupController@update']);
    });

    // Categories
    Route::group(['prefix' => 'categories'], function () {
        get('/', ['as' => 'backend.categories.index', 'uses' => 'CategoryController@index']);
        get('/create', ['as' => 'backend.categories.create', 'uses' => 'CategoryController@create']);
        post('/store', ['as' => 'backend.categories.store', 'uses' => 'CategoryController@store']);
        get('{category}/edit', ['as' => 'backend.categories.edit', 'uses' => 'CategoryController@edit']);
        put('{category}', ['as' => 'backend.categories.update', 'uses' => 'CategoryController@update']);
        get('{category}/delete', ['as' => 'backend.categories.delete', 'uses' => 'CategoryController@delete']);
    });
});

Route::group(['namespace' => 'Frontend', 'prefix' => LANG_PREFIX], function () {
});


