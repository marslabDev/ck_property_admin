<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
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

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Service
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServiceController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServiceController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::post('services/parse-csv-import', 'ServiceController@parseCsvImport')->name('services.parseCsvImport');
    Route::post('services/process-csv-import', 'ServiceController@processCsvImport')->name('services.processCsvImport');
    Route::resource('services', 'ServiceController');

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
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
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

    // Expense Report
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Payment History
    Route::delete('payment-histories/destroy', 'PaymentHistoryController@massDestroy')->name('payment-histories.massDestroy');
    Route::post('payment-histories/parse-csv-import', 'PaymentHistoryController@parseCsvImport')->name('payment-histories.parseCsvImport');
    Route::post('payment-histories/process-csv-import', 'PaymentHistoryController@processCsvImport')->name('payment-histories.processCsvImport');
    Route::resource('payment-histories', 'PaymentHistoryController');

    // Complaint System
    Route::delete('complaint-systems/destroy', 'ComplaintSystemController@massDestroy')->name('complaint-systems.massDestroy');
    Route::post('complaint-systems/media', 'ComplaintSystemController@storeMedia')->name('complaint-systems.storeMedia');
    Route::post('complaint-systems/ckmedia', 'ComplaintSystemController@storeCKEditorImages')->name('complaint-systems.storeCKEditorImages');
    Route::post('complaint-systems/parse-csv-import', 'ComplaintSystemController@parseCsvImport')->name('complaint-systems.parseCsvImport');
    Route::post('complaint-systems/process-csv-import', 'ComplaintSystemController@processCsvImport')->name('complaint-systems.processCsvImport');
    Route::resource('complaint-systems', 'ComplaintSystemController');

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
    Route::delete('transactions/destroy', 'TransactionController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionController');

    // Client Report
    Route::delete('client-reports/destroy', 'ClientReportController@massDestroy')->name('client-reports.massDestroy');
    Route::resource('client-reports', 'ClientReportController');

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

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Service
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::post('services/media', 'ServiceController@storeMedia')->name('services.storeMedia');
    Route::post('services/ckmedia', 'ServiceController@storeCKEditorImages')->name('services.storeCKEditorImages');
    Route::resource('services', 'ServiceController');

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
    Route::delete('payment-histories/destroy', 'PaymentHistoryController@massDestroy')->name('payment-histories.massDestroy');
    Route::resource('payment-histories', 'PaymentHistoryController');

    // Complaint System
    Route::delete('complaint-systems/destroy', 'ComplaintSystemController@massDestroy')->name('complaint-systems.massDestroy');
    Route::post('complaint-systems/media', 'ComplaintSystemController@storeMedia')->name('complaint-systems.storeMedia');
    Route::post('complaint-systems/ckmedia', 'ComplaintSystemController@storeCKEditorImages')->name('complaint-systems.storeCKEditorImages');
    Route::resource('complaint-systems', 'ComplaintSystemController');

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
    Route::delete('transactions/destroy', 'TransactionController@massDestroy')->name('transactions.massDestroy');
    Route::resource('transactions', 'TransactionController');

    // Client Report
    Route::delete('client-reports/destroy', 'ClientReportController@massDestroy')->name('client-reports.massDestroy');
    Route::resource('client-reports', 'ClientReportController');

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
