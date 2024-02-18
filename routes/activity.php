<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Activity Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'activities.', 'controller' => ActivityController::class], function () {
    Route::post('store',                'store'      )->name('store'  );
    Route::get('list',                  'index'      )->name('index'  );
    Route::get('create',                'create'     )->name('create' );
    Route::get('edit/{id}',             'edit'       )->name('edit'   );
    Route::get('show/{id}',             'show'       )->name('show'   );
    Route::patch('update/{activity}',   'update'     )->name('update' );
    Route::delete('delete/{id}',        'destroy'    )->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Activity Budget Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'budget',
    'as'         => 'activities.budget.',
    'controller' => BudgetController::class
], function () {
    Route::get('list/{id}',           'index'  )->name('index'  );
    Route::post('store',              'store'  )->name('store'  );
    Route::post('update',             'update' )->name('update' );
    Route::delete('delete/{id}',      'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Activity Fiels Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'files',
    'as'         => 'activities.files.',
    'controller' => FileController::class
], function () {
    Route::get('list/{id}',           'index'  )->name('index'  );
    Route::post('store',              'store'  )->name('store'  );
    Route::post('update',             'update' )->name('update' );
    Route::delete('delete/{id}',      'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Activity Sites Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'sites',
    'as'        => 'activities.sites.',
    'controller'=> SiteController::class
], function () {
    Route::get('list/{id}',            'index'      )->name('index'      );
    Route::post('store',               'store'      )->name('store'      );
    Route::delete('delete/{id}',       'destroy'    )->name('destroy'    );
    Route::post('check_record',        'checkRecord')->name('checkRecord');
});

/*
|--------------------------------------------------------------------------
| Activity Stakeholder Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'stakeholder',
    'as'        => 'activities.stakeholder.',
    'controller'=> StakeholderController::class
], function () {
    Route::get('list/{id}',         'index'      )->name('index'      );
    Route::post('store',            'store'      )->name('store'      );
    Route::delete('delete/{id}',    'destroy'    )->name('destroy'    );
    Route::post('check_record',     'checkRecord')->name('checkRecord');
});

/*
|--------------------------------------------------------------------------
| Activity Indicators Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'indicators',
    'as'         => 'activities.indicators.',
    'controller' => IndicatorController::class
], function () {
    Route::get('list/{id}',           'index'  )->name('index'  );
    Route::post('store',              'store'  )->name('store'  );
    Route::delete('delete/{id}',      'destroy')->name('destroy');
});