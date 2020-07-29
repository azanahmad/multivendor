<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/login', function () {
//    return view('welcome');
//});
//Route::get('/shopify_install', function () {
//
//    return view('welcome');
//
//})->middleware(['auth.shopify']);



Route::get('/', 'HomeController@index')->name('home');
//Route::group(['prefix'=>'admin'],function () {

Auth::routes();

//});

Route::get('/adminrole', 'HelperController@SuperAdminCreate')->name('admin.role');


Route::group(['prefix'=>'admin'],function (){
    Route::group(['middleware' =>['admin_role']],function() {
//package routes

        Route::get('/','AdminController@dashboard')->name('admin.dashboard');
        Route::get('/package/create', 'PackageController@index')->name('package.index');
        Route::post('/package/store', 'PackageController@store')->name('package.store');
        Route::get('/package/show', 'PackageController@show')->name('package.show');
        Route::get('/package/{id}/edit', 'PackageController@edit')->name('package.edit');
        Route::post('/package/update/{id}', 'PackageController@update')->name('package.update');
        Route::post('/package/delete/', 'PackageController@destroy')->name('package.delete');
        Route::get('/paypal_plan/{id}', 'PackageController@activate')->name('package.activate');
        Route::get('/vendor/list', 'VendorController@show')->name('vendor.show');
        Route::get('/payment/{id}', 'PackageController@payment')->name('payment');
        Route::get('add_membership','MembershipController@index');
        Route::post('post_membership','MembershipController@package_save');
        Route::get('all_membership','MembershipController@all');
        Route::get('all_products','ProductsController@all');
        Route::get('add_categories','ProductsController@category');
        Route::post('save_category','ProductsController@category_save');
        Route::post('save_sub_category','ProductsController@sub_category_save');
        Route::post('category/update','CategoryController@category_update');
        Route::get('category/delete/{id}','CategoryController@category_delete');
        Route::post('subcategory/update','CategoryController@subcategory_update');
        Route::get('subcategory/delete/{id}','CategoryController@subcategory_delete');
        Route::post('approve/','AdminController@status');
        Route::post('rejected/','AdminController@rejected');
//        Route::get('shipping_zone','ShippingZoneController@shipping');
//        Route::post('create_zones','ShippingZoneController@shipping_create');
//        Route::post('create_rate','ShippingZoneController@shipping_rate_add');
//        Route::get('delete_zones/{id}','ShippingZoneController@shipping_delete');
//        Route::post('update_zone/{id}','ShippingZoneController@shipping_update');
//        Route::get('rate/delete/{id}','ShippingZoneController@rate_delete');
//        Route::post('rate/update','ShippingZoneController@rate_update');
        Route::get('product/view/{id}','ProductsController@product_view');
        Route::get('Orders/all/','OrdersController@index')->name('orders.index');
        Route::get('Orders/{id}/details','OrdersController@order_details')->name('order_details');
        Route::post('/orders/view/{id}/fulfillment/process','OrderController@fulfillment_order')->name('admin.order.fulfillment.process');
        Route::get('/orders/view/{id}/fulfillment','OrdersController@fulfill_order')->name('admin.order.fulfillment');

        Route::post('/Paypal/{id}/pay/{total}','PaymentController@index')->name('paypal_payments');
        Route::post('/Stripe/{id}/pay/{total}','PaymentController@stripe_payment')->name('stripe_payment');

        Route::get('/orders/sync','OrdersController@get_shopify_orders')->name('orders.sync');

        Route::post('/orders/{id}/fulfillment/tracking','OrdersController@fulfillment_add_tracking')->name('admin.order.fulfillment.tracking');
        Route::post('/orders/view/{id}/fulfillment/process','OrdersController@vendor_fulfillment_order')->name('admin.order.fulfillment.process');
        Route::post('/orders/{id}/fulfillment/tracking','OrdersController@fulfillment_add_tracking')->name('admin.order.fulfillment.tracking');
        Route::get('/vendor/{id}/history','VendorController@history')->name('vendor.history');

    });
});


Route::group(['middleware' =>['vendor_role']],function() {

    Route::get('all_products','ProductsController@all_product');
    Route::get('products','ProductsController@index');
    Route::post('post_product','ProductsController@product_save');
    Route::get('edit/{id}','ProductsController@edit');
    Route::post('update/{id}','ProductsController@update');
    Route::get('delete/{id}','ProductsController@delete_product');
    Route::get('product/view/{id}','ProductsController@view_product');
    Route::post('edit_varient_save/{id}/product/{product_id}','ProductsController@edit_varient_save')->name('edit_varient_save');

    Route::post('varient_update/{id}/product/{product_id}','ProductsController@varient_update')->name('varient_update');

    Route::post('edit_varient_details/{id}/product/{product_id}','ProductsController@edit_varient_details')->name('edit_varient_details');

    Route::get('Product/{product_id}/Variant/{id}','ProductsController@edit_varient')->name('edit_varient');

    Route::post('varient/delete','ProductsController@varient_delete');

    Route::post('varient/image_add','ProductsController@varient_image_add')->name('varient_image_add');

    Route::post('varient_add/{id}','ProductsController@varient_add')->name('varient_add');

    Route::post('image/delete','ProductsController@image_delete')->name('image_delete');

    //add shipping route
    Route::get('shipping_zone','ShippingZoneController@shipping');
    Route::post('create_zones','ZoneController@create')->name('zone.create');
    Route::post('/zone/{id}/update','ZoneController@update')->name('zone.update');
    Route::any('/zone/{id}/delete','ZoneController@delete')->name('zone.delete');
    Route::post('/zone/rate/{id}','ZoneController@rate_create')->name('zone.rate.create');
    Route::post('/zone/rate/{id}/update','ZoneController@rate_update')->name('zone.rate.update');
    Route::any('/zone/rate/{id}/delete','ZoneController@rate_delete')->name('zone.rate.delete');

    Route::get('/orders/all','OrdersController@vendorOrder')->name('orders.vendor.index');
    Route::get('Orders/{id}/details','OrdersController@vendor_order_details')->name('vendor_order_details');
    Route::get('/orders/view/{id}/fulfillment','OrdersController@vendor_fulfill_order')->name('vendor_fulfill_order');
    Route::post('/orders/view/{id}/fulfillment/process','OrdersController@vendor_fulfillment_order')->name('vendor.order.fulfillment.process');
    Route::post('/orders/{id}/fulfillment/tracking','OrdersController@fulfillment_add_tracking')->name('vendor.order.fulfillment.tracking');

});

Route::get('/Plan/{id}/Subscription/', 'PackageController@cart')->name('cart_page');
Route::get('/list', 'PackageController@list_plan');
Route::get('/strip_subscribe', 'PackageController@strip_subscribe')->name('strip_subscribe');
Route::post('/payment/{id}/plan','PackageController@create_agreement')->name('create_agreement');
Route::get('/execute/agreement/{status}','PackageController@execute_agreement')->name('execute_agreement');
Route::get('/pricing/', 'PackageController@pricing')->name('package.pricing');
Route::get('/success', 'PackageController@success')->name('success');
Route::get('/check','PackageController@check');
