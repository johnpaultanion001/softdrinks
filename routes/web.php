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
    Route::delete('sales/{sale}', 'SalesController@destroy')->name('sales.destroy');

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

    //order-purchase
    route::get('purchase-order', 'PurchaseOrderController@index')->name('purchase-order.index');
    route::get('loadpurchaseorder', 'PurchaseOrderController@load')->name('purchase-order.load');
    route::get('purchase-order/{purchasenumber}', 'PurchaseOrderController@view')->name('purchase-order.view');
    route::get('purchase-order/{purchasenumber}/edit', 'PurchaseOrderController@edit')->name('purchase-order.edit');
    route::put('purchase-order/{purchasenumber}', 'PurchaseOrderController@update')->name('purchase-order.update');
    route::get('loadeditpurchase/{purchasenumber}/load', 'PurchaseOrderController@loadedit')->name('purchase-order.editload');
    
    //return Products
    Route::resource('returned', 'ReturnedController');
    route::get('returned/{returned}/loadreturnedproduct', 'ReturnedController@loadreturnedproduct')->name('purchase-order.loadreturnedproduct');
    route::get('loadreturned', 'ReturnedController@loadreturned')->name('purchase-order.loadreturned');
    route::get('returned/{returned}/viewreturn', 'ReturnedController@viewreturn')->name('returned.viewreturn');

    
    Route::resource('returned/pendingreturnedproducts', 'PendingReturnedProductController');
    route::post('returned/pendingreturnedproducts/update', 'PendingReturnedProductController@storeedit')->name('pendingreturnedproducts.storeedit');
    route::put('returned/pendingreturnedproducts/update/{pendingreturnedproduct}', 'PendingReturnedProductController@updateedit')->name('pendingreturnedproducts.updateedit');
    route::delete('returned/pendingreturnedproducts/update/{pendingreturnedproduct}', 'PendingReturnedProductController@destroyedit')->name('pendingreturnedproducts.destroyedit');

    //status returned
    Route::resource('status-return', 'StatusReturnController');
    route::get('loadstatus', 'StatusReturnController@load')->name('status-return.load');

    //pendingproduct
    route::get('totalpendingproduct', 'PurchaseOrderController@total')->name('purchaseorder.total');
    route::post('purchase-order', 'PurchaseOrderController@store')->name('purchase-order.store');
    route::put('purchase-order/{purchasenumber}', 'PurchaseOrderController@update')->name('purchase-order.update');


    Route::resource('purchase-order/pending-product', 'PendingProductController');
    route::get('loadpendingproduct', 'PendingProductController@load')->name('pending-prooduct.load');
    

    //suppliers
    Route::resource('suppliers', 'SupplierController');
    route::get('loadsuppliers', 'SupplierController@load')->name('supplier.load');

    
    //sizes
    Route::resource('sizes', 'SizeController');
    route::get('loadsizes', 'SizeController@load')->name('size.load');

     //UCS
     Route::resource('ucs', 'UCSController');
     route::get('loaducs', 'UCSController@load')->name('ucs.load');

    //Categories
    Route::resource('categories', 'CategoryController');
    route::get('loadcategories', 'CategoryController@load')->name('categorie.load');
});
