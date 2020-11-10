<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Properties
    Route::delete('properties/destroy', 'PropertyController@massDestroy')->name('properties.massDestroy');
    Route::post('properties/media', 'PropertyController@storeMedia')->name('properties.storeMedia');
    Route::post('properties/ckmedia', 'PropertyController@storeCKEditorImages')->name('properties.storeCKEditorImages');
    Route::resource('properties', 'PropertyController');

    // Rooms
    Route::delete('rooms/destroy', 'RoomController@massDestroy')->name('rooms.massDestroy');
    Route::post('rooms/media', 'RoomController@storeMedia')->name('rooms.storeMedia');
    Route::post('rooms/ckmedia', 'RoomController@storeCKEditorImages')->name('rooms.storeCKEditorImages');
    Route::resource('rooms', 'RoomController');

    // Transactions
    Route::delete('transactions/destroy', 'TransactionController@massDestroy')->name('transactions.massDestroy');
    Route::post('transactions/media', 'TransactionController@storeMedia')->name('transactions.storeMedia');
    Route::post('transactions/ckmedia', 'TransactionController@storeCKEditorImages')->name('transactions.storeCKEditorImages');
    Route::resource('transactions', 'TransactionController');

    // Banks
    Route::delete('banks/destroy', 'BankController@massDestroy')->name('banks.massDestroy');
    Route::resource('banks', 'BankController');

    // Feedback
    Route::delete('feedback/destroy', 'FeedbackController@massDestroy')->name('feedback.massDestroy');
    Route::post('feedback/media', 'FeedbackController@storeMedia')->name('feedback.storeMedia');
    Route::post('feedback/ckmedia', 'FeedbackController@storeCKEditorImages')->name('feedback.storeCKEditorImages');
    Route::resource('feedback', 'FeedbackController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});