<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Indicator Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'indicators.', 'controller' => IndicatorController::class], function () {
    Route::get('list',                  'index'      )->name('index'  );
    Route::get('create',                'create'     )->name('create' );
    Route::post('store',                'store'      )->name('store'  );
    Route::get('edit/{id}',             'edit'       )->name('edit'   );
    Route::get('show/{id}',             'show'       )->name('show'   );
    Route::patch('update/{indicator}',  'update'     )->name('update' );
    Route::delete('delete/{id}',        'destroy'    )->name('destroy');
});


/*
|--------------------------------------------------------------------------
| Activity Routes
|--------------------------------------------------------------------------
*/
// Route::group([
//     'prefix'     => 'indicators',
//     'as'         => 'indicators.',
//     'controller' => IndicatorController::class
// ], function () {
//     Route::get('list',                  'index'      )->name('index'  );
//     Route::get('create',                'create'     )->name('create' );
//     Route::post('store',                'store'      )->name('store'  );
//     Route::get('edit/{id}',             'edit'       )->name('edit'   );
//     Route::get('show/{id}',             'show'       )->name('show'   );
//     Route::patch('update/{indicator}',  'update'     )->name('update' );
//     Route::delete('delete/{id}',        'destroy'    )->name('destroy');
//     Route::get('get-dropdowns',         'getDropdown');
// });