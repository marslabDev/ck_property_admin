<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'core', 'as' => 'core.', 'namespace' => 'Core', 'middleware' => ['auth', '2fa']], function () {
    Route::get('select-portal', 'SelectPortalController@index')->name('select-portal');
    Route::post('select-portal/{role}', 'SelectPortalController@redirect')->name('select-portal.redirect');

    Route::get('select-area', 'SelectAreaController@index')->name('select-area');
    Route::post('select-area/{area}', 'SelectAreaController@redirect')->name('select-area.redirect');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // User Detail
    Route::delete('user-details/destroy', 'UserDetailController@massDestroy')->name('user-details.massDestroy');
    Route::post('user-details/parse-csv-import', 'UserDetailController@parseCsvImport')->name('user-details.parseCsvImport');
    Route::post('user-details/process-csv-import', 'UserDetailController@processCsvImport')->name('user-details.processCsvImport');
    Route::resource('user-details', 'UserDetailController');

    // User Card Mgmt
    Route::delete('user-card-mgmts/destroy', 'UserCardMgmtController@massDestroy')->name('user-card-mgmts.massDestroy');
    Route::post('user-card-mgmts/parse-csv-import', 'UserCardMgmtController@parseCsvImport')->name('user-card-mgmts.parseCsvImport');
    Route::post('user-card-mgmts/process-csv-import', 'UserCardMgmtController@processCsvImport')->name('user-card-mgmts.processCsvImport');
    Route::resource('user-card-mgmts', 'UserCardMgmtController');

    // Area
    Route::delete('areas/destroy', 'AreaController@massDestroy')->name('areas.massDestroy');
    Route::post('areas/parse-csv-import', 'AreaController@parseCsvImport')->name('areas.parseCsvImport');
    Route::post('areas/process-csv-import', 'AreaController@processCsvImport')->name('areas.processCsvImport');
    Route::resource('areas', 'AreaController');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::post('permissions/parse-csv-import', 'PermissionsController@parseCsvImport')->name('permissions.parseCsvImport');
    Route::post('permissions/process-csv-import', 'PermissionsController@processCsvImport')->name('permissions.processCsvImport');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::post('roles/parse-csv-import', 'RolesController@parseCsvImport')->name('roles.parseCsvImport');
    Route::post('roles/process-csv-import', 'RolesController@processCsvImport')->name('roles.processCsvImport');
    Route::resource('roles', 'RolesController');
});
