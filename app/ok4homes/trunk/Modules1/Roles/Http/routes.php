<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/roles', 'namespace' => 'Modules\Roles\Http\Controllers'], function()
{
    /* logged users opertaions */
	Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
		Route::get('/', 'AdminRolesController@index');
		Route::get('/AdminRolesList',['uses' => 'AdminRolesController@allRoles']);
		Route::get('/create', 'AdminRolesController@create');
		Route::post('/store', 'AdminRolesController@store');
		Route::get('/view', 'AdminRolesController@view');
		Route::get('/edit/{id}', 'AdminRolesController@edit');
    
		Route::post('/store', 'AdminRolesController@store');
        Route::post('/update/{id}', 'AdminRolesController@update');
		Route::get('/destroy/{id}', 'AdminRolesController@destroy');

		Route::get('/getpermissions/{countryId}', 'AdminRolesController@getpermissions');
	});

});
