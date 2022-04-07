<?php
Route::get('admin/1/{id}',  'Admin\InvoicesController@exportbycity');
Route::get('/', 'Admin\AdminAuthController@login');
Route::post('/', 'Admin\AdminAuthController@dologin');

Route::get('sendhtmlemail/{id}','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');
        Route::get('facebook', function () {
            return view('facebook');
        });

Route::group(['prefix' => 'Create_Account_Private','namespace' => 'Admin'], function () {
    Route::get('/', ['as' => 'admin.Create_Account_Private', 'uses' => 'Create_Account_Private@search']);
    Route::get('/create', ['as' => 'admin.Create_Account_Private.create', 'uses' => 'Create_Account_Private@create']);
    Route::post('/store', ['as' => 'admin.Create_Account_Private.store', 'uses' => 'Create_Account_Private@store']);

});

        Route::get('auth/facebook', 'Controller@redirectToFacebook');
        Route::any('auth/facebook/callback', 'Controller@handleFacebookCallback');
        Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
        Config::set('auth.defines', 'admin');
        Route::get('login', 'AdminAuthController@login');
        Route::post('login', 'AdminAuthController@dologin');
        Route::get('forgot/password', 'AdminAuthController@forgot_password');
        Route::post('forgot/password', 'AdminAuthController@forgot_password_post');
        Route::get('reset/password/{token}', 'AdminAuthController@reset_password');
        Route::post('reset/password/{token}', 'AdminAuthController@reset_password_final');
        Route::group(['middleware' => 'admin:admin'], function () {

        Route::resource('admin', 'AdminController');
        Route::delete('admin/destroy/all', 'AdminController@multi_delete');


            Route::get('testFathy/{id}', 'generalcontroller@Check_Status');


            Route::resource('users', 'UsersController');
        Route::delete('users/destroy/all', 'UsersController@multi_delete');

        //pages
        Route::resource('pages', 'PagesController');
        Route::post('pages/store', 'PagesController@store');
       // Route::post('pages/update/{id}', 'PagesController@update');
        Route::delete('pages/destroy/all', 'PagesController@multi_delete');
        //Roles
        Route::resource('roles', 'RolesController');
        Route::post('pages/store', 'RolesController@store');

        //Home DashBoard
        Route::get('/', 'DashboardController@index');

        //Items
                 //social
        Route::resource('social', 'SocialController');
        Route::post('social/store', 'SocialController@store');
        Route::post('social/update/{id}', 'SocialController@update');
        Route::post('social/destroy/{id}', 'SocialController@destroy');
        Route::delete('social/destroy/all', 'SocialController@multi_delete');
                    //social
        Route::get('ajaxrate/{package}/{area_id}','InvoicesController@Shipping_cost');

        Route::resource('items', 'ItemsController');
        Route::post('items/store', 'ItemsController@store');
        Route::post('items/update/{id}', 'ItemsController@update');
        Route::get('items/{id}', 'ItemsController@show');
        Route::post('items/destroy/{id}', 'ItemsController@destroy');
        Route::delete('items/destroy/all', 'ItemsController@multi_delete');
        Route::get('items', 'ItemsController@search');
        // Route::get('export', ['as' => 'admin.items.export', 'uses' => 'ItemsController@export']);

        //raw items
        Route::resource('rawitems', 'RawitemController');
        Route::post('rawitems/store', 'RawitemController@store');
        Route::put('rawitems/update/{id}', 'RawitemController@update');
        Route::get('rawitems/{id}', 'RawitemController@show');
        Route::post('rawitems/destroy/{id}', 'RawitemController@destroy');
        Route::delete('rawitems/destroy/all', 'RawitemController@multi_delete');
        Route::get('rawitems', 'RawitemController@search');
        // Route::get('export', ['as' => 'admin.items.export', 'uses' => 'RawitemController@export']);


            //offers
            Route::resource('offers', 'OffersController');
            Route::get('offer/requests', 'OffersController@requests');
            Route::get('offer/requests/id/{from_cur?}/{to_cur?}', 'OffersController@showreq')->name('showReq');
            Route::post('offers/store', 'OffersController@store')->name('offerStore');
            Route::post('offer/request/validate', 'OffersController@confirmRequest')->name('confirmRequest');
            Route::post('items/update/{id}', 'ItemsController@update');
            Route::get('offers/{id}', 'OffersController@show');
            
            
            Route::post('offers/destroy/{id}', 'OffersController@destroy');
            Route::delete('request/{id}', 'OffersController@destroyreq');
            Route::delete('offers/destroy/all', 'OffersController@multi_delete');
            Route::get('items', 'ItemsController@search');
            Route::get('export', ['as' => 'admin.items.export', 'uses' => 'ItemsController@export']);

        //Items link generate
        Route::get('admin/items/links', 'ItemsController@links')->name('links');

        // Start Ahmed Gorashi
        //Items Categories
        Route::resource('cats', 'CategoryController');
        Route::post('cats/store', 'CategoryController@store');
        Route::post('cats/update/{id}', 'CategoryController@update');
        Route::post('cats/destroy/{id}', 'CategoryController@destroy');
        Route::delete('cats/destroy/all', 'CategoryController@multi_delete');
        //Cities
        Route::resource('cities', 'CitiesController');
        Route::post('cities/store', 'CitiesController@store');
        Route::post('cities/update/{id}', 'CitiesController@update');
        Route::post('cities/destroy/{id}', 'CitiesController@destroy');
        Route::delete('cities/destroy/all', 'CitiesController@multi_delete');
        //Route::get('export', ['as' => 'admin.cats.export10', 'uses' => 'CategoryController@export']);
        //Returned Invoices
        Route::resource('returned_invoices', 'ReturnedInvoicesController');
        Route::post('returned_invoices/store', 'ReturnedInvoicesController@store');
        Route::post('returned_invoices/update/{id}', 'ReturnedInvoicesController@update');
        Route::post('returned__invoices/destroy/{id}', 'ReturnedInvoicesController@destroy');
        Route::delete('returned_invoices/destroy/all', 'ReturnedInvoicesController@multi_delete');
        Route::get('returned_invoices/show/{id}/{from_cur?}/{to_cur?}', 'ReturnedInvoicesController@show');
        Route::get('returned_invoices', 'ReturnedInvoicesController@search');
        Route::get('exportinvoices', ['as' => 'admin.invoices.exportinvoices', 'uses' => 'ReturnedInvoicesController@export']);

Route::get('ajaxAreas/{id?}', 'InvoicesController@ajax_data');
        //facebook

      
        //Specifications
        Route::resource('specific', 'SpecificationsController');
        Route::post('specific/store', 'SpecificationsController@store');
        Route::post('specific/update/{id}', 'SpecificationsController@update');
        Route::post('specific/destroy/{id}', 'SpecificationsController@destroy');
        Route::delete('specific/destroy/all', 'SpecificationsController@multi_delete');
        //Items Colors
        Route::resource('itemscolors', 'ItemsColorsController');
        Route::post('itemscolors/store', 'ItemsColorsController@store');
        Route::post('itemscolors/update/{id}', 'ItemsColorsController@update');
        Route::post('itemscolors/destroy/{id}', 'ItemsColorsController@destroy');
        Route::delete('itemscolors/destroy/all', 'ItemsColorsController@multi_delete');
        //Items Sizes
        Route::resource('itemssizes', 'ItemsSizesController');
        Route::post('itemssizes/store', 'ItemsSizesController@store');
        Route::post('itemssizes/update/{id}', 'ItemsSizesController@update');
        Route::post('itemssizes/destroy/{id}', 'ItemsSizesController@destroy');
        Route::delete('itemssizes/destroy/all', 'ItemsSizesController@multi_delete');
        //InvoiceSource
        Route::resource('sources', 'InvoiceSourceController');
        Route::post('sources/store', 'InvoiceSourceController@store');
        Route::post('sources/update/{id}', 'InvoiceSourceController@update');
        Route::post('sources/destroy/{id}', 'InvoiceSourceController@destroy');
        Route::delete('sources/destroy/all', 'InvoiceSourceController@multi_delete');
        //Route::get('export', ['as' => 'admin.cats.export10', 'uses' => 'CategoryController@export']);
        // End Ahmed Gorashi
        //Itemserials
        Route::resource('itemserials', 'ItemserialsController');
        Route::post('itemserials/store', 'ItemserialsController@store');
        Route::post('itemserials/update/{id}', 'ItemserialsController@update');
        Route::post('itemserials/destroy/{id}', 'ItemserialsController@destroy');
        Route::delete('itemserials/destroy/all', 'ItemserialsController@multi_delete');
        Route::post('itemserials/create/{id}', 'ItemserialsController@transfer');

        Route::get('itemserials', 'ItemserialsController@search');
        Route::get('export8', ['as' => 'admin.itemserials.export8', 'uses' => 'ItemserialsController@export']);
        Route::get('itemserials/addNew/{id}', 'ItemserialsController@addnew');

        //Devices
        Route::resource('devices', 'DevicesController');
        //Route::get('devices/{id}', 'DevicesController@getcount');
        Route::post('devices/store', 'DevicesController@store');
        Route::post('devices/update/{id}', 'DevicesController@update');
        Route::post('devices/destroy/{id}', 'DevicesController@destroy');
        Route::delete('devices/destroy/all', 'DevicesController@multi_delete');
        Route::get('devices/createcount', 'DevicesController@count_store');
        Route::get('devices/count/{device}', 'DevicesController@getcount');
        Route::get('devices', 'DevicesController@search');
        Route::get('export2', ['as' => 'admin.devices.export2', 'uses' => 'DevicesController@export']);
        //Deviceitems
        Route::resource('deviceitems', 'DeviceitemsController');
        Route::post('deviceitems/store', 'DeviceitemsController@store');
        Route::post('deviceitems/update/{id}', 'DeviceitemsController@update');
        Route::post('deviceitems/destroy/{id}', 'DeviceitemsController@destroy');
        Route::delete('deviceitems/destroy/all', 'DeviceitemsController@multi_delete');
        Route::get('deviceitems/{devices_id?}',  'DeviceitemsController@show');

        Route::get('deviceitems/addNew/{id}', 'DeviceitemsController@addnew');

        Route::get('deviceitems', 'DeviceitemsController@search');
        Route::get('export3', ['as' => 'admin.deviceitems.export3', 'uses' => 'DeviceitemsController@export']);
        //SubDeices
        Route::resource('subdevices', 'SubdevicesController');
        Route::post('subdevices/store', 'SubdevicesController@store');
        Route::post('subdevices/update/{id}', 'SubdevicesController@update');
        Route::post('subdevices/destroy/{id}', 'SubdevicesController@destroy');
        Route::delete('subdevices/destroy/all', 'SubdevicesController@multi_delete');
        Route::get('subdevices', 'SubdevicesController@search');
        Route::get('subdevices/addNew/{id}', 'SubdevicesController@addnew');

        //Suppliers
        Route::resource('suppliers', 'SuppliersController');
        Route::post('suppliers/store', 'SuppliersController@store');
        Route::post('suppliers/update/{id}', 'SuppliersController@update');
        Route::post('suppliers/destroy/{id}', 'SuppliersController@destroy');
        Route::delete('suppliers/destroy/all', 'SuppliersController@multi_delete');
        Route::get('export', ['as' => 'admin.suppliers.export6', 'uses' => 'SuppliersController@export']);

        //Manufacturer
        Route::resource('manufacturer', 'ManufacturerController');
        Route::post('manufacturer/store', 'ManufacturerController@store');
        Route::post('manufacturer/update/{id}', 'ManufacturerController@update');
        Route::post('manufacturer/destroy/{id}', 'ManufacturerController@destroy');
        Route::delete('manufacturer/destroy/all', 'ManufacturerController@multi_delete');
        Route::get('export6', ['as' => 'admin.manufacturer.export6', 'uses' => 'ManufacturerController@export']);


        Route::get('suppliers/createbills/create', ['as' => 'admin.suppliers.createBills', 'uses' => 'SuppliersController@createbills']);
        Route::post('suppliers/createbills/storeBills', ['as' => 'admin.suppliers.storeBills', 'uses' => 'SuppliersController@storeBills']);

        Route::get('suppliers', 'SuppliersController@search');
        //Supplierproducts
        Route::resource('supplierproducts', 'SupplierproductsController');
        Route::post('supplierproducts/store', 'SupplierproductsController@store');
        Route::post('supplierproducts/update/{id}', 'SupplierproductsController@update');
        Route::post('supplierproducts/destroy/{id}', 'SupplierproductsController@destroy');
        Route::delete('supplierproducts/destroy/all', 'SupplierproductsController@multi_delete');
        Route::get('export7', ['as' => 'admin.supplierproducts.export7', 'uses' => 'SupplierproductsController@export']);
        Route::get('supplierproducts', 'SupplierproductsController@search');
        Route::get('supplierproducts/addNew/{id}', 'SupplierproductsController@addnew');


        //Shipping
        Route::resource('shipping', 'ShippingController');
        Route::post('shipping/store', 'ShippingController@store');
        Route::post('shipping/update/{id}', 'ShippingController@update');
        Route::post('shipping/destroy/{id}', 'ShippingController@destroy');
        Route::delete('shipping/destroy/all', 'ShippingController@multi_delete');
        Route::get('shipping', 'ShippingController@search');

Route::get('test/{id}','generalcontroller@countdiv');



        //Bills
        Route::resource('bills', 'BillsController');
        Route::post('bills/store', 'BillsController@store');
        Route::get('bills/create', 'BillsController@create');
        Route::get('bills/createtwo/{id}', 'BillsController@createtwo');
        Route::post('bills/update/{id}', 'BillsController@update');
        Route::post('bills/destroy/{id}', 'BillsController@destroy');
        Route::delete('bills/destroy/all', 'BillsController@multi_delete');
        Route::get('bills/show/{id}/{from_cur?}/{to_cur?}', 'BillsController@bill');
        Route::get('bills/egyptshow/{id}/{from_cur?}/{to_cur?}', 'BillsController@showEgypt');
        Route::get('bills/show/', 'BillsController@bill')->name('cur');
        Route::post('bills/drive/{devices_id}','BillsController@ajaxdrive');
        Route::get('bills', 'BillsController@search');

        Route::post('/bills/savedraftTosave', ['as' => 'admin.bills.savedraftTosave', 'uses' => 'BillsController@savedraftTosave']);

        Route::get('exportbills', ['as' => 'admin.bills.exportbills', 'uses' => 'BillsController@export']);
//Invoices Bills
        Route::get('bills/getpdf/{id}', ['as' => 'admin.bills.getpdf', 'uses' => 'BillsController@getPdf']);
        Route::get('bills/createGetPdf/{id}', ['as' => 'admin.bills.createGetPdf', 'uses' => 'BillsController@createGetPdf']);
        Route::post('bills/stoneGetPdf/{id}', ['as' => 'admin.bills.stoneGetPdf', 'uses' => 'BillsController@stoneGetPdf']);

        Route::get('bills/editgetpdf/{id}', ['as' => 'admin.bills.editgetpdf', 'uses' => 'BillsController@editgetPdf']);

        Route::post('bills/updategetpdf/{id}', ['as' => 'admin.bills.updateGetPdf', 'uses' => 'BillsController@updateGetPdf']);
        Route::post('bills/destroypdf/{id}', ['as' => 'admin.bills.destroyPdf', 'uses' => 'BillsController@destroyPdf']);


            //Workorders
            Route::resource('workorder', 'WorkorderController');
            Route::post('workorder/store', 'WorkorderController@store');
            Route::get('workorder/create', 'WorkorderController@create');
            Route::get('workorder/recieve/{id}', 'WorkorderController@recieve');
            Route::post('workorder/submitquan', 'WorkorderController@changequantity')->name('admin.workorder.changequan');
            //Returned Bills
            route::group(['prefix'=>'returnedbills'],function (){
                Route::resource('/', 'ReturnedBillsController');
                Route::post('/store', 'ReturnedBillsController@store')->name('returnedbills.store');
                Route::post('/createRetured/', 'ReturnedBillsController@createRetured')->name('admin.returnedbills.createRetured');
                Route::get('/createtwo/{id}', 'ReturnedBillsController@createtwo');
                Route::get('/bill/{id}', 'ReturnedBillsController@bill');
                Route::post('/update/{id}', 'ReturnedBillsController@update')->name('returnedbills.update');
                Route::post('/destroy/{id}', 'ReturnedBillsController@destroy');
                Route::delete('/destroy/all', 'ReturnedBillsController@multi_delete');
                Route::get('/show/{id}/{from_cur?}/{to_cur?}', 'ReturnedBillsController@bill');
                Route::get('/egyptshow/{id}/{from_cur?}/{to_cur?}', 'ReturnedBillsController@showEgypt');
                Route::get('/show/', 'ReturnedBillsController@bill')->name('cur');
                Route::post('/drive/{devices_id}','ReturnedBillsController@ajaxdrive');
                Route::get('', 'ReturnedBillsController@search');

                Route::post('/savedraftTosave', ['as' => 'admin.returnedbills.savedraftTosave', 'uses' => 'ReturnedBillsController@savedraftTosave']);

//Invoices Returned Bills
                Route::get('/getpdf/{id}', ['as' => 'admin.bills.getpdf', 'uses' => 'ReturnedBillsController@getPdf']);
                Route::get('/createGetPdf/{id}', ['as' => 'admin.bills.createGetPdf', 'uses' => 'ReturnedBillsController@createGetPdf']);
                Route::post('/stoneGetPdf/{id}', ['as' => 'admin.bills.stoneGetPdf', 'uses' => 'ReturnedBillsController@stoneGetPdf']);

                Route::get('/editgetpdf/{id}', ['as' => 'admin.bills.editgetpdf', 'uses' => 'ReturnedBillsController@editgetPdf']);

                Route::post('/updategetpdf/{id}', ['as' => 'admin.bills.updateGetPdf', 'uses' => 'ReturnedBillsController@updateGetPdf']);
                Route::post('/destroypdf/{id}', ['as' => 'admin.bills.destroyPdf', 'uses' => 'ReturnedBillsController@destroyPdf']);

            });

            //Bills Ajax
        Route::any('ajax/totalprice', 'generalcontroller@totalprice');
        Route::any('ajax/deviceid/{id?}', 'generalcontroller@deviceid')->name('deviceid');
        Route::any('ajax/finalpcprice/', 'generalcontroller@finalpcprice')->name('finalpcprice');
        Route::any('ajax/itemget/', 'generalcontroller@itemget')->name('itemget');
        Route::any('ajax/devices', 'generalcontroller@devices')->name('devices');

        //Billparts
        Route::resource('billparts', 'BillpartsController');
        Route::post('billparts/store', 'BillpartsController@store');
        Route::post('billparts/update/{id}', 'BillpartsController@update');
        Route::post('billparts/destroy/{id}', 'BillpartsController@destroy');
        Route::delete('billparts/destroy/all', 'BillpartsController@multi_delete');

        //Invoices
        Route::resource('invoices', 'InvoicesController');
        //Route::post('invoices/{id}', 'InvoicesController@index2');
        Route::get('invoices/inv/create', 'InvoicesController@createdir');
       
        Route::get('invoices/userinvoices/{id}', 'InvoicesController@index2');
        Route::post('invoices/printInvoices', 'InvoicesController@printInvoices')->name('admin.invoices.printInvoices');
        Route::post('invoices/getInvoices', 'InvoicesController@getInvoices')->name('admin.invoices.getInvoices');
        Route::post('invoices/InvoicesStatus', 'InvoicesController@InvoicesStatus')->name('admin.invoices.InvoicesStatus');
       Route::post('invoices/changeStatus','InvoicesController@changestatues');
        Route::post('invoices/createRetured/', 'InvoicesController@createRetured')->name('admin.invoices.createRetured');
        Route::post('invoices/createdirect/', 'InvoicesController@createdirect')->name('admin.invoices.createdirect');
        
        Route::post('invoices/store', 'InvoicesController@store');
        //Route::get('invoices/addInvoice', 'InvoicesController@addInvoice')->name('ahmed.ahmed');
        Route::post('invoices/create', 'InvoicesController@create');
        Route::get('invoices/createtwo/{id}', 'InvoicesController@createtwo');
        Route::post('invoices/update/{id}', 'InvoicesController@update');
        Route::post('invoices/createStatus/{id}', 'InvoicesController@createStatus');
        Route::get('invoices/createStatus/{id}', 'InvoicesController@createStatus');
        Route::post('invoices/destroy/{id}', 'InvoicesController@destroy');
        Route::get('invoices/show/{id}/{from_cur?}/{to_cur?}', 'InvoicesController@show');
        Route::get('invoices', 'InvoicesController@search');
        Route::get('getdata', 'InvoicesController@getdata')->name('admin.invoices.getdata');
            Route::get('ajaxdata/massremove', 'InvoicesController@massremove')->name('ajaxdata.massremove');

            Route::get('mainIndex', 'InvoicesController@mainIndex')->name('admin.invoices.mainIndex');
        Route::get('exportinvoices', ['as' => 'admin.invoices.exportinvoices', 'uses' => 'InvoicesController@export']);
        Route::get('exportinvoices/{id}', ['as' => 'admin.invoices.exportbycity', 'uses' => 'InvoicesController@exportbycity']);
            Route::get('invoices/shipping/update', ['as' => 'admin.invoices.shipping', 'uses' => 'InvoicesController@shipping_update']);


//Invoices PDF
        Route::get('invoices/getpdf/{id}', ['as' => 'admin.invoices.getpdf', 'uses' => 'InvoicesController@getPdf']);
        Route::get('invoices/editgetpdf/{id}', ['as' => 'admin.invoices.editgetpdf', 'uses' => 'InvoicesController@editgetPdf']);
        Route::post('invoices/updategetpdf/{id}', ['as' => 'admin.invoices.updateGetPdf', 'uses' => 'InvoicesController@updateGetPdf']);
        Route::post('invoices/destroypdf/{id}', ['as' => 'admin.invoices.destroyPdf', 'uses' => 'InvoicesController@destroyPdf']);
        Route::get('invoices/createGetPdf/{id}', ['as' => 'admin.invoices.createGetPdf', 'uses' => 'InvoicesController@createGetPdf']);
        Route::post('invoices/stoneGetPdf/{id}', ['as' => 'admin.invoices.stoneGetPdf', 'uses' => 'InvoicesController@stoneGetPdf']);
        //Invoices Ajax
        Route::any('invoices/ajax/itemsid/{id?}', 'InvoicesController@itemsid')->name('itemsid');
        
        Route::any('invoices/ajax/itemscolor/{id?}', 'InvoicesController@itemscolor')->name('itemscolor');
        Route::any('invoices/ajax/getItemsQuantity/{item_id?}/{color_id?}/{size_id?}', 'InvoicesController@getItemsQuantity')->name('getItemsQuantity');
        Route::any('invoices/ajax/getItemsPrice/{item_id?}/{color_id?}/{size_id?}', 'InvoicesController@getItemsPrice')->name('getItemsPrice');
        Route::any('invoices/ajax/getItemsColor/{id?}', 'InvoicesController@getItemsColor')->name('getItemsColor');

        Route::get('invoices/ajax/getItemsSize/{item_id?}/{color_id?}/{zxid?}', 'InvoicesController@getItemsSize')->name('getItemsSize');
        Route::get('invoices/ajax/getItemsSize1/{item_id?}/{color_id?}', 'InvoicesController@getItemsSize1')->name('getItemsSize1');
        Route::any('invoices/ajax/devicemid/{id?}', 'InvoicesController@deviceid')->name('devicemid');
        Route::any('invoices/ajax/sumdevices/{id?}', 'InvoicesController@sumDevices')->name('invoices.sumdevices');

        Route::any('invoices/ajax/sumDevicesQuantity/{id?}', 'InvoicesController@sumDevicesQuantity')->name('invoices.sumDevicesQuantity');
        //Add Tax
        Route::any('invoices/addtaxs/{id?}', 'InvoicesController@Addtaxi')->name('Addtaxi');
        Route::post('invoices/save/savedraftTosave', ['as' => 'admin.invoices.savedraftTosave', 'uses' => 'InvoicesController@savedraftTosave']);
        Route::post('invoices/save/changestatus', ['as' => 'admin.invoices.changestatus', 'uses' => 'InvoicesController@changestatues']);
        
        Route::get('request/changestatus/{id}', ['as' => 'request.changestatus', 'uses' => 'OffersController@changestatues']);
        Route::get('user/request/changestatus/{id}','Controller@userchangestatues')->name('requests.changestatus');

        //Shipments
        Route::resource('shipments', 'ShipmentsController');
        Route::get('shipments/addNew/{id}', 'ShipmentsController@addnew');
        Route::post('shipments/store', 'ShipmentsController@store');
        Route::post('shipments/update/{id}', 'ShipmentsController@update');
        Route::post('shipments/destroy/{id}', 'ShipmentsController@destroy');
        Route::delete('shipments/destroy/all', 'ShipmentsController@multi_delete');
        Route::get('shipments', 'ShipmentsController@search');
        //Billitems
        Route::resource('billitems', 'BillitemsController');
        Route::post('billitems/store', 'BillitemsController@store');
        Route::post('billitems/update/{id}', 'BillitemsController@update');
        Route::post('billitems/destroy/{id}', 'BillitemsController@destroy');
        Route::delete('billitems/destroy/all', 'BillitemsController@multi_delete');
        //Returned Billitems
        Route::resource('returned_billitems', 'ReturnedBillItemsController');
        Route::post('returned_billitems/store', 'ReturnedBillItemsController@store');
        Route::post('returned_billitems/update/{id}', 'ReturnedBillItemsController@update');
        Route::post('returned_billitems/destroy/{id}', 'ReturnedBillItemsController@destroy');
        Route::delete('returned_billitems/destroy/all', 'ReturnedBillItemsController@multi_delete');
        //currencies
        Route::resource('currencies', 'CurrenciesController');
        Route::post('currencies/store', 'CurrenciesController@store');
        Route::post('currencies/update/{id}', 'CurrenciesController@update');
        Route::post('currencies/destroy/{id}', 'CurrenciesController@destroy');
        Route::delete('currencies/destroy/all', 'CurrenciesController@multi_delete');
        //currencyRate
        Route::resource('currencyrate', 'CurrencyratesController');
        Route::post('currencyrate/store', 'CurrencyratesController@store');
        
        Route::post('currencyrate/update/', ['as' => 'admin.currencyrate.update', 'uses' => 'CurrencyratesController@update']);
        Route::post('currencyrate/destroy/{id}', 'CurrencyratesController@destroy');
        Route::delete('currencyrate/destroy/all', 'CurrencyratesController@multi_delete');
        //Clients
        Route::resource('clients', 'ClientsController');
        Route::post('clients/store', 'ClientsController@store');
        Route::post('clients/update/{id}', 'ClientsController@update');
        Route::post('clients/destroy/{id}', 'ClientsController@destroy');
        Route::delete('clients/destroy/all', 'ClientsController@multi_delete');
        Route::get('clients', 'ClientsController@search');

        Route::get('clients/createbills/create', ['as' => 'admin.clients.createBills', 'uses' => 'ClientsController@createbills']);
        Route::post('clients/createbills/storeBills', ['as' => 'admin.clients.storeBills', 'uses' => 'ClientsController@storeBills']);

        //Projects
        Route::resource('projects', 'ProjectsController');
        Route::post('projects/store', 'ProjectsController@store');
        Route::post('projects/update/{id}', 'ProjectsController@update');
        Route::post('projects/destroy/{id}', 'ProjectsController@destroy');
        Route::delete('projects/destroy/all', 'ProjectsController@multi_delete');
        //Route::get('projects/show/{id}', 'ProjectsController@project_print');

        Route::get('export4', ['as' => 'admin.projects.export4', 'uses' => 'ProjectsController@export']);
        Route::get('projects', 'ProjectsController@search');

        Route::post('projects/underway', ['as' => 'admin.projects.Underway', 'uses' => 'ProjectsController@TransferToUnderway']);


        Route::any('projects/ajax/devicemid/{id?}', 'ProjectsController@deviceid')->name('projectitems.Ajax');

        Route::any('projects/show/{id}/{from_cur?}/{to_cur?}', 'ProjectsController@project_print');
        //Projects Items
        Route::resource('projectitems', 'ProjectitemsController');
        Route::post('projectitems/store', 'ProjectitemsController@store');
        Route::post('projectitems/update/{id}', 'ProjectitemsController@update');
        Route::post('projectitems/destroy/{id}', 'ProjectitemsController@destroy');
        Route::delete('projectitems/destroy/all', 'ProjectitemsController@multi_delete');
        Route::get('projectitems/{project_id?}',  'ProjectitemsController@show');
        Route::get('projectitems/addNew/{id}', 'ProjectitemsController@addnew');
        Route::get('projectdevice/{edit}', 'ProjectitemsController@editdevices');




        //projectitems Ajax
        Route::any('projectitems/ajax/itemsid/{id?}', 'ProjectitemsController@itemsid')->name('projectitems.itemsid');

        Route::any('projectitems/ajax/devicemid/{id?}', 'ProjectitemsController@deviceid')->name('projectitems.devicemid');

        //Expenses Items
        Route::resource('expensesitems', 'ExpensesitemsController');
        Route::post('expensesitems/store', 'ExpensesitemsController@store');
        Route::post('expensesitems/update/{id}', 'ExpensesitemsController@update');
        Route::post('expensesitems/destroy/{id}', 'ExpensesitemsController@destroy');
        Route::delete('expensesitems/destroy/all', 'ExpensesitemsController@multi_delete');
        //Project Cost
        Route::resource('projectcosts', 'ProjectcostsController');
        Route::post('projectcosts/store', 'ProjectcostsController@store');
        Route::post('projectcosts/update/{id}', 'ProjectcostsController@update');
        Route::post('projectcosts/destroy/{id}', 'ProjectcostsController@destroy');
        Route::delete('projectcosts/destroy/all', 'ProjectcostsController@multi_delete');
        Route::get('projectcosts/addNew/{id}', 'ProjectcostsController@addnew');
        //Imports
        Route::resource('imports', 'ImportsController');
        Route::group(['prefix' => 'imports'], function () {
            Route::get('/', ['as' => 'admin.imports', 'uses' => 'ImportsController@search']);
            Route::get('/edit/{id}', ['as' => 'admin.imports.edit', 'uses' => 'ImportsController@edit']);
            Route::post('/update', ['as' => 'admin.imports.update', 'uses' => 'ImportsController@update']);
            Route::get('/create', ['as' => 'admin.imports.create', 'uses' => 'ImportsController@create']);
            Route::post('/store', ['as' => 'admin.imports.store', 'uses' => 'ImportsController@store']);
            Route::get('/destroy/{id}', ['as' => 'admin.imports.destroy', 'uses' => 'ImportsController@destroy']);
            Route::get('/export', ['as' => 'admin.imports.export', 'uses' => 'ImportsController@export']);
            Route::get('/show/{id}/{from_cur?}/{to_cur?}', 'ImportsController@show');
            Route::any('/ajax/deviceid/{id?}', 'ImportsController@deviceid')->name('importAjax');
            Route::any('/ajax/deviceidedit/{id?}', 'ImportsController@deviceidEdit')->name('importAjaxEdit');

            Route::post('/importtobill/', 'ImportsController@importToBill')->name('importtobill');
            //Route::get('/', 'ProjectsController@search');

        });
           Route::get('imports/egyptshow/{id}/{from_cur?}/{to_cur?}', 'ImportsController@showEgypt');


//        //Bills
//        Route::resource('imports', 'ImportsController');
//        Route::post('imports/store', 'ImportsController@store');
//        Route::post('imports/update/{id}', 'ImportsController@update');
//        Route::post('imports/destroy/{id}', 'ImportsController@destroy');
//        Route::delete('imports/destroy/all', 'ImportsController@multi_delete');
//        Route::get('imports/show/{id}/{from_cur?}/{to_cur?}', 'ImportsController@bill');
//        Route::get('imports/egyptshow/{id}/{from_cur?}/{to_cur?}', 'ImportsController@showEgypt');
//        Route::get('imports/show/', 'ImportsController@bill')->name('cur');
//        Route::post('imports/drive/{devices_id}','ImportsController@ajaxdrive');
//        Route::get('imports', 'ImportsController@search');
//
//        Route::post('/imports/savedraftTosave', ['as' => 'admin.imports.savedraftTosave', 'uses' => 'ImportsController@savedraftTosave']);
//
//        Route::get('exportbills', ['as' => 'admin.imports.exportbills', 'uses' => 'ImportsController@export']);
////Invoices Bills
//        Route::get('imports/getpdf/{id}', ['as' => 'admin.imports.getpdf', 'uses' => 'ImportsController@getPdf']);
//        Route::get('imports/createGetPdf/{id}', ['as' => 'admin.imports.createGetPdf', 'uses' => 'ImportsController@createGetPdf']);
//        Route::post('imports/stoneGetPdf/{id}', ['as' => 'admin.imports.stoneGetPdf', 'uses' => 'ImportsController@stoneGetPdf']);
//
//        Route::get('imports/editgetpdf/{id}', ['as' => 'admin.imports.editgetpdf', 'uses' => 'ImportsController@editgetPdf']);
//
//        Route::post('imports/updategetpdf/{id}', ['as' => 'admin.imports.updateGetPdf', 'uses' => 'ImportsController@updateGetPdf']);
//        Route::post('imports/destroypdf/{id}', ['as' => 'admin.imports.destroyPdf', 'uses' => 'ImportsController@destroyPdf']);
//

        //Imports Name
        Route::group(['prefix' => 'importnames'], function () {
            Route::get('/', ['as' => 'admin.importnames', 'uses' => 'ImportnamesController@search']);
            Route::get('/edit/{id}', ['as' => 'admin.importnames.edit', 'uses' => 'ImportnamesController@edit']);
            Route::post('/update', ['as' => 'admin.importnames.update', 'uses' => 'ImportnamesController@update']);
            Route::get('/create', ['as' => 'admin.importnames.create', 'uses' => 'ImportnamesController@create']);
            Route::post('/store', ['as' => 'admin.importnames.store', 'uses' => 'ImportnamesController@store']);
            Route::Post('/destroy/{id}', ['as' => 'admin.importnames.destroy', 'uses' => 'ImportnamesController@destroy']);
        });




            //shhiping token
            Route::group(['prefix' => 'Shipping_account'], function () {

                Route::get('/', ['as' => 'admin.Shipping_account.edit', 'uses' => 'Create_Account_Private@edit']);
                Route::post('/update', ['as' => 'admin.Shipping_account.update', 'uses' => 'Create_Account_Private@update']);

            });


        //Importexpenses Name
        Route::group(['prefix' => 'importexpenses'], function () {
            Route::get('/', ['as' => 'admin.importexpenses', 'uses' => 'ImportexpensesController@search']);
            Route::get('addNew/{id}', 'ImportexpensesController@addnew');

            Route::get('show/{import_id}', ['as' => 'admin.importexpenses.show', 'uses' => 'ImportexpensesController@show']);

            Route::get('/edit/{id}', ['as' => 'admin.importexpenses.edit', 'uses' => 'ImportexpensesController@edit']);
            Route::post('/update', ['as' => 'admin.importexpenses.update', 'uses' => 'ImportexpensesController@update']);
            Route::get('/create', ['as' => 'admin.importexpenses.create', 'uses' => 'ImportexpensesController@create']);
            Route::post('/store', ['as' => 'admin.importexpenses.store', 'uses' => 'ImportexpensesController@store']);
            Route::Post('/destroy/{id}', ['as' => 'admin.importexpenses.destroy', 'uses' => 'ImportexpensesController@destroy']);
        });
        //Imports Name
        Route::group(['prefix' => 'banktransfers'], function () {
            Route::get('/', ['as' => 'admin.banktransfers', 'uses' => 'BanktransfersController@search']);
            Route::get('/edit/{id}', ['as' => 'admin.banktransfers.edit', 'uses' => 'BanktransfersController@edit']);
            Route::post('/update', ['as' => 'admin.banktransfers.update', 'uses' => 'BanktransfersController@update']);
            Route::get('/create', ['as' => 'admin.banktransfers.create', 'uses' => 'BanktransfersController@create']);
            Route::post('/store', ['as' => 'admin.banktransfers.store', 'uses' => 'BanktransfersController@store']);
            Route::Post('/destroy/{id}', ['as' => 'admin.banktransfers.destroy', 'uses' => 'BanktransfersController@destroy']);
        });
        //Company Expenses Name

        Route::group(['prefix' => 'catcompanyexpenses'], function () {
            Route::get('/', ['as' => 'admin.catcompanyexpenses', 'uses' => 'CatcompanyexpensesController@index']);
            Route::get('/edit/{id}', ['as' => 'admin.catcompanyexpenses.edit', 'uses' => 'CatcompanyexpensesController@edit']);
            Route::post('/update', ['as' => 'admin.catcompanyexpenses.update', 'uses' => 'CatcompanyexpensesController@update']);
            Route::get('/create', ['as' => 'admin.catcompanyexpenses.create', 'uses' => 'CatcompanyexpensesController@create']);
            Route::post('/store', ['as' => 'admin.catcompanyexpenses.store', 'uses' => 'CatcompanyexpensesController@store']);
            Route::get('/export', ['as' => 'admin.catcompanyexpenses.export', 'uses' => 'CatcompanyexpensesController@export']);
        });
        Route::resource('catcompanyexpenses', 'CatcompanyexpensesController');

        //Company Expenses Name

        Route::group(['prefix' => 'companyexpenses'], function () {
            Route::get('/', ['as' => 'admin.companyexpenses', 'uses' => 'CompanyexpensesController@index']);
            Route::get('/edit/{id}', ['as' => 'admin.companyexpenses.edit', 'uses' => 'CompanyexpensesController@edit']);
            Route::post('/update', ['as' => 'admin.companyexpenses.update', 'uses' => 'CompanyexpensesController@update']);
            Route::get('/create', ['as' => 'admin.companyexpenses.create', 'uses' => 'CompanyexpensesController@create']);
            Route::post('/store', ['as' => 'admin.companyexpenses.store', 'uses' => 'CompanyexpensesController@store']);
            Route::get('/export', ['as' => 'admin.companyexpenses.export', 'uses' => 'CompanyexpensesController@export']);
            Route::get('/cat/{id}', ['as' => 'admin.companyexpenses', 'uses' => 'CompanyexpensesController@addnew']);
            Route::get('/cat/create/{id}', ['as' => 'admin.companyexpenses', 'uses' => 'CompanyexpensesController@createaddnew']);

        });
        Route::resource('companyexpenses', 'CompanyexpensesController');

        //taxes
        Route::get('taxes/search', 'TaxesController@search');
        Route::get('taxes', 'TaxesController@index');
        Route::get('TaxClearance', 'TaxesController@TaxClearance');
        //taxes PDF

//Start AddTaxNames
        Route::group(['prefix' => 'addtaxnames'], function () {
            Route::get('/', ['as' => 'admin.addtaxnames', 'uses' => 'AddtaxnamesController@search']);
            Route::get('{id}/edit/', ['as' => 'admin.addtaxnames.edit', 'uses' => 'AddtaxnamesController@edit']);
            Route::post('/update', ['as' => 'admin.addtaxnames.update', 'uses' => 'AddtaxnamesController@update']);
            Route::get('/create', ['as' => 'admin.addtaxnames.create', 'uses' => 'AddtaxnamesController@create']);
            Route::post('/store', ['as' => 'admin.addtaxnames.store', 'uses' => 'AddtaxnamesController@store']);

        });
        Route::resource('addtaxnames', 'AddtaxnamesController');

//End AddTaxNames

        //Strat Addtaxs
        Route::resource('addtaxs', 'AddtaxsController');
        Route::get('addtaxs/addNew/{id}', 'AddtaxsController@addnew');
        Route::post('addtaxs/store', 'AddtaxsController@store');
        Route::post('addtaxs/update/{id}', 'AddtaxsController@update');
        Route::post('addtaxs/destroy/{id}', 'AddtaxsController@destroy');
        Route::delete('addtaxs/destroy/all', 'AddtaxsController@multi_delete');
        Route::get('addtaxs', 'AddtaxsController@search');
//End Addtaxs

         //Moneyorders
            Route::resource('moneyorders', 'MoneyordersController');
            Route::post('moneyorders/store', 'MoneyordersController@store');
            Route::post('moneyorders/update/{id}', 'MoneyordersController@update');
            Route::post('moneyorders/destroy/{id}', 'MoneyordersController@destroy');
            Route::delete('moneyorders/destroy/all', 'MoneyordersController@multi_delete');
            Route::get('moneyorders', 'MoneyordersController@search');
            Route::get('moneyorders/moneyordersAjax/{id}', 'MoneyordersController@moneyordersAjax');
            Route::get('moneyorders/moneyordersClientAjax/{id}', 'MoneyordersController@moneyordersClientAjax')->name('moneyorders.Client');
            Route::get('moneyorders/moneyordersSuppliersAjax/{id}', 'MoneyordersController@moneyordersSuppliersAjax');
        //Moneyorders

        //Custodys
        Route::resource('custodys', 'CustodysController');
        Route::post('custodys/store', 'CustodysController@store');
        Route::post('custodys/update/{id}', 'CustodysController@update');

        Route::post('custodys/delivery/{id}', 'CustodysController@delivery')->name('custodys.delivery');

        Route::post('custodys/destroy/{id}', 'CustodysController@destroy');
        Route::delete('custodys/destroy/all', 'CustodysController@multi_delete');
        Route::get('custodys', 'CustodysController@search');
        //Custodys
        //Reports
        Route::resource('report', 'ReportsController');
        Route::get('report/items', 'ReportsController@items');
        Route::get('report/items/{id}', 'ReportsController@items');
        Route::get('report/store/{id}', 'ReportsController@store');
        
        Route::get('report/locker/{id}', 'ReportsController@locker');
        Route::get('report/revenu/{id}', 'ReportsController@revenu');

        Route::get('report/daily/{id}', 'ReportsController@daily');

        Route::get('/locker/monthly/{id}', 'ReportsController@lockermonthly');
        Route::get('/revenu/monthly/{id}', 'ReportsController@revenumonthly');
        

        Route::get('report/monthly/{id}', 'ReportsController@monthly');
        Route::get('report/monthlySearch', 'ReportsController@monthlySearch');
        


        //Reports


        //setting
        Route::get('settings', 'Settings@setting');
        Route::post('settings', 'Settings@setting_save');
        //settings/contact
        // Route::get('settings/contact', 'ContactController@contact');
        // Route::post('settings/contact', 'ContactController@contact_save');
        //settings/footer
        Route::get('settings/footer', 'FooterController@footer');
        Route::post('settings/footer', 'FooterController@footer_save');


        // //Front Contact
        // Route::resource('contacts', 'contactsController');
        // Route::get('contacts', 'contactsController@index');



            //Item_size
            Route::group(['prefix' => 'products_api'], function () {
                Route::get('/', ['as' => 'admin.products_api', 'uses' => 'product_apiController@search']);
                Route::get('/{id}/edit', ['as' => 'admin.products_api.edit', 'uses' => 'product_apiController@edit']);
                Route::put('/{id}', ['as' => 'admin.products_api.update', 'uses' => 'product_apiController@update']);
                Route::get('/create', ['as' => 'admin.products_api.create', 'uses' => 'product_apiController@create']);
                Route::post('/store', ['as' => 'admin.products_api.store', 'uses' => 'product_apiController@store']);
                Route::DELETE('/destroy/{id}', ['as' => 'admin.products_api.destroy', 'uses' => 'product_apiController@destroy']);
            });
            //Item_color
            Route::group(['prefix' => 'Item_color_api'], function () {
                Route::get('/', ['as' => 'admin.Item_color_api', 'uses' => 'Item_color_apiController@search']);
                Route::get('/{id}/edit', ['as' => 'admin.Item_color_api.edit', 'uses' => 'Item_color_apiController@edit']);
                Route::put('/{id}', ['as' => 'admin.Item_color_api.update', 'uses' => 'Item_color_apiController@update']);
                Route::get('/create', ['as' => 'admin.Item_color_api.create', 'uses' => 'Item_color_apiController@create']);
                Route::post('/store', ['as' => 'admin.Item_color_api.store', 'uses' => 'Item_color_apiController@store']);
                Route::DELETE('/destroy/{id}', ['as' => 'admin.Item_color_api.destroy', 'uses' => 'Item_color_apiController@destroy']);
            });

            //Item_size
            Route::group(['prefix' => 'Item_size_api'], function () {
                Route::get('/', ['as' => 'admin.Item_size_api', 'uses' => 'Item_Size_apiController@search']);
                Route::get('/{id}/edit', ['as' => 'admin.Item_size_api.edit', 'uses' => 'Item_Size_apiController@edit']);
                Route::put('/{id}', ['as' => 'admin.Item_size_api.update', 'uses' => 'Item_Size_apiController@update']);
                Route::get('/create', ['as' => 'admin.Item_size_api.create', 'uses' => 'Item_Size_apiController@create']);
                Route::post('/store', ['as' => 'admin.Item_size_api.store', 'uses' => 'Item_Size_apiController@store']);
                Route::DELETE('/destroy/{id}', ['as' => 'admin.Item_size_api.destroy', 'uses' => 'Item_Size_apiController@destroy']);
            });
        Route::any('logout', 'AdminAuthController@logout');
    });
    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang')?session()->forget('lang'):'';
        $lang == 'ar'?session()->put('lang', 'ar'):session()->put('lang', 'en');
        return back();
    });
});
Route::get('/offers/{offer}','Controller@product');
Route::get('/offers/user/{id}', 'Controller@userrequests');
Route::get('request/changestatus/{id}', ['as' => 'request.changestatus', 'uses' => 'OffersController@changestatues']);
Route::get('user/request/changestatus/{id}','Controller@userchangestatues')->name('requests.changestatus');
Route::get('offer/user/requests/id/{id}', 'Controller@showreq')->name('usershowReq');
Route::post('/api/login','Controller@nawareslogin')->name('api.getinv');
Route::get('/api/pricelist','Controller@getPricelist');
Route::get('/api/getarea/{id}','Controller@getArea');
Route::get('/api/sumshipping','Controller@sumShipping');
Route::get('/api/ship_stat','Controller@shipping_status')->name('api.shipping');
Route::post('/api/invoices','Controller@storeall')->name('api.submit');;

Route::get('/api/pickup','Controller@pickups');
Route::any('/api/ajax/getarea/{id?}', 'Controller@getArea')->name('api.area');
Route::get('/offers','Controller@offer');
Route::post('/offers/{offer}','Controller@req');
Route::post('/requests','Controller@storeReq');
//Route::post('/login','Controller@sign');
Route::post('/login','Controller@sign2')->name('users.login');
Route::post('/register','Controller@register')->name('users.register');
Route::get('/changestatus/{id}/{offerid}', ['as' => 'request.changestatus1', 'uses' => 'Controller@changestatus']);

//new
Route::get('/api/ajaxAreas/{branch_id}','Controller@ajaxAreas');
Route::get('/api/invoices/{inv_id}','Controller@apiinvoices');
Route::get('/api/allinvoices/','Controller@allinvoices');
Route::get('/api/allbills/','Controller@allbills');
Route::get('/api/confirm/{id}','Controller@confirmbill');

