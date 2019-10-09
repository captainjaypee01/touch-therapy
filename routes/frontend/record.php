<?php

use App\Http\Controllers\Frontend\Record\ServiceListController;
use App\Http\Controllers\Frontend\Record\PackageListController;

Route::group([ 
    'as' => 'record.',
], function () {
 
    // Services List Routes
    Route::group([
        'prefix' => 'services',
        'as' => 'service.', 
    ], function () {
    
        Route::get('/', [ServiceListController::class, 'index'])->name('index');  

        Route::group(['prefix' => '{service}'], function () {
            Route::get('/', [ServiceListController::class, 'show'])->name('show'); 
            Route::post('/reserve', [ServiceListController::class, 'reserve'])->name('reserve'); 
        });
    });

    // Packages List Routes
    Route::group([
        'prefix' => 'package',
        'as' => 'package.', 
    ], function () {
    
        Route::get('/', [PackageListController::class, 'index'])->name('index');  

        Route::group(['prefix' => '{package}'], function () {
            Route::get('/', [PackageListController::class, 'show'])->name('show'); 
            Route::post('/reserve', [PackageListController::class, 'reserve'])->name('reserve'); 
        });
    });
});