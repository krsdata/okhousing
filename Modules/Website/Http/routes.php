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
     Route::get('/500', 'FrontUserLoginController@notfound');
    Route::get('/country', 'WebsiteController@get_country');
    Route::get('/language/{langslug?}', 'WebsiteController@get_language');
    Route::get('/change_country/{slug?}/{is_home?}', 'WebsiteController@change_country');
    Route::get('/change_language/{slug?}/{is_home?}', 'WebsiteController@change_language'); 
    
    Route::get('/slider', 'WebsiteController@fetchSliderData');
    Route::get('/sliderbackground', 'WebsiteController@sliderbackground');

    Route::get('/not-avilabile', 'WebsiteController@notAvilabile');

    Route::post('/updatepassword', 'FrontUserLoginController@updatepassword');
   
    Route::post('/forgotpass', 'FrontUserLoginController@forgotpass');
    
    Route::get('/resetpassword/{token}', 'FrontUserLoginController@resetpassword');

    Route::get('/featuredProperty/{id}', 'WebsiteController@featuredProperty');
    
    /* logged users opertaions */
	Route::group(['middleware' =>  'front_auth:front_user'], function()
        {
		  Route::get('/dashboard', 'FrontUserLoginController@dashboard');
	});
     Route::post('/post_advertise', 'FrontUserLoginController@post_advertise');
     
     Route::post('/post_enquiry', 'FrontUserLoginController@post_enquiry');
     
});

/* Front-End Property */
Route::group(['middleware' => 'web', 'prefix' => 'property', 'namespace' => 'Modules\Website\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'front_auth:front_user'], function()
    {
        Route::get('/Add', 'FrontPropertyController@index');
        Route::post('/post/add', 'FrontPropertyController@add_post');

        Route::post('/post/update/{id}', 'FrontPropertyController@update');

        Route::get('/Delete/{id}', 'FrontPropertyController@destroy');
        Route::get('/DeleteImage/{id}', 'FrontPropertyController@DeleteImage');
        Route::get('/Edit/{id}', 'FrontPropertyController@Edit');

        Route::get('/PropertyPagination/{page}', 'FrontPropertyController@PropertyPagination');
        Route::get('/FavoritesPagination/{page}', 'FrontPropertyController@FavoritesPagination');

         Route::post('/selectcategory', 'FrontPropertyController@selectcategory');



    });
});


/* Front-End search */
Route::group(['middleware' => 'web', 'prefix' => 'search', 'namespace' => 'Modules\Website\Http\Controllers'], function()
{
    Route::get('/', 'FrontSearchController@index');
    Route::get('/filter', 'FrontSearchController@filter');
    Route::get('/getcategory/{id}', 'FrontSearchController@getcategory');
    Route::get('/ShowProperty/{id}', 'FrontSearchController@ShowProperty');
    Route::get('/searchFunByuniqueID/{id}', 'FrontSearchController@searchFunByuniqueID');
    Route::post('/AddTowishlist', 'FrontSearchController@AddTowishlist');
    Route::get('/property/{id}', 'FrontSearchController@property');

     Route::post('/filterPagination', 'FrontSearchController@filterPagination');
     
});
