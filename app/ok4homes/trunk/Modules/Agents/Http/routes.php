<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k/agents', 'namespace' => 'Modules\Agents\Http\Controllers'], function()
{
      /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
        Route::get('/', 'AdminAgentsController@index');
        Route::get('/AdminAgentsList', 'AdminAgentsController@allAgentsList');
        Route::get('/create', 'AdminAgentsController@create');
        Route::post('/store', 'AdminAgentsController@store');
		Route::get('/edit/{id}', 'AdminAgentsController@edit');
		Route::post('/update/{id}', 'AdminAgentsController@update');
		Route::get('/destroy/{id}', 'AdminAgentsController@destroy');

        Route::get('/activate/{id}', 'AdminAgentsController@activate');
        Route::get('/deactivate/{id}', 'AdminAgentsController@deactivate');

        Route::get('/getlanguage/{id}', 'AdminAgentsController@getlanguage');
        Route::get('/getName/{countryid?}/{userId?}', 'AdminAgentsController@getName');
    });

    });
	

Route::group(['middleware' => 'web', 'prefix' => '', 'namespace' => 'Modules\Agents\Http\Controllers'], function()
{
   Route::get('/{countryCode?}/{langCode?}/agents', 'FrontAgentController@searchAgent');
});




/******************************************************************************************************/
// routes form Slider Property
Route::group(['middleware' => 'web', 'prefix' => 'o4k/slideragents', 'namespace' => 'Modules\Agents\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminSliderController@utility');
        Route::get('/slideragents',['uses' => 'AdminSliderController@allagentslists']);
        Route::get('/create', 'AdminSliderController@create');
        Route::post('/store', 'AdminSliderController@store');
        Route::get('/edit/{id}', 'AdminSliderController@edit');
        Route::post('/update/{id}', 'AdminSliderController@update');
        Route::get('/destroy/{id}', 'AdminSliderController@destroy');
    });
     
});
