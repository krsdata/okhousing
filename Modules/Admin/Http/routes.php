<?php

Route::group(['middleware' => 'web', 'prefix' => 'o4k', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::get('/', 'AdminLoginController@index');
    Route::get('/login', 'AdminLoginController@index');
    Route::post('/post_login', 'AdminLoginController@post_login');
    Route::get('/logout', 'AdminLoginController@logout');
    Route::get('/CheckLogin', 'AdminLoginController@CheckLogin');
    Route::get('/404', 'AdminLoginController@not_found');

    Route::get('/project/prepareChart', 'ProjectController@prepareChart');



    
    /* logged admin user opertaions */
    Route::group(['middleware' =>  'admin_auth:admin'], function(){



    Route::bind('role', function ($value, $route) {
            return Modules\Roles\Entities\Roles::find($value);
        });


        Route::resource(
            '/role',
            'RoleController',
            [
                'names' => [
                    'edit'    => 'role.edit',
                    'show'    => 'role.show',
                    'destroy' => 'role.destroy',
                    'update'  => 'role.update',
                    'store'   => 'role.store',
                    'index'   => 'role',
                    'create'  => 'role.create',
                ],
            ]
        );



        


        Route::bind('project/neighborhood', function ($value, $route) {
            return Modules\Admin\Entities\Neighborhood::find($value);
        });

        Route::resource(
            '/project/neighborhood',
            'NeighborhoodController',
            [
                'names' => [
                    'edit'    => 'neighborhood.edit',
                    'show'    => 'neighborhood.show',
                    'destroy' => 'neighborhood.destroy',
                    'update'  => 'neighborhood.update',
                    'index'   => 'neighborhood',
                    'create'  => 'neighborhood.create',
                    'store'   => 'neighborhood.store',
                ],
            ]
        );


        Route::bind('project/grade', function ($value, $route) {
            return Modules\Admin\Entities\Grade::find($value);
        });

        Route::resource(
            '/project/grade',
            'GradeController',
            [
                'names' => [
                    'edit'    => 'grade.edit',
                    'show'    => 'grade.show',
                    'destroy' => 'grade.destroy',
                    'update'  => 'grade.update',
                    'index'   => 'grade',
                    'create'  => 'grade.create',
                    'store'   => 'grade.store',
                ],
            ]
        );


        Route::bind('project/area', function ($value, $route) {
            return Modules\Admin\Entities\Area::find($value);
        });

        Route::resource(
            '/project/area',
            'AreaController',
            [
                'names' => [
                    'edit'    => 'area.edit',
                    'show'    => 'area.show',
                    'destroy' => 'area.destroy',
                    'update'  => 'area.update',
                    'index'   => 'area',
                    'create'  => 'area.create',
                    'store'   => 'area.store',
                ],
            ]
        );


        Route::bind('project/status', function ($value, $route) {
            return Modules\Admin\Entities\ProjectStatus::find($value);
        });

        Route::resource(
            '/project/status',
            'StatusController',
            [
                'names' => [
                    'edit'    => 'status.edit',
                    'show'    => 'status.show',
                    'destroy' => 'status.destroy',
                    'update'  => 'status.update',
                    'index'   => 'status',
                    'create'  => 'status.create',
                    'store'   => 'status.store',
                ],
            ]
        );


        Route::bind('project/finishes', function ($value, $route) {
            return Modules\Admin\Entities\Finishes::find($value);
        });

        Route::resource(
            'project/finishes',
            'FinishesController',
            [
                'names' => [
                    'edit'    => 'finishes.edit',
                    'show'    => 'finishes.show',
                    'destroy' => 'finishes.destroy',
                    'update'  => 'finishes.update',
                    'index'   => 'finishes',
                    'create'  => 'finishes.create',
                    'store'   => 'finishes.store',
                ],
            ]
        );


        Route::bind('plan', function ($value, $route) {
            return Modules\Admin\Entities\Plan::find($value);
        });

        Route::resource(
            '/plan',
            'PlanController',
            [
                'names' => [
                    'edit'    => 'plan.edit',
                    'show'    => 'plan.show',
                    'destroy' => 'plan.destroy',
                    'update'  => 'plan.update',
                    'index'   => 'plan',
                    'create'  => 'plan.create',
                    'store'   => 'plan.store',
                ],
            ]
        );


        Route::bind('builder', function ($value, $route) {
            return Modules\Admin\Entities\Builder::find($value);
        });

        Route::resource(
            '/builder',
            'BuilderController',
            [
                'names' => [
                    'edit'    => 'builder.edit',
                    'show'    => 'builder.show',
                    'destroy' => 'builder.destroy',
                    'update'  => 'builder.update',
                    'index'   => 'builder',
                    'create'  => 'builder.create',
                    'store'   => 'builder.store',
                ],
            ]
        );

         Route::bind('project', function ($value, $route) {
            return Modules\Admin\Entities\Project::find($value);
        });

        Route::resource(
            '/project',
            'ProjectController',
            [
                'names' => [
                    'edit'    => 'project.edit',
                    'show'    => 'project.show',
                    'destroy' => 'project.destroy',
                    'update'  => 'project.update',
                    'index'   => 'project',
                    'create'  => 'project.create',
                    'store'   => 'project.store',
                ],
            ]
        ); 
        
        
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
        Route::get('/Advertise', 'AdminController@Adevertise');
        Route::get('/AdevertiseList',['uses' => 'AdminController@AdevertiseList']);

        Route::get('/SearchRadius','AdminController@SearchRadius');
        Route::post('/UpdateSearchRadius', 'AdminController@UpdateSearchRadius');
        
        Route::post('/storebackgroundimg', 'AdminController@storebackgroundimg');

    });
    
});


