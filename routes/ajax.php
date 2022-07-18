<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'ajax', 'as' => 'ajax.', 'namespace' => 'Ajax', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('get-street/{area}', 'ManageHouseController@getStreet')->name('manage-house.getStreet');
    Route::get('get-house-type/{area}', 'ManageHouseController@getHouseType')->name('manage-house.getHouseType');
});
