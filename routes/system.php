<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'system', 'as' => 'system.', 'namespace' => 'System', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // House Type
    Route::delete('house-types/destroy', 'HouseTypeController@massDestroy')->name('house-types.massDestroy');
    Route::post('house-types/parse-csv-import', 'HouseTypeController@parseCsvImport')->name('house-types.parseCsvImport');
    Route::post('house-types/process-csv-import', 'HouseTypeController@processCsvImport')->name('house-types.processCsvImport');
    Route::resource('house-types', 'HouseTypeController');

    // Global Search
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