/******************************************************************************************************/
// routes form menu
Route::group(['middleware' => 'web', 'prefix' => 'o4k/menu', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminMenuController@index');
        Route::get('/menulist',['uses' => 'AdminMenuController@allmenulists']);
        Route::get('/create', 'AdminMenuController@create');
        Route::post('/store', 'AdminMenuController@store');
        Route::get('/edit/{id}', 'AdminMenuController@edit');
        Route::post('/update/{id}', 'AdminMenuController@update');
        Route::get('/destroy/{id}', 'AdminMenuController@destroy');
      
       
    });
     
});

// routes form mobile app
Route::group(['middleware' => 'web', 'prefix' => 'o4k/mobileapp', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminMobileappController@index');
        Route::get('/edit', 'AdminMobileappController@edit');
        Route::post('/update/{id}', 'AdminMobileappController@update');
       
       
    });
     
});


// routes Category Type
Route::group(['middleware' => 'web', 'prefix' => 'o4k/CategoryType', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminCategoryTypeController@index');
        Route::get('/CategoryTypeList',['uses' => 'AdminCategoryTypeController@CategoryTypeList']);
        Route::get('/edit/{id}', 'AdminCategoryTypeController@edit');
        Route::post('/update/{id}', 'AdminCategoryTypeController@update');
        Route::get('/searchlist/{id}', 'AdminCategoryController@searchlist');
  
       
    });
     
});


// routes Category 
Route::group(['middleware' => 'web', 'prefix' => 'o4k/Category', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminCategoryController@index');
        Route::get('/Categorylist',['uses' => 'AdminCategoryController@allCategorylists']);
        Route::get('/create', 'AdminCategoryController@create');
        Route::post('/store', 'AdminCategoryController@store');
        Route::get('/edit/{id}', 'AdminCategoryController@edit');
        Route::post('/update/{id}', 'AdminCategoryController@update');
        Route::get('/destroy/{id}', 'AdminCategoryController@destroy');
       
       
    });
     
});

