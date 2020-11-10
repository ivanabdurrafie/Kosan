<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Properties
    Route::post('properties/media', 'PropertyApiController@storeMedia')->name('properties.storeMedia');
    Route::apiResource('properties', 'PropertyApiController');

    // Rooms
    Route::post('rooms/media', 'RoomApiController@storeMedia')->name('rooms.storeMedia');
    Route::apiResource('rooms', 'RoomApiController');

    // Transactions
    Route::post('transactions/media', 'TransactionApiController@storeMedia')->name('transactions.storeMedia');
    Route::apiResource('transactions', 'TransactionApiController');

    // Banks
    Route::apiResource('banks', 'BankApiController');

    // Feedback
    Route::post('feedback/media', 'FeedbackApiController@storeMedia')->name('feedback.storeMedia');
    Route::apiResource('feedback', 'FeedbackApiController');
});