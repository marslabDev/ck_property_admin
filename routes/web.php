<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
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

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Area
    Route::delete('areas/destroy', 'AreaController@massDestroy')->name('areas.massDestroy');
    Route::post('areas/parse-csv-import', 'AreaController@parseCsvImport')->name('areas.parseCsvImport');
    Route::post('areas/process-csv-import', 'AreaController@processCsvImport')->name('areas.processCsvImport');
    Route::resource('areas', 'AreaController');

    // Manage House
    Route::delete('manage-houses/destroy', 'ManageHouseController@massDestroy')->name('manage-houses.massDestroy');
    Route::post('manage-houses/media', 'ManageHouseController@storeMedia')->name('manage-houses.storeMedia');
    Route::post('manage-houses/ckmedia', 'ManageHouseController@storeCKEditorImages')->name('manage-houses.storeCKEditorImages');
    Route::post('manage-houses/parse-csv-import', 'ManageHouseController@parseCsvImport')->name('manage-houses.parseCsvImport');
    Route::post('manage-houses/process-csv-import', 'ManageHouseController@processCsvImport')->name('manage-houses.processCsvImport');
    Route::resource('manage-houses', 'ManageHouseController');

    // Payment Type
    Route::delete('payment-types/destroy', 'PaymentTypeController@massDestroy')->name('payment-types.massDestroy');
    Route::post('payment-types/parse-csv-import', 'PaymentTypeController@parseCsvImport')->name('payment-types.parseCsvImport');
    Route::post('payment-types/process-csv-import', 'PaymentTypeController@processCsvImport')->name('payment-types.processCsvImport');
    Route::resource('payment-types', 'PaymentTypeController');

    // Parking Lot
    Route::delete('parking-lots/destroy', 'ParkingLotController@massDestroy')->name('parking-lots.massDestroy');
    Route::post('parking-lots/parse-csv-import', 'ParkingLotController@parseCsvImport')->name('parking-lots.parseCsvImport');
    Route::post('parking-lots/process-csv-import', 'ParkingLotController@processCsvImport')->name('parking-lots.processCsvImport');
    Route::resource('parking-lots', 'ParkingLotController');

    // Notices
    Route::delete('notices/destroy', 'NoticesController@massDestroy')->name('notices.massDestroy');
    Route::post('notices/media', 'NoticesController@storeMedia')->name('notices.storeMedia');
    Route::post('notices/ckmedia', 'NoticesController@storeCKEditorImages')->name('notices.storeCKEditorImages');
    Route::post('notices/parse-csv-import', 'NoticesController@parseCsvImport')->name('notices.parseCsvImport');
    Route::post('notices/process-csv-import', 'NoticesController@processCsvImport')->name('notices.processCsvImport');
    Route::resource('notices', 'NoticesController');

    // Article
    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::post('articles/media', 'ArticleController@storeMedia')->name('articles.storeMedia');
    Route::post('articles/ckmedia', 'ArticleController@storeCKEditorImages')->name('articles.storeCKEditorImages');
    Route::post('articles/parse-csv-import', 'ArticleController@parseCsvImport')->name('articles.parseCsvImport');
    Route::post('articles/process-csv-import', 'ArticleController@processCsvImport')->name('articles.processCsvImport');
    Route::resource('articles', 'ArticleController');

    // My Cases
    Route::delete('my-cases/destroy', 'MyCasesController@massDestroy')->name('my-cases.massDestroy');
    Route::post('my-cases/media', 'MyCasesController@storeMedia')->name('my-cases.storeMedia');
    Route::post('my-cases/ckmedia', 'MyCasesController@storeCKEditorImages')->name('my-cases.storeCKEditorImages');
    Route::post('my-cases/parse-csv-import', 'MyCasesController@parseCsvImport')->name('my-cases.parseCsvImport');
    Route::post('my-cases/process-csv-import', 'MyCasesController@processCsvImport')->name('my-cases.processCsvImport');
    Route::resource('my-cases', 'MyCasesController');

    // Cases Category
    Route::delete('cases-categories/destroy', 'CasesCategoryController@massDestroy')->name('cases-categories.massDestroy');
    Route::post('cases-categories/parse-csv-import', 'CasesCategoryController@parseCsvImport')->name('cases-categories.parseCsvImport');
    Route::post('cases-categories/process-csv-import', 'CasesCategoryController@processCsvImport')->name('cases-categories.processCsvImport');
    Route::resource('cases-categories', 'CasesCategoryController');

    // Maintanance
    Route::delete('maintanances/destroy', 'MaintananceController@massDestroy')->name('maintanances.massDestroy');
    Route::post('maintanances/parse-csv-import', 'MaintananceController@parseCsvImport')->name('maintanances.parseCsvImport');
    Route::post('maintanances/process-csv-import', 'MaintananceController@processCsvImport')->name('maintanances.processCsvImport');
    Route::resource('maintanances', 'MaintananceController');

    // Maintanance Type
    Route::delete('maintanance-types/destroy', 'MaintananceTypeController@massDestroy')->name('maintanance-types.massDestroy');
    Route::post('maintanance-types/parse-csv-import', 'MaintananceTypeController@parseCsvImport')->name('maintanance-types.parseCsvImport');
    Route::post('maintanance-types/process-csv-import', 'MaintananceTypeController@processCsvImport')->name('maintanance-types.processCsvImport');
    Route::resource('maintanance-types', 'MaintananceTypeController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::post('asset-categories/parse-csv-import', 'AssetCategoryController@parseCsvImport')->name('asset-categories.parseCsvImport');
    Route::post('asset-categories/process-csv-import', 'AssetCategoryController@processCsvImport')->name('asset-categories.processCsvImport');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::post('asset-locations/parse-csv-import', 'AssetLocationController@parseCsvImport')->name('asset-locations.parseCsvImport');
    Route::post('asset-locations/process-csv-import', 'AssetLocationController@processCsvImport')->name('asset-locations.processCsvImport');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::post('asset-statuses/parse-csv-import', 'AssetStatusController@parseCsvImport')->name('asset-statuses.parseCsvImport');
    Route::post('asset-statuses/process-csv-import', 'AssetStatusController@processCsvImport')->name('asset-statuses.processCsvImport');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::post('assets/parse-csv-import', 'AssetController@parseCsvImport')->name('assets.parseCsvImport');
    Route::post('assets/process-csv-import', 'AssetController@processCsvImport')->name('assets.processCsvImport');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::post('assets-histories/parse-csv-import', 'AssetsHistoryController@parseCsvImport')->name('assets-histories.parseCsvImport');
    Route::post('assets-histories/process-csv-import', 'AssetsHistoryController@processCsvImport')->name('assets-histories.processCsvImport');
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::post('expense-categories/parse-csv-import', 'ExpenseCategoryController@parseCsvImport')->name('expense-categories.parseCsvImport');
    Route::post('expense-categories/process-csv-import', 'ExpenseCategoryController@processCsvImport')->name('expense-categories.processCsvImport');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::post('income-categories/parse-csv-import', 'IncomeCategoryController@parseCsvImport')->name('income-categories.parseCsvImport');
    Route::post('income-categories/process-csv-import', 'IncomeCategoryController@processCsvImport')->name('income-categories.processCsvImport');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/parse-csv-import', 'ExpenseController@parseCsvImport')->name('expenses.parseCsvImport');
    Route::post('expenses/process-csv-import', 'ExpenseController@processCsvImport')->name('expenses.processCsvImport');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::post('incomes/parse-csv-import', 'IncomeController@parseCsvImport')->name('incomes.parseCsvImport');
    Route::post('incomes/process-csv-import', 'IncomeController@processCsvImport')->name('incomes.processCsvImport');
    Route::resource('incomes', 'IncomeController');

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Payment History
    Route::post('payment-histories/parse-csv-import', 'PaymentHistoryController@parseCsvImport')->name('payment-histories.parseCsvImport');
    Route::post('payment-histories/process-csv-import', 'PaymentHistoryController@processCsvImport')->name('payment-histories.processCsvImport');
    Route::resource('payment-histories', 'PaymentHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::post('task-statuses/parse-csv-import', 'TaskStatusController@parseCsvImport')->name('task-statuses.parseCsvImport');
    Route::post('task-statuses/process-csv-import', 'TaskStatusController@processCsvImport')->name('task-statuses.processCsvImport');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::post('task-tags/parse-csv-import', 'TaskTagController@parseCsvImport')->name('task-tags.parseCsvImport');
    Route::post('task-tags/process-csv-import', 'TaskTagController@processCsvImport')->name('task-tags.processCsvImport');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::post('tasks/parse-csv-import', 'TaskController@parseCsvImport')->name('tasks.parseCsvImport');
    Route::post('tasks/process-csv-import', 'TaskController@processCsvImport')->name('tasks.processCsvImport');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Time Work Type
    Route::delete('time-work-types/destroy', 'TimeWorkTypeController@massDestroy')->name('time-work-types.massDestroy');
    Route::post('time-work-types/parse-csv-import', 'TimeWorkTypeController@parseCsvImport')->name('time-work-types.parseCsvImport');
    Route::post('time-work-types/process-csv-import', 'TimeWorkTypeController@processCsvImport')->name('time-work-types.processCsvImport');
    Route::resource('time-work-types', 'TimeWorkTypeController');

    // Time Project
    Route::delete('time-projects/destroy', 'TimeProjectController@massDestroy')->name('time-projects.massDestroy');
    Route::post('time-projects/parse-csv-import', 'TimeProjectController@parseCsvImport')->name('time-projects.parseCsvImport');
    Route::post('time-projects/process-csv-import', 'TimeProjectController@processCsvImport')->name('time-projects.processCsvImport');
    Route::resource('time-projects', 'TimeProjectController');

    // Time Entry
    Route::delete('time-entries/destroy', 'TimeEntryController@massDestroy')->name('time-entries.massDestroy');
    Route::post('time-entries/parse-csv-import', 'TimeEntryController@parseCsvImport')->name('time-entries.parseCsvImport');
    Route::post('time-entries/process-csv-import', 'TimeEntryController@processCsvImport')->name('time-entries.processCsvImport');
    Route::resource('time-entries', 'TimeEntryController');

    // Time Report
    Route::delete('time-reports/destroy', 'TimeReportController@massDestroy')->name('time-reports.massDestroy');
    Route::resource('time-reports', 'TimeReportController');

    // Currency
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::post('currencies/parse-csv-import', 'CurrencyController@parseCsvImport')->name('currencies.parseCsvImport');
    Route::post('currencies/process-csv-import', 'CurrencyController@processCsvImport')->name('currencies.processCsvImport');
    Route::resource('currencies', 'CurrencyController');

    // Transaction Type
    Route::delete('transaction-types/destroy', 'TransactionTypeController@massDestroy')->name('transaction-types.massDestroy');
    Route::post('transaction-types/parse-csv-import', 'TransactionTypeController@parseCsvImport')->name('transaction-types.parseCsvImport');
    Route::post('transaction-types/process-csv-import', 'TransactionTypeController@processCsvImport')->name('transaction-types.processCsvImport');
    Route::resource('transaction-types', 'TransactionTypeController');

    // Income Source
    Route::delete('income-sources/destroy', 'IncomeSourceController@massDestroy')->name('income-sources.massDestroy');
    Route::post('income-sources/parse-csv-import', 'IncomeSourceController@parseCsvImport')->name('income-sources.parseCsvImport');
    Route::post('income-sources/process-csv-import', 'IncomeSourceController@processCsvImport')->name('income-sources.processCsvImport');
    Route::resource('income-sources', 'IncomeSourceController');

    // Client Status
    Route::delete('client-statuses/destroy', 'ClientStatusController@massDestroy')->name('client-statuses.massDestroy');
    Route::post('client-statuses/parse-csv-import', 'ClientStatusController@parseCsvImport')->name('client-statuses.parseCsvImport');
    Route::post('client-statuses/process-csv-import', 'ClientStatusController@processCsvImport')->name('client-statuses.processCsvImport');
    Route::resource('client-statuses', 'ClientStatusController');

    // Project Status
    Route::delete('project-statuses/destroy', 'ProjectStatusController@massDestroy')->name('project-statuses.massDestroy');
    Route::post('project-statuses/parse-csv-import', 'ProjectStatusController@parseCsvImport')->name('project-statuses.parseCsvImport');
    Route::post('project-statuses/process-csv-import', 'ProjectStatusController@processCsvImport')->name('project-statuses.processCsvImport');
    Route::resource('project-statuses', 'ProjectStatusController');

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/parse-csv-import', 'ClientController@parseCsvImport')->name('clients.parseCsvImport');
    Route::post('clients/process-csv-import', 'ClientController@processCsvImport')->name('clients.processCsvImport');
    Route::resource('clients', 'ClientController');

    // Project
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::post('projects/media', 'ProjectController@storeMedia')->name('projects.storeMedia');
    Route::post('projects/ckmedia', 'ProjectController@storeCKEditorImages')->name('projects.storeCKEditorImages');
    Route::post('projects/parse-csv-import', 'ProjectController@parseCsvImport')->name('projects.parseCsvImport');
    Route::post('projects/process-csv-import', 'ProjectController@processCsvImport')->name('projects.processCsvImport');
    Route::resource('projects', 'ProjectController');

    // Note
    Route::delete('notes/destroy', 'NoteController@massDestroy')->name('notes.massDestroy');
    Route::post('notes/parse-csv-import', 'NoteController@parseCsvImport')->name('notes.parseCsvImport');
    Route::post('notes/process-csv-import', 'NoteController@processCsvImport')->name('notes.processCsvImport');
    Route::resource('notes', 'NoteController');

    // Document
    Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');
    Route::post('documents/ckmedia', 'DocumentController@storeCKEditorImages')->name('documents.storeCKEditorImages');
    Route::post('documents/parse-csv-import', 'DocumentController@parseCsvImport')->name('documents.parseCsvImport');
    Route::post('documents/process-csv-import', 'DocumentController@processCsvImport')->name('documents.processCsvImport');
    Route::resource('documents', 'DocumentController');

    // Transaction
    Route::post('transactions/parse-csv-import', 'TransactionController@parseCsvImport')->name('transactions.parseCsvImport');
    Route::post('transactions/process-csv-import', 'TransactionController@processCsvImport')->name('transactions.processCsvImport');
    Route::resource('transactions', 'TransactionController', ['except' => ['edit', 'update', 'destroy']]);

    // Client Report
    Route::delete('client-reports/destroy', 'ClientReportController@massDestroy')->name('client-reports.massDestroy');
    Route::resource('client-reports', 'ClientReportController');

    // House Type
    Route::delete('house-types/destroy', 'HouseTypeController@massDestroy')->name('house-types.massDestroy');
    Route::post('house-types/parse-csv-import', 'HouseTypeController@parseCsvImport')->name('house-types.parseCsvImport');
    Route::post('house-types/process-csv-import', 'HouseTypeController@processCsvImport')->name('house-types.processCsvImport');
    Route::resource('house-types', 'HouseTypeController');

    // Manage Price
    Route::delete('manage-prices/destroy', 'ManagePriceController@massDestroy')->name('manage-prices.massDestroy');
    Route::post('manage-prices/parse-csv-import', 'ManagePriceController@parseCsvImport')->name('manage-prices.parseCsvImport');
    Route::post('manage-prices/process-csv-import', 'ManagePriceController@processCsvImport')->name('manage-prices.processCsvImport');
    Route::resource('manage-prices', 'ManagePriceController');

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

    // Street
    Route::delete('streets/destroy', 'StreetController@massDestroy')->name('streets.massDestroy');
    Route::post('streets/parse-csv-import', 'StreetController@parseCsvImport')->name('streets.parseCsvImport');
    Route::post('streets/process-csv-import', 'StreetController@processCsvImport')->name('streets.processCsvImport');
    Route::resource('streets', 'StreetController');

    // Payment Plan
    Route::delete('payment-plans/destroy', 'PaymentPlanController@massDestroy')->name('payment-plans.massDestroy');
    Route::post('payment-plans/parse-csv-import', 'PaymentPlanController@parseCsvImport')->name('payment-plans.parseCsvImport');
    Route::post('payment-plans/process-csv-import', 'PaymentPlanController@processCsvImport')->name('payment-plans.processCsvImport');
    Route::resource('payment-plans', 'PaymentPlanController');

    // Home Owner Transaction
    Route::post('home-owner-transactions/parse-csv-import', 'HomeOwnerTransactionController@parseCsvImport')->name('home-owner-transactions.parseCsvImport');
    Route::post('home-owner-transactions/process-csv-import', 'HomeOwnerTransactionController@processCsvImport')->name('home-owner-transactions.processCsvImport');
    Route::resource('home-owner-transactions', 'HomeOwnerTransactionController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Payment Item
    Route::delete('payment-items/destroy', 'PaymentItemController@massDestroy')->name('payment-items.massDestroy');
    Route::post('payment-items/parse-csv-import', 'PaymentItemController@parseCsvImport')->name('payment-items.parseCsvImport');
    Route::post('payment-items/process-csv-import', 'PaymentItemController@processCsvImport')->name('payment-items.processCsvImport');
    Route::resource('payment-items', 'PaymentItemController');

    // Payment Charge
    Route::delete('payment-charges/destroy', 'PaymentChargeController@massDestroy')->name('payment-charges.massDestroy');
    Route::post('payment-charges/parse-csv-import', 'PaymentChargeController@parseCsvImport')->name('payment-charges.parseCsvImport');
    Route::post('payment-charges/process-csv-import', 'PaymentChargeController@processCsvImport')->name('payment-charges.processCsvImport');
    Route::resource('payment-charges', 'PaymentChargeController');

    // House Status
    Route::delete('house-statuses/destroy', 'HouseStatusController@massDestroy')->name('house-statuses.massDestroy');
    Route::post('house-statuses/parse-csv-import', 'HouseStatusController@parseCsvImport')->name('house-statuses.parseCsvImport');
    Route::post('house-statuses/process-csv-import', 'HouseStatusController@processCsvImport')->name('house-statuses.processCsvImport');
    Route::resource('house-statuses', 'HouseStatusController');

    // Open Project
    Route::delete('open-projects/destroy', 'OpenProjectController@massDestroy')->name('open-projects.massDestroy');
    Route::post('open-projects/media', 'OpenProjectController@storeMedia')->name('open-projects.storeMedia');
    Route::post('open-projects/ckmedia', 'OpenProjectController@storeCKEditorImages')->name('open-projects.storeCKEditorImages');
    Route::post('open-projects/parse-csv-import', 'OpenProjectController@parseCsvImport')->name('open-projects.parseCsvImport');
    Route::post('open-projects/process-csv-import', 'OpenProjectController@processCsvImport')->name('open-projects.processCsvImport');
    Route::resource('open-projects', 'OpenProjectController');

    // Supplier Proposal
    Route::delete('supplier-proposals/destroy', 'SupplierProposalController@massDestroy')->name('supplier-proposals.massDestroy');
    Route::post('supplier-proposals/media', 'SupplierProposalController@storeMedia')->name('supplier-proposals.storeMedia');
    Route::post('supplier-proposals/ckmedia', 'SupplierProposalController@storeCKEditorImages')->name('supplier-proposals.storeCKEditorImages');
    Route::post('supplier-proposals/parse-csv-import', 'SupplierProposalController@parseCsvImport')->name('supplier-proposals.parseCsvImport');
    Route::post('supplier-proposals/process-csv-import', 'SupplierProposalController@processCsvImport')->name('supplier-proposals.processCsvImport');
    Route::resource('supplier-proposals', 'SupplierProposalController');

    // Complaint
    Route::delete('complaints/destroy', 'ComplaintController@massDestroy')->name('complaints.massDestroy');
    Route::post('complaints/media', 'ComplaintController@storeMedia')->name('complaints.storeMedia');
    Route::post('complaints/ckmedia', 'ComplaintController@storeCKEditorImages')->name('complaints.storeCKEditorImages');
    Route::post('complaints/parse-csv-import', 'ComplaintController@parseCsvImport')->name('complaints.parseCsvImport');
    Route::post('complaints/process-csv-import', 'ComplaintController@processCsvImport')->name('complaints.processCsvImport');
    Route::resource('complaints', 'ComplaintController');

    // Complaint Status
    Route::delete('complaint-statuses/destroy', 'ComplaintStatusController@massDestroy')->name('complaint-statuses.massDestroy');
    Route::post('complaint-statuses/parse-csv-import', 'ComplaintStatusController@parseCsvImport')->name('complaint-statuses.parseCsvImport');
    Route::post('complaint-statuses/process-csv-import', 'ComplaintStatusController@processCsvImport')->name('complaint-statuses.processCsvImport');
    Route::resource('complaint-statuses', 'ComplaintStatusController');

    // Case Status
    Route::delete('case-statuses/destroy', 'CaseStatusController@massDestroy')->name('case-statuses.massDestroy');
    Route::post('case-statuses/parse-csv-import', 'CaseStatusController@parseCsvImport')->name('case-statuses.parseCsvImport');
    Route::post('case-statuses/process-csv-import', 'CaseStatusController@processCsvImport')->name('case-statuses.processCsvImport');
    Route::resource('case-statuses', 'CaseStatusController');

    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Area
    Route::delete('areas/destroy', 'AreaController@massDestroy')->name('areas.massDestroy');
    Route::resource('areas', 'AreaController');

    // Manage House
    Route::delete('manage-houses/destroy', 'ManageHouseController@massDestroy')->name('manage-houses.massDestroy');
    Route::post('manage-houses/media', 'ManageHouseController@storeMedia')->name('manage-houses.storeMedia');
    Route::post('manage-houses/ckmedia', 'ManageHouseController@storeCKEditorImages')->name('manage-houses.storeCKEditorImages');
    Route::resource('manage-houses', 'ManageHouseController');

    // Payment Type
    Route::delete('payment-types/destroy', 'PaymentTypeController@massDestroy')->name('payment-types.massDestroy');
    Route::resource('payment-types', 'PaymentTypeController');

    // Parking Lot
    Route::delete('parking-lots/destroy', 'ParkingLotController@massDestroy')->name('parking-lots.massDestroy');
    Route::resource('parking-lots', 'ParkingLotController');

    // Notices
    Route::delete('notices/destroy', 'NoticesController@massDestroy')->name('notices.massDestroy');
    Route::post('notices/media', 'NoticesController@storeMedia')->name('notices.storeMedia');
    Route::post('notices/ckmedia', 'NoticesController@storeCKEditorImages')->name('notices.storeCKEditorImages');
    Route::resource('notices', 'NoticesController');

    // Article
    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::post('articles/media', 'ArticleController@storeMedia')->name('articles.storeMedia');
    Route::post('articles/ckmedia', 'ArticleController@storeCKEditorImages')->name('articles.storeCKEditorImages');
    Route::resource('articles', 'ArticleController');

    // My Cases
    Route::delete('my-cases/destroy', 'MyCasesController@massDestroy')->name('my-cases.massDestroy');
    Route::post('my-cases/media', 'MyCasesController@storeMedia')->name('my-cases.storeMedia');
    Route::post('my-cases/ckmedia', 'MyCasesController@storeCKEditorImages')->name('my-cases.storeCKEditorImages');
    Route::resource('my-cases', 'MyCasesController');

    // Cases Category
    Route::delete('cases-categories/destroy', 'CasesCategoryController@massDestroy')->name('cases-categories.massDestroy');
    Route::resource('cases-categories', 'CasesCategoryController');

    // Maintanance
    Route::delete('maintanances/destroy', 'MaintananceController@massDestroy')->name('maintanances.massDestroy');
    Route::resource('maintanances', 'MaintananceController');

    // Maintanance Type
    Route::delete('maintanance-types/destroy', 'MaintananceTypeController@massDestroy')->name('maintanance-types.massDestroy');
    Route::resource('maintanance-types', 'MaintananceTypeController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Category
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Income
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Payment History
    Route::resource('payment-histories', 'PaymentHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Time Work Type
    Route::delete('time-work-types/destroy', 'TimeWorkTypeController@massDestroy')->name('time-work-types.massDestroy');
    Route::resource('time-work-types', 'TimeWorkTypeController');

    // Time Project
    Route::delete('time-projects/destroy', 'TimeProjectController@massDestroy')->name('time-projects.massDestroy');
    Route::resource('time-projects', 'TimeProjectController');

    // Time Entry
    Route::delete('time-entries/destroy', 'TimeEntryController@massDestroy')->name('time-entries.massDestroy');
    Route::resource('time-entries', 'TimeEntryController');

    // Time Report
    Route::delete('time-reports/destroy', 'TimeReportController@massDestroy')->name('time-reports.massDestroy');
    Route::resource('time-reports', 'TimeReportController');

    // Currency
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Transaction Type
    Route::delete('transaction-types/destroy', 'TransactionTypeController@massDestroy')->name('transaction-types.massDestroy');
    Route::resource('transaction-types', 'TransactionTypeController');

    // Income Source
    Route::delete('income-sources/destroy', 'IncomeSourceController@massDestroy')->name('income-sources.massDestroy');
    Route::resource('income-sources', 'IncomeSourceController');

    // Client Status
    Route::delete('client-statuses/destroy', 'ClientStatusController@massDestroy')->name('client-statuses.massDestroy');
    Route::resource('client-statuses', 'ClientStatusController');

    // Project Status
    Route::delete('project-statuses/destroy', 'ProjectStatusController@massDestroy')->name('project-statuses.massDestroy');
    Route::resource('project-statuses', 'ProjectStatusController');

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::resource('clients', 'ClientController');

    // Project
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::post('projects/media', 'ProjectController@storeMedia')->name('projects.storeMedia');
    Route::post('projects/ckmedia', 'ProjectController@storeCKEditorImages')->name('projects.storeCKEditorImages');
    Route::resource('projects', 'ProjectController');

    // Note
    Route::delete('notes/destroy', 'NoteController@massDestroy')->name('notes.massDestroy');
    Route::resource('notes', 'NoteController');

    // Document
    Route::delete('documents/destroy', 'DocumentController@massDestroy')->name('documents.massDestroy');
    Route::post('documents/media', 'DocumentController@storeMedia')->name('documents.storeMedia');
    Route::post('documents/ckmedia', 'DocumentController@storeCKEditorImages')->name('documents.storeCKEditorImages');
    Route::resource('documents', 'DocumentController');

    // Transaction
    Route::resource('transactions', 'TransactionController', ['except' => ['edit', 'update', 'destroy']]);

    // Client Report
    Route::delete('client-reports/destroy', 'ClientReportController@massDestroy')->name('client-reports.massDestroy');
    Route::resource('client-reports', 'ClientReportController');

    // House Type
    Route::delete('house-types/destroy', 'HouseTypeController@massDestroy')->name('house-types.massDestroy');
    Route::resource('house-types', 'HouseTypeController');

    // Manage Price
    Route::delete('manage-prices/destroy', 'ManagePriceController@massDestroy')->name('manage-prices.massDestroy');
    Route::resource('manage-prices', 'ManagePriceController');

    // User Detail
    Route::delete('user-details/destroy', 'UserDetailController@massDestroy')->name('user-details.massDestroy');
    Route::resource('user-details', 'UserDetailController');

    // User Card Mgmt
    Route::delete('user-card-mgmts/destroy', 'UserCardMgmtController@massDestroy')->name('user-card-mgmts.massDestroy');
    Route::resource('user-card-mgmts', 'UserCardMgmtController');

    // Street
    Route::delete('streets/destroy', 'StreetController@massDestroy')->name('streets.massDestroy');
    Route::resource('streets', 'StreetController');

    // Payment Plan
    Route::delete('payment-plans/destroy', 'PaymentPlanController@massDestroy')->name('payment-plans.massDestroy');
    Route::resource('payment-plans', 'PaymentPlanController');

    // Home Owner Transaction
    Route::resource('home-owner-transactions', 'HomeOwnerTransactionController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Payment Item
    Route::delete('payment-items/destroy', 'PaymentItemController@massDestroy')->name('payment-items.massDestroy');
    Route::resource('payment-items', 'PaymentItemController');

    // Payment Charge
    Route::delete('payment-charges/destroy', 'PaymentChargeController@massDestroy')->name('payment-charges.massDestroy');
    Route::resource('payment-charges', 'PaymentChargeController');

    // House Status
    Route::delete('house-statuses/destroy', 'HouseStatusController@massDestroy')->name('house-statuses.massDestroy');
    Route::resource('house-statuses', 'HouseStatusController');

    // Open Project
    Route::delete('open-projects/destroy', 'OpenProjectController@massDestroy')->name('open-projects.massDestroy');
    Route::post('open-projects/media', 'OpenProjectController@storeMedia')->name('open-projects.storeMedia');
    Route::post('open-projects/ckmedia', 'OpenProjectController@storeCKEditorImages')->name('open-projects.storeCKEditorImages');
    Route::resource('open-projects', 'OpenProjectController');

    // Supplier Proposal
    Route::delete('supplier-proposals/destroy', 'SupplierProposalController@massDestroy')->name('supplier-proposals.massDestroy');
    Route::post('supplier-proposals/media', 'SupplierProposalController@storeMedia')->name('supplier-proposals.storeMedia');
    Route::post('supplier-proposals/ckmedia', 'SupplierProposalController@storeCKEditorImages')->name('supplier-proposals.storeCKEditorImages');
    Route::resource('supplier-proposals', 'SupplierProposalController');

    // Complaint
    Route::delete('complaints/destroy', 'ComplaintController@massDestroy')->name('complaints.massDestroy');
    Route::post('complaints/media', 'ComplaintController@storeMedia')->name('complaints.storeMedia');
    Route::post('complaints/ckmedia', 'ComplaintController@storeCKEditorImages')->name('complaints.storeCKEditorImages');
    Route::resource('complaints', 'ComplaintController');

    // Complaint Status
    Route::delete('complaint-statuses/destroy', 'ComplaintStatusController@massDestroy')->name('complaint-statuses.massDestroy');
    Route::resource('complaint-statuses', 'ComplaintStatusController');

    // Case Status
    Route::delete('case-statuses/destroy', 'CaseStatusController@massDestroy')->name('case-statuses.massDestroy');
    Route::resource('case-statuses', 'CaseStatusController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
