<?php



Route::group(['middleware' => 'web', 'prefix' => 'o4k/owners', 'namespace' => 'Modules\Owners\Http\Controllers'], function()
{
      /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {
        Route::get('/', 'AdminOwnersController@index');
        Route::get('/AdminOwnerList', 'AdminOwnersController@allOwnerList');
        Route::get('/create', 'AdminOwnersController@create');
        Route::post('/store', 'AdminOwnersController@store');
		Route::get('/edit/{id}', 'AdminOwnersController@edit');
		Route::post('/update/{id}', 'AdminOwnersController@update');
		Route::get('/destroy/{id}', 'AdminOwnersController@destroy');

        Route::get('/activate/{id}', 'AdminOwnersController@activate');
        Route::get('/deactivate/{id}', 'AdminOwnersController@deactivate');
		Route::get('/getlanguage/{id}', 'AdminOwnersController@getlanguage');
		Route::get('/getName/{countryid?}/{userId?}', 'AdminOwnersController@getName');
    });

});



/******************************************************************************************************/
// routes form Slider Property
Route::group(['middleware' => 'web', 'prefix' => 'o4k/sliderowners', 'namespace' => 'Modules\Owners\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminSliderController@utility');
        Route::get('/sliderowners',['uses' => 'AdminSliderController@allownerslists']);
        Route::get('/create', 'AdminSliderController@create');
        Route::post('/store', 'AdminSliderController@store');
        Route::get('/edit/{id}', 'AdminSliderController@edit');
        Route::post('/update/{id}', 'AdminSliderController@update');
        Route::get('/destroy/{id}', 'AdminSliderController@destroy');
    });
     
});
