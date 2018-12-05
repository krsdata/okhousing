<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/modules', 'namespace' => 'Modules\Module\Http\Controllers'], function()
{

    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
	Route::get('/', 'AdminModuleController@index');
        Route::get('/user', 'AdminModuleController@user_index');
        Route::get('/AdminModulesList',['uses' => 'AdminModuleController@AllAdminModules']); 
        Route::get('/UserModulesList',['uses' => 'AdminModuleController@UserModulesList']); 
       	Route::get('/create', 'AdminModuleController@create');
        Route::get('/user/create', 'AdminModuleController@user_create');
        Route::post('/store', 'AdminModuleController@store');
        Route::post('/user/store', 'AdminModuleController@user_store');
        Route::get('/edit/{id}', 'AdminModuleController@edit');
        Route::get('/user/edit/{id}', 'AdminModuleController@user_edit');
    	Route::post('/update/{id}', 'AdminModuleController@update');
        Route::post('/user/update/{id}', 'AdminModuleController@user_update');
        Route::get('/destroy/{id}', 'AdminModuleController@destroy');
        Route::get('/user/destroy/{id}', 'AdminModuleController@user_destroy');

    });


});

Route::group(['middleware' => 'web', 'prefix' => 'modules', 'namespace' => 'Modules\Module\Http\Controllers'], function()
{
    Route::get('/get_modules', 'ModuleController@get_modules');

  });
