<?php
 
/* Admin */
Route::group(['middleware' => 'web', 'prefix' => 'o4k/projects/area'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
        Route::get('/', 'AdminLandAreaController@index');
		Route::get('/AdminLandAreaList',['uses' => 'AdminLandAreaController@allprojectarea']);
		Route::get('/create', 'AdminLandAreaController@create');
		Route::post('/store', 'AdminLandAreaController@store');

		Route::get('/edit/{id}', 'AdminLandAreaController@edit');
		Route::post('/update/{id}', 'AdminLandAreaController@update');
		Route::get('/destroy/{id}', 'AdminLandAreaController@destroy');
		Route::get('/activate/{id}', 'AdminLandAreaController@activate');
		Route::get('/deactivate/{id}', 'AdminLandAreaController@deactivate');


		Route::get('/getlanguage/{countryid}', 'AdminLandAreaController@getlanguage');
        Route::get('/getlanguage_edit/{countryid}/{parent_id}', 'AdminLandAreaController@getlanguage_edit');





	});
	 
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/projects/amenities'], function()
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


Route::group(['middleware' => 'web', 'prefix' => 'o4k/project_types'], function()
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



Route::group(['middleware' => 'web', 'prefix' => 'o4k/project_category'], function()
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

Route::group(['middleware' => 'web', 'prefix' => 'o4k/projects/building_unit'], function()
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


		Route::get('/getlanguage/{countryid}', 'AdminBuildingunitsController@getlanguage');
        Route::get('/getlanguage_edit/{countryid}/{parent_id}', 'AdminBuildingunitsController@getlanguage_edit');


		
	});
	 
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/projects/land_unit'], function()
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



		Route::get('/getlanguage/{countryid}', 'AdminLandUnitController@getlanguage');
        Route::get('/getlanguage_edit/{countryid}/{parent_id}', 'AdminLandUnitController@getlanguage_edit');


		
	});
});


Route::group(['middleware' => 'web', 'prefix' => 'o4k/project_list', 'namespace' => 'Modules\Projects\Http\Controllers'], function()
{
	Route::group(['middleware' =>  'admin_auth:admin'], function()
	{
		Route::get('/{country}', 'PropertyListController@index');
		//Route::get('/UserpropertyList',['uses' => 'PropertyListController@allpropertylists']);
		Route::get('/create', 'PropertyListController@create');
		Route::post('/store', 'PropertyListController@store');


		Route::get('/UserpropertyList/{country}','PropertyListController@allpropertylists');

		Route::get('/edit/{id}', 'PropertyListController@edit');
		Route::post('/update/{id}', 'PropertyListController@update');
		Route::get('/destroy/{id}', 'PropertyListController@destroy');
		Route::get('/activate/{id}', 'PropertyListController@activate');
		Route::get('/deactivate/{id}', 'PropertyListController@deactivate');
		Route::get('/DeleteImage/{id}', 'PropertyListController@DeleteImage');
		Route::get('/getlanguage/{id}', 'PropertyListController@getlanguage');
		Route::post('/selectcategory', 'PropertyListController@selectcategory');
		
	});
	 
});


/******************************************************************************************************/
// routes form Slider Property
Route::group(['middleware' => 'web', 'prefix' => 'o4k/projects/sliderproperties', 'namespace' => 'Modules\Projects\Http\Controllers'], function()
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



