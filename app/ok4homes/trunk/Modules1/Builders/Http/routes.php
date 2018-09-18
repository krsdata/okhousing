<?php

Route::group(['middleware' => 'web', 'prefix' => 'builders', 'namespace' => 'Modules\Builders\Http\Controllers'], function()
{
    Route::get('/', 'BuildersController@index');
});
