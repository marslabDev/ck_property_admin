<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Area
    Route::apiResource('areas', 'AreaApiController');

    // Manage House
    Route::post('manage-houses/media', 'ManageHouseApiController@storeMedia')->name('manage-houses.storeMedia');
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

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Category
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expense
    Route::apiResource('expenses', 'ExpenseApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Payment History
    Route::apiResource('payment-histories', 'PaymentHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Task Status
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tag
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Task
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');

    // Time Work Type
    Route::apiResource('time-work-types', 'TimeWorkTypeApiController');

    // Time Project
    Route::apiResource('time-projects', 'TimeProjectApiController');

    // Time Entry
    Route::apiResource('time-entries', 'TimeEntryApiController');

    // Currency
    Route::apiResource('currencies', 'CurrencyApiController');

    // Transaction Type
    Route::apiResource('transaction-types', 'TransactionTypeApiController');

    // Income Source
    Route::apiResource('income-sources', 'IncomeSourceApiController');

    // Client Status
    Route::apiResource('client-statuses', 'ClientStatusApiController');

    // Project Status
    Route::apiResource('project-statuses', 'ProjectStatusApiController');

    // Client
    Route::apiResource('clients', 'ClientApiController');

    // Project
    Route::post('projects/media', 'ProjectApiController@storeMedia')->name('projects.storeMedia');
    Route::apiResource('projects', 'ProjectApiController');

    // Note
    Route::apiResource('notes', 'NoteApiController');

    // Document
    Route::post('documents/media', 'DocumentApiController@storeMedia')->name('documents.storeMedia');
    Route::apiResource('documents', 'DocumentApiController');

    // Transaction
    Route::apiResource('transactions', 'TransactionApiController', ['except' => ['update', 'destroy']]);

    // House Type
    Route::apiResource('house-types', 'HouseTypeApiController');

    // Manage Price
    Route::apiResource('manage-prices', 'ManagePriceApiController');

    // User Detail
    Route::apiResource('user-details', 'UserDetailApiController');

    // User Card Mgmt
    Route::apiResource('user-card-mgmts', 'UserCardMgmtApiController');

    // Street
    Route::apiResource('streets', 'StreetApiController');

    // Payment Plan
    Route::apiResource('payment-plans', 'PaymentPlanApiController');

    // Home Owner Transaction
    Route::apiResource('home-owner-transactions', 'HomeOwnerTransactionApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Payment Item
    Route::apiResource('payment-items', 'PaymentItemApiController');

    // Payment Charge
    Route::apiResource('payment-charges', 'PaymentChargeApiController');

    // House Status
    Route::apiResource('house-statuses', 'HouseStatusApiController');

    // Open Project
    Route::post('open-projects/media', 'OpenProjectApiController@storeMedia')->name('open-projects.storeMedia');
    Route::apiResource('open-projects', 'OpenProjectApiController');

    // Supplier Proposal
    Route::post('supplier-proposals/media', 'SupplierProposalApiController@storeMedia')->name('supplier-proposals.storeMedia');
    Route::apiResource('supplier-proposals', 'SupplierProposalApiController');

    // Complaint
    Route::post('complaints/media', 'ComplaintApiController@storeMedia')->name('complaints.storeMedia');
    Route::apiResource('complaints', 'ComplaintApiController');

    // Complaint Status
    Route::apiResource('complaint-statuses', 'ComplaintStatusApiController');

    // Case Status
    Route::apiResource('case-statuses', 'CaseStatusApiController');
});
