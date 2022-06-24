<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Area
    Route::apiResource('areas', 'AreaApiController');

    // Manage House
    Route::apiResource('manage-houses', 'ManageHouseApiController');

    // Payment Type
    Route::apiResource('payment-types', 'PaymentTypeApiController');

    // Parking Lot
    Route::apiResource('parking-lots', 'ParkingLotApiController');

    // Notices
    Route::post('notices/media', 'NoticesApiController@storeMedia')->name('notices.storeMedia');
    Route::apiResource('notices', 'NoticesApiController');

    // Article
    Route::post('articles/media', 'ArticleApiController@storeMedia')->name('articles.storeMedia');
    Route::apiResource('articles', 'ArticleApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Service
    Route::post('services/media', 'ServiceApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServiceApiController');

    // My Cases
    Route::post('my-cases/media', 'MyCasesApiController@storeMedia')->name('my-cases.storeMedia');
    Route::apiResource('my-cases', 'MyCasesApiController');

    // Cases Category
    Route::apiResource('cases-categories', 'CasesCategoryApiController');

    // Maintanance
    Route::apiResource('maintanances', 'MaintananceApiController');

    // Maintanance Type
    Route::apiResource('maintanance-types', 'MaintananceTypeApiController');

    // Asset Category
    Route::apiResource('asset-categories', 'AssetCategoryApiController');

    // Asset Location
    Route::apiResource('asset-locations', 'AssetLocationApiController');

    // Asset Status
    Route::apiResource('asset-statuses', 'AssetStatusApiController');

    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Payment History
    Route::apiResource('payment-histories', 'PaymentHistoryApiController');

    // Complaint System
    Route::post('complaint-systems/media', 'ComplaintSystemApiController@storeMedia')->name('complaint-systems.storeMedia');
    Route::apiResource('complaint-systems', 'ComplaintSystemApiController');
});
