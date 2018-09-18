<?php

/* Admin */
Route::group(['middleware' => 'web', 'prefix' => 'o4k/neighborhood', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
		Route::get('/', 'AdminNeighborhoodController@index');
		Route::get('/AdminNeighborhoodList',['uses' => 'AdminNeighborhoodController@allneighbors']);
		Route::get('/create', 'AdminNeighborhoodController@create');
		Route::post('/store', 'AdminNeighborhoodController@store');

		Route::get('/edit/{id}', 'AdminNeighborhoodController@edit');
		Route::post('/update/{id}', 'AdminNeighborhoodController@update');
		Route::get('/destroy/{id}', 'AdminNeighborhoodController@destroy');
		Route::get('/activate/{id}', 'AdminNeighborhoodController@activate');
		Route::get('/deactivate/{id}', 'AdminNeighborhoodController@deactivate');
	});
	 
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/amenities', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
		Route::get('/', 'AdminAmenitiesController@index');
		Route::get('/AdminAmenitiesList',['uses' => 'AdminAmenitiesController@allamenities']);
		Route::get('/create', 'AdminAmenitiesController@create');
		Route::post('/store', 'AdminAmenitiesController@store');

		Route::get('/edit/{id}', 'AdminAmenitiesController@edit');
		Route::post('/update/{id}', 'AdminAmenitiesController@update');
		Route::get('/destroy/{id}', 'AdminAmenitiesController@destroy');
		Route::get('/activate/{id}', 'AdminAmenitiesController@activate');
		Route::get('/deactivate/{id}', 'AdminAmenitiesController@deactivate');
	});
	 
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/property_types', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{

		Route::get('/', 'AdminPropertytypesController@index');
		Route::get('/AdminpropertytypeList',['uses' => 'AdminPropertytypesController@allpropertytypes']);
		Route::get('/create', 'AdminPropertytypesController@create');
		Route::post('/store', 'AdminPropertytypesController@store');

		Route::get('/edit/{id}', 'AdminPropertytypesController@edit');
		Route::post('/update/{id}', 'AdminPropertytypesController@update');
		Route::get('/destroy/{id}', 'AdminPropertytypesController@destroy');
		Route::get('/activate/{id}', 'AdminPropertytypesController@activate');
		Route::get('/deactivate/{id}', 'AdminPropertytypesController@deactivate');
		
	});
	 
});



Route::group(['middleware' => 'web', 'prefix' => 'o4k/property_category', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
		Route::get('/', 'AdminPropertyCategoryController@index');
		Route::get('/AdminPropertyCategoryList',['uses' => 'AdminPropertyCategoryController@allpropertycategories']);
		Route::get('/create', 'AdminPropertyCategoryController@create');
		Route::post('/store', 'AdminPropertyCategoryController@store');

		Route::get('/edit/{id}', 'AdminPropertyCategoryController@edit');
		Route::post('/update/{id}', 'AdminPropertyCategoryController@update');
		Route::get('/destroy/{id}', 'AdminPropertyCategoryController@destroy');
		Route::get('/activate/{id}', 'AdminPropertyCategoryController@activate');
		Route::get('/deactivate/{id}', 'AdminPropertyCategoryController@deactivate');
		
	});
	 
});

Route::group(['middleware' => 'web', 'prefix' => 'o4k/building_unit', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
		Route::get('/', 'AdminBuildingunitsController@index');
		Route::get('/AdminBuildingUnitList',['uses' => 'AdminBuildingunitsController@allbuildingunits']);
		Route::get('/create', 'AdminBuildingunitsController@create');
		Route::post('/store', 'AdminBuildingunitsController@store');

		Route::get('/edit/{id}', 'AdminBuildingunitsController@edit');
		Route::post('/update/{id}', 'AdminBuildingunitsController@update');
		Route::get('/destroy/{id}', 'AdminBuildingunitsController@destroy');
		Route::get('/activate/{id}', 'AdminBuildingunitsController@activate');
		Route::get('/deactivate/{id}', 'AdminBuildingunitsController@deactivate');
		
	});
	 
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/land_unit', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
		Route::get('/', 'AdminLandUnitController@index');
		Route::get('/AdminLandUnitList',['uses' => 'AdminLandUnitController@alllandunits']);
		Route::get('/create', 'AdminLandUnitController@create');
		Route::post('/store', 'AdminLandUnitController@store');

		Route::get('/edit/{id}', 'AdminLandUnitController@edit');
		Route::post('/update/{id}', 'AdminLandUnitController@update');
		Route::get('/destroy/{id}', 'AdminLandUnitController@destroy');
		Route::get('/activate/{id}', 'AdminLandUnitController@activate');
		Route::get('/deactivate/{id}', 'AdminLandUnitController@deactivate');
		
	});
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/property_list', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{

		Route::get('/', 'PropertyListController@index');
		Route::get('/UserpropertyList',['uses' => 'PropertyListController@allpropertylists']);
		Route::get('/create', 'PropertyListController@create');
		Route::post('/store', 'PropertyListController@store');

		Route::get('/edit/{id}', 'PropertyListController@edit');
		Route::post('/update/{id}', 'PropertyListController@update');
		Route::get('/destroy/{id}', 'PropertyListController@destroy');
		Route::get('/activate/{id}', 'PropertyListController@activate');
		Route::get('/deactivate/{id}', 'PropertyListController@deactivate');

		Route::get('/getlanguage/{id}', 'PropertyListController@getlanguage');
		
	});
	 
});


/******************************************************************************************************/
// routes form Slider Property
Route::group(['middleware' => 'web', 'prefix' => 'o4k/sliderproperties', 'namespace' => 'Modules\Properties\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{

		Route::get('/', 'AdminSliderController@index');
		Route::get('/propertylist',['uses' => 'AdminSliderController@allpropertylists']);
		Route::get('/create', 'AdminSliderController@create');
		Route::post('/store', 'AdminSliderController@store');
		Route::get('/edit/{id}', 'AdminSliderController@edit');
		Route::post('/update/{id}', 'AdminSliderController@update');
		Route::get('/destroy/{id}', 'AdminSliderController@destroy');
		Route::get('/getproperty/{id}', 'AdminSliderController@getproperty');
		Route::get('/getrow/{page}', 'AdminSliderController@getrow');
		

		
	});
	 
});
