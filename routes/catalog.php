<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'categories',
    'as'         => 'categories.',
    'controller' => CategoryController::class
], function () {
    Route::get('list',                 'index'  )->name('index'	 );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'	 );
    Route::get('edit/{id}',            'edit'   )->name('edit'	 );
    Route::get('show/{id}',            'show'   )->name('show'	 );
    Route::patch('update/{category}',  'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'provinces',
    'as'         => 'provinces.',
    'controller' => ProvinceController::class
], function () {
    Route::get('list',                 'index'  )->name('index'  );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'  );
    Route::get('edit/{id}',            'edit'   )->name('edit'   );
    Route::get('show/{id}',            'show'   )->name('show'   );
    Route::patch('update/{province}',  'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
});