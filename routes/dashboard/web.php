<?php

use Illuminate\Support\Facades\Route;

Route::group( ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group( function() {
            Route::get('index', function() {
                return view('dashboard.index');
            })->name('index');

            //User Routes
            Route::resource('users', 'UserController')->except(['show']);
        });
});