// routes Featured Category 
Route::group(['middleware' => 'web', 'prefix' => 'o4k/FeaturedCategory', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminFeaturedCategoryController@index');
        Route::get('/FeaturedCategorylist',['uses' => 'AdminFeaturedCategoryController@allFeaturedCategorylists']);
        Route::get('/create', 'AdminFeaturedCategoryController@create');
        Route::post('/store', 'AdminFeaturedCategoryController@store');
        Route::get('/destroy/{id}', 'AdminFeaturedCategoryController@destroy');
        Route::get('/sectionlist', 'AdminFeaturedCategoryController@sectionlist');
        Route::get('/list',['uses' => 'AdminFeaturedCategoryController@allsectionlists']);
        Route::get('/activate/{id}', 'AdminFeaturedCategoryController@activate');
        Route::get('/deactivate/{id}', 'AdminFeaturedCategoryController@deactivate');

    });
     
});

// routes why we 
Route::group(['middleware' => 'web', 'prefix' => 'o4k/whyWe', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminwhyWeController@index');
        Route::get('/whyWeList',['uses' => 'AdminwhyWeController@whyWeList']);
        Route::get('/edit/{id}', 'AdminwhyWeController@edit');
        Route::post('/update/{id}', 'AdminwhyWeController@update');
       
       
    });
     
});



// routes form mobile app
Route::group(['middleware' => 'web', 'prefix' => 'metropoloancity', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminMetropoliancontroller@index');
        Route::get('/create/{id}', 'AdminMetropoliancontroller@create');
        Route::post('/store', 'AdminMetropoliancontroller@store');
        Route::get('/allcitylist',['uses' => 'AdminMetropoliancontroller@allcitylist']);

        Route::get('/edit/{id}', 'AdminMetropoliancontroller@edit');
        Route::post('/update', 'AdminMetropoliancontroller@update');
        Route::get('/destroy/{id}', 'AdminMetropoliancontroller@destroy');
        Route::get('/activate/{id}', 'AdminMetropoliancontroller@activate');
        Route::get('/deactivate/{id}', 'AdminMetropoliancontroller@deactivate');
        Route::post('/checkcity', 'AdminMetropoliancontroller@checkcity');


        
    });
     
});


/******************************************************************************************************/
// routes newsupdate menu
Route::group(['middleware' => 'web', 'prefix' => 'o4k/NewsUpdates', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminNewsUpdatesController@index');
        Route::get('/NewsUpdateslist',['uses' => 'AdminNewsUpdatesController@allNewsUpdateslists']);
        Route::get('/create', 'AdminNewsUpdatesController@create');
        Route::post('/store', 'AdminNewsUpdatesController@store');
        Route::get('/edit/{id}', 'AdminNewsUpdatesController@edit');
        Route::post('/update/{id}', 'AdminNewsUpdatesController@update');
        Route::get('/destroy/{id}', 'AdminNewsUpdatesController@destroy');
      
        Route::get('/getlanguage/{countryid}', 'AdminNewsUpdatesController@getlanguage');
        Route::get('/getlanguage_edit/{countryid}/{parent_id}', 'AdminNewsUpdatesController@getlanguage_edit');

    });
     
});

/******************************************************************************************************/
// routes newsupdate menu
Route::group(['middleware' => 'web', 'prefix' => 'o4k/FeaturedProperties', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    Route::group(['middleware' =>  'admin_auth:admin'], function()
    {

        Route::get('/', 'AdminFeaturedPropertyController@index');
        Route::get('/propertylist',['uses' => 'AdminFeaturedPropertyController@allpropertylists']);
        Route::get('/create', 'AdminFeaturedPropertyController@create');
        Route::post('/store', 'AdminFeaturedPropertyController@store');
        Route::get('/edit/{id}', 'AdminFeaturedPropertyController@edit');
        Route::post('/update/{id}', 'AdminFeaturedPropertyController@update');
         Route::get('/getproperty/{id}', 'AdminFeaturedPropertyController@getproperty');
        Route::get('/destroy/{id}', 'AdminFeaturedPropertyController@destroy');
       Route::post('/Subscription', 'AdminFeaturedPropertyController@Subscription');
       
    });
     
});
