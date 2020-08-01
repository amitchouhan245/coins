<?php

Route::group(['namespace' => 'Admin'], function() {

    // \Artisan::call('optimize');

$typeExp = 'admin';

    Route::get('admin/', 'AdminController@login');
    Route::get('admin/login', 'AdminController@login');
    Route::any('admin/forgot-password','AdminController@forgotPassword');
    Route::any('admin/reset-password','AdminController@resetPassword');
	Route::any('admin/set-session', 'AdminController@setSession');

    //after login url
    Route::group(['middleware' => 'CheckAdminLogin'], function () {

        Route::get('admin/dashboard', 'AdminController@dashboard')->name('home');
	    Route::get('admin/profile','AdminController@profile');
	    Route::get('admin/change-password','AdminController@changePassword');
        Route::get('admin/logout','AdminController@logout');

        Route::any('admin/profile/{id}','AdminController@updateProfile');
        
        Route::resources([

            'admin/users'        => 'UserController',
            'admin/contents'     => 'ContentController',
            'admin/countries'    => 'CountryController',
            'admin/states'       => 'StateController',
            'admin/cities'       => 'CityController',
        ]);

        Route::get('admin/drivers','UserController@driversList');

        Route::get('admin/add-driver/{id?}','UserController@addDriver');

        #App Info
        Route::get('admin/app-info','AppInfoController@appInfo');
        Route::post('admin/update-app-info','AppInfoController@addUpdateAppInfo');

        #Dashboard

        Route::any('admin/enquiry-detail-dashboard','ContentController@enquiryDashboad');
        
        
        Route::any('admin/upload-image/{id}','UserController@uploadUserImage');
        Route::any('admin/update-status','ActivityController@updateStatus');
        Route::any('admin/delete-record','ActivityController@deleteRecord');
        Route::any('admin/restore-record','ActivityController@restoreRecord'); 

        Route::any('admin/bulk-delete-record','ActivityController@bulkdeleteRecord');

        #BannerImage

        Route::get('admin/banner-images','ContentController@BannerImages');
        Route::get('admin/add-banner','ContentController@AddBanner');
        Route::get('admin/edit-banner/{id}','ContentController@UpdateBanner');
        Route::post('admin/add-update-image','ContentController@StoreUpdateBanner');
        
        #Lists

        Route::get('admin/states-list','StateController@allStates');
        Route::get('admin/cities-list','CityController@allCities');
        
    });
});



