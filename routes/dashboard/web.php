<?php

use Illuminate\Support\Facades\Route;

Route::group( ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group( function() {

            //dashboard Route
            Route::get('/', 'WelcomeController@index')->name('welcome');


            //Categories Routes
            Route::resource('categories', 'CategoryController')->except(['show']);


            //products Routes
            Route::resource('products', 'ProductController')->except(['show']);


            //clients Routes
            Route::resource('clients', 'ClientController')->except(['show']);
            Route::resource('clients.orders', 'Client\OrderController')->except(['show']);


            //User Routes
            Route::resource('users', 'UserController')->except(['show']);


        });
});

