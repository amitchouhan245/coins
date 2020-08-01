<?php

use Illuminate\Http\Request;

Route::group(['middleware' => ['api']], function() {

	Route::group(['namespace' => 'Api\Common'], function() {

		Route::get('base-url', 'ContentController@baseUrl');
		Route::post('register', 'AuthController@register');
		Route::get('login', 'AuthController@login');
		Route::post('forgot-password', 'AuthController@forgotPassword');
		Route::post('reset-password', 'AuthController@resetPassword');
		Route::get('app-info', 'ContentController@appInfo');
			
		// AFTER VALID TOKEN
		Route::group(['middleware' => ['check_token']], function() {
			
			Route::any('resend-code', 'AuthController@resendCode');		
			Route::post('verify', 'AuthController@verify');
			Route::post('change-password', 'AuthController@changePassword');
			Route::post('user/{id}', 'UserController@update');
			Route::any('logout', 'AuthController@logout');
			Route::apiResource('user', 'UserController')->only(['index','update']);
			Route::post('upload-profile-image', 'UserController@uploadProfileImage');
			
    	});		
    });

	Route::group(['namespace' => 'Api'], function() {

		Route::group(['middleware' => ['cors']], function() {

			Route::get('resend-otp', 'Common\AuthController@ResendOtp');
			Route::any('send-otp', 'Common\AuthController@sendOtp');		
			Route::get('web-login', 'Common\AuthController@WebLogin');
			Route::post('web-register','Common\AuthController@WebRegister');
			Route::get('category-list','enquiryController@CategoryList');
			Route::get('category-detail/{id}','enquiryController@CategoryDetail');
			Route::get('faqs','enquiryController@Faqs');
			Route::get('contents','enquiryController@Contents');
			Route::get('category-documents/{id}','enquiryController@categoryDocuments');
			Route::get('banner-images','enquiryController@bannerImages');

		});
	});
});
