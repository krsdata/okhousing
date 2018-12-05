<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/utility', 'namespace' => 'Modules\Utility\Http\Controllers'], function()
{
      /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
        Route::get('/', 'AdminUtilityController@index');
        Route::get('/AdminUtilityList', 'AdminUtilityController@allUtilityList');
        Route::get('/create', 'AdminUtilityController@create');
        Route::post('/store', 'AdminUtilityController@store');
		Route::get('/edit/{id}', 'AdminUtilityController@edit');
		Route::post('/update/{id}', 'AdminUtilityController@update');
		Route::get('/destroy/{id}', 'AdminUtilityController@destroy');

        Route::get('/activate/{id}', 'AdminUtilityController@activate');
        Route::get('/deactivate/{id}', 'AdminUtilityController@deactivate');

        Route::get('/getlanguage/{id}', 'AdminUtilityController@getlanguage');
        Route::get('/getName/{countryid?}/{userId?}', 'AdminUtilityController@getName');
    });

    });





/******************************************************************************************************/
// routes form Slider Property
Route::group(['middleware' => 'web', 'prefix' => 'o4k/sliderutility', 'namespace' => 'Modules\Utility\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminSliderController@utility');
        Route::get('/utilitylist',['uses' => 'AdminSliderController@allutilitylists']);
        Route::get('/create', 'AdminSliderController@create');
        Route::post('/store', 'AdminSliderController@store');
        Route::get('/edit/{id}', 'AdminSliderController@edit');
        Route::post('/update/{id}', 'AdminSliderController@update');
        Route::get('/destroy/{id}', 'AdminSliderController@destroy');
    });
     
});
