<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/countries', 'namespace' => 'Modules\Countries\Http\Controllers'], function()
{
	
    /* logged users opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
        Route::get('/', 'AdminCountriesController@index');   
        Route::get('/AdminCountriesList',['uses' => 'AdminCountriesController@AllCountries']); 
        Route::get('/create', 'AdminCountriesController@create');
        Route::post('/add', 'AdminCountriesController@store');

        Route::get('/edit/{id}', 'AdminCountriesController@edit');
        Route::post('/update/{id}', 'AdminCountriesController@update');
		
        Route::post('/list_allcountries', 'AdminCountriesController@list_allcountries');
		
		Route::get('/destroy/{id}', 'AdminCountriesController@destroy');
    });
});
