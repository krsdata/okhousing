<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/permissions', 'namespace' => 'Modules\Permissions\Http\Controllers'], function()
{
    
    /* logged users opertaions */
	Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
		Route::get('/', 'AdminPermissionController@index');
		Route::get('/AdminPermissionsList',['uses' => 'AdminPermissionController@allPermissions']);
		Route::get('/create', 'AdminPermissionController@create');
		Route::post('/store', 'AdminPermissionController@store');
		Route::get('/view', 'AdminPermissionController@view');
		Route::get('/edit/{id}', 'AdminPermissionController@edit');
    
		Route::post('/store', 'AdminPermissionController@store');
    	Route::post('/update/{id}', 'AdminPermissionController@update');
		Route::get('/destroy/{id}', 'AdminPermissionController@destroy');
	});
	
});
