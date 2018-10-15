<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
    /* logged users opertaions */
	Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
		Route::get('/', 'UsersController@index');
		Route::get('/AdminUsersList',['uses' => 'UsersController@allUsers']);
		Route::get('/create', 'UsersController@create');
		Route::post('/store', 'UsersController@store');
		Route::get('/getform/{slug}', 'UsersController@getform');
		Route::get('/geteditform/{slug}/{id}', 'UsersController@geteditform');
		Route::get('/getuniquecode/{uniquecode}', 'UsersController@getuniquecode');

		Route::get('/edit/{id}', 'UsersController@edit');
		Route::post('/update/{id}', 'UsersController@update');
		Route::get('/destroy/{id}', 'UsersController@destroy');
		Route::get('/activate/{id}', 'UsersController@activate');
		Route::get('/deactivate/{id}', 'UsersController@deactivate');
	});

}); 

Route::group(['middleware' => 'web', 'prefix' => 'users', 'namespace' => 'Modules\Users\Http\Controllers'], function()
{
        Route::post('/genaral-information', 'FrontUsersController@validate_general');
        Route::post('/user-categories', 'FrontUsersController@validate_categories');
        Route::post('/create-users', 'FrontUsersController@create_users');
        Route::post('/update_password', 'FrontUsersController@update_password');
        Route::get('/getlanguage', 'FrontUsersController@getlanguage');
 		 Route::get('/verify/{id}', 'FrontUsersController@verify');
 		
 		Route::group(['middleware' =>  'front_auth:front_user'], function()
        {
		  	Route::get('/getenquirylists', 'FrontUsersController@allenquirylists');
		  	Route::post('/UpdateProfile', 'FrontUsersController@UpdateProfile');
 			Route::post('/UploadProfileImage', 'FrontUsersController@UploadProfileImage');
 			Route::post('/UploadCoverImage', 'FrontUsersController@UploadCoverImage');
		});
 		

 		
//	Route::post('/save-basic', 'FrontUsersController@store_basic');
//	Route::post('/save-category', 'UsersController@store_categories');
//	Route::post('/save-about', 'UsersController@store_about');
//	Route::get('/send-otp/{id}', 'UsersController@send_otp');

});
