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
| Provinces Routes
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

/*
|--------------------------------------------------------------------------
| Stakeholder Roles Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'stakeholder-roles',
    'as'         => 'stakeholder-roles.',
    'controller' => StakeholderRoleController::class
], function () {
    Route::get('list',                 'index'  )->name('index'  );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'  );
    Route::get('edit/{id}',            'edit'   )->name('edit'   );
    Route::get('show/{id}',            'show'   )->name('show'   );
    Route::patch('update/{role}',      'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Site Type Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'site-types',
    'as'         => 'site-types.',
    'controller' => SiteTypeController::class
], function () {
    Route::get('list',                 'index'  )->name('index'  );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'  );
    Route::get('edit/{id}',            'edit'   )->name('edit'   );
    Route::get('show/{id}',            'show'   )->name('show'   );
    Route::patch('update/{siteType}',  'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Activity Progress Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'activity-progresses',
    'as'         => 'activity-progresses.',
    'controller' => ActivityProgressController::class
], function () {
    Route::get('list',                 'index'  )->name('index'  );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'  );
    Route::get('edit/{id}',            'edit'   )->name('edit'   );
    Route::get('show/{id}',            'show'   )->name('show'   );
    Route::patch('update/{progress}',  'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
});