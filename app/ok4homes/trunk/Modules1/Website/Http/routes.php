<?php

Route::group(['middleware' => 'web', 'prefix' => 'website', 'namespace' => 'Modules\Website\Http\Controllers'], function()
{
//    Route::get('/', 'WebsiteController@index');
});


Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Website\Http\Controllers'], function()
{  
    Route::get('/', 'WebsiteController@index');
    Route::get('/login', 'FrontUserLoginController@index');
    Route::post('/post_login', 'FrontUserLoginController@post_login');
    Route::post('/ResendOTP', 'FrontUserLoginController@ResendOTP');
    Route::get('/logout', 'FrontUserLoginController@logout');
    Route::post('/CheckLogin', 'FrontUserLoginController@CheckLogin');
    Route::get('/404', 'FrontUserLoginController@not_found');
    Route::get('/country', 'WebsiteController@get_country');
    Route::get('/language/{langslug?}', 'WebsiteController@get_language');
    Route::get('/change_country/{slug?}/{is_home?}', 'WebsiteController@change_country');
    Route::get('/change_language/{slug?}/{is_home?}', 'WebsiteController@change_language'); 
    
    Route::get('/slider', 'WebsiteController@fetchSliderData');
    Route::get('/sliderbackground', 'WebsiteController@sliderbackground');

    Route::post('/forgotpass', 'FrontUserLoginController@forgotpass');
    
    Route::get('/resetpassword/{token}', 'FrontUserLoginController@resetpassword');

    /* logged users opertaions */
	Route::group(['middleware' =>  'front_auth:front_user'], function()
        {
		  Route::get('/dashboard', 'FrontUserLoginController@dashboard');
	});

});

/* Front-End Property */
Route::group(['middleware' => 'web', 'prefix' => 'property', 'namespace' => 'Modules\Website\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'front_auth:front_user'], function()
    {
        Route::get('/post', 'FrontPropertyController@view_post');
        Route::post('/post/add', 'FrontPropertyController@add_post');
    });
});
