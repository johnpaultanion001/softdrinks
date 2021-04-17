<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('loaddashboard', 'DashboardController@loaddashboard')->name('loaddashboard');
    // Invetories
    Route::resource('inventories', 'InventoryController');
    Route::get('loadinventories', 'InventoryController@loadinventories')->name('loadinventories');
    // Categories
    Route::resource('categories', 'CategoryController');
    // Ordering
    Route::get('ordering', 'OrderingController@getproducts')->name('getproducts');
    Route::get('loadproduct',  'OrderingController@loadproduct');
    Route::get('loadcart',  'OrderingController@loadcart');
    Route::get('cartsbutton',  'OrderingController@cartsbutton');
    // search product
    Route::get('search','OrderingController@search')->name('search');
    // check out cart
    Route::get('checkout','OrderingController@checkout')->name('checkout');
    Route::post('checkout-order', 'OrderingController@checkout_order')->name('ordering.checkout_order');
    // add to cart
    Route::post('addtocart/{inventory}',  'OrderingController@addtocart')->name('ordering.addtocart');

    //sales
    Route::get('sales', 'SalesController@index')->name('sales.index');
    Route::get('loadsales', 'SalesController@loadsales')->name('sales.loadsales');
    Route::get('sales-daily', 'SalesController@daily')->name('sales.daily');
    Route::get('sales-monthly', 'SalesController@monthly')->name('sales.monthly');
    Route::get('sales-yearly', 'SalesController@yearly')->name('sales.yearly');
    Route::post('salesfilter', 'SalesController@filter')->name('sales.filter');
    Route::post('/daterange/fetch_data', 'SalesController@fetch_data')->name('daterange.fetch_data');

    //order
    Route::delete('orders/{order}', 'OrderController@destroy')->name('order.destroy');
    Route::get('orders/{order}', 'OrderController@show')->name('order.show');
    Route::post('orders/{order}', 'OrderController@update')->name('order.update');

    //graph
    route::get('graph', 'GraphController@index')->name('graph');
    route::get('graph-daily', 'GraphController@daily')->name('graph.daily');
    route::get('graph-monthly', 'GraphController@monthly')->name('graph.monthly');
    route::get('graph-yearly', 'GraphController@yearly')->name('graph.yearly');

    //permission
    route::get('permissions', 'PermissionsController@index')->name('permissions');
    route::get('loadpermissions', 'PermissionsController@load')->name('permissions.load');

    //roles
    Route::resource('roles', 'RolesController');
    route::get('loadroles', 'RolesController@load')->name('roles.load');

    //users
    Route::resource('users', 'UsersController');
    route::get('loadusers', 'UsersController@load')->name('users.load');


});
