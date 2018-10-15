<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminLoginController@index');
    Route::get('/login', 'AdminLoginController@index');
    Route::post('/post_login', 'AdminLoginController@post_login');
    Route::get('/logout', 'AdminLoginController@logout');
    Route::get('/CheckLogin', 'AdminLoginController@CheckLogin');
    Route::get('/404', 'AdminLoginController@not_found');

    
    /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function(){
        
       Route::get('/dashboard', 'AdminLoginController@dashboard'); 

       Route::get('/view', 'AdminController@index');   
        Route::get('/create', 'AdminController@create');
        Route::post('/store', 'AdminController@store');
        Route::get('/edit/{id}', 'AdminController@edit');
        Route::post('/update/{id}', 'AdminController@update');
        Route::get('/destroy/{id}', 'AdminController@destroy');
        Route::get('/activate/{id}', 'AdminController@activate');
        Route::get('/deactivate/{id}', 'AdminController@deactivate');
     
        Route::get('/allList', 'AdminController@allList');

        Route::get('/background', 'AdminController@background');

        Route::post('/storebackgroundimg', 'AdminController@storebackgroundimg');

    });
    
});
