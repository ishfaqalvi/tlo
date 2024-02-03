<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Project Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'projects.', 'controller' => ProjectController::class], function () {
    Route::get('list',                 'index'  )->name('index'  );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'  );
    Route::get('edit/{id}',            'edit'   )->name('edit'   );
    Route::get('show/{id}',            'show'   )->name('show'   );
    Route::patch('update/{project}',   'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Project Stakeholder Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'stakeholder',
    'as'        => 'projects.stakeholder.',
    'controller'=> StakeholderController::class
], function () {
    Route::post('store',               'store'      )->name('store'	     );
    Route::delete('delete/{id}',       'destroy'    )->name('destroy'    );
    Route::post('check_record',        'checkRecord')->name('checkRecord');
});

/*
|--------------------------------------------------------------------------
| Project Phase Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'phase',
    'as'        => 'projects.phase.',
    'controller'=> PhaseController::class
], function () {
    Route::post('store',            'store'  )->name('store'  );
    Route::post('update',           'update' )->name('update' );
    Route::delete('delete/{id}',    'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Project Sites Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'sites',
    'as'        => 'projects.sites.',
    'controller'=> SiteController::class
], function () {
    Route::post('store',               'store'      )->name('store'      );
    Route::delete('delete/{id}',       'destroy'    )->name('destroy'    );
    Route::post('check_record',        'checkRecord')->name('checkRecord');
});

/*
|--------------------------------------------------------------------------
| Project Activity Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'activities',
    'as'        => 'projects.activities.',
    'controller'=> ActivityController::class
], function () {
    Route::post('store',            'store'  )->name('store'  );
    Route::post('update',           'update' )->name('update' );
    Route::delete('delete/{id}',    'destroy')->name('destroy');
});