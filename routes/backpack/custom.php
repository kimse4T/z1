<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

use App\Http\Controllers\Admin\PropertyCrudController;

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('contact/ajax-contact', 'ContactCrudController@contact');
    Route::crud('property', 'PropertyCrudController');
    Route::crud('account', 'AccountCrudController');
    Route::crud('contact', 'ContactCrudController');
    Route::get('address/{code?}', 'AddressController@index')->name('address.index');
    Route::post('update/propertylisting','PropertyCrudController@UpdatePropertyListing');
    Route::crud('listing', 'ListingCrudController');
    Route::crud('tasks_activity', 'Tasks_activityCrudController');
}); // this should be the absolute last line of this file