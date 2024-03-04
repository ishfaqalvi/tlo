<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Project Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'projects.', 'controller' => ProjectController::class], function () {
    Route::get('list',                 'index'  )->name('index'  );
    Route::post('list',                'index'  )->name('filter' );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'  );
    Route::get('edit/{id}',            'edit'   )->name('edit'   );
    Route::get('show/{id}',            'show'   )->name('show'   );
    Route::patch('update/{project}',   'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
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
    Route::get('list/{id}',            'index'      )->name('index'      );
    Route::post('store',               'store'      )->name('store'      );
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
    Route::get('list/{id}',         'index'  )->name('index'  );
    Route::post('store',            'store'  )->name('store'  );
    Route::post('update',           'update' )->name('update' );
    Route::delete('delete/{id}',    'destroy')->name('destroy');
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
    Route::get('list/{id}',         'index'      )->name('index'      );
    Route::post('store',            'store'      )->name('store'	  );
    Route::delete('delete/{id}',    'destroy'    )->name('destroy'    );
    Route::post('check_record',     'checkRecord')->name('checkRecord');
});

/*
|--------------------------------------------------------------------------
| Project Files Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'files',
    'as'        => 'projects.files.',
    'controller'=> FileController::class
], function () {
    Route::get('list/{id}',         'index'  )->name('index'  );
    Route::post('store',            'store'  )->name('store'  );
    Route::post('update',           'update' )->name('update' );
    Route::delete('delete/{id}',    'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Project Disaggregation Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'disaggregation',
    'as'        => 'projects.disaggregation.',
    'controller'=> DisaggregationController::class
], function () {
    Route::get('list/{id}',         'index'  )->name('index'  );
    Route::post('store',            'store'  )->name('store'  );
    Route::post('update',           'update' )->name('update' );
    Route::delete('delete/{id}',    'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Project Team Member Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'team-members',
    'as'        => 'projects.team-members.',
    'controller'=> TeamMemberController::class
], function () {
    Route::get('list/{id}',         'index'      )->name('index'      );
    Route::post('store',            'store'      )->name('store'      );
    Route::delete('delete/{id}',    'destroy'    )->name('destroy'    );
    Route::post('check_record',     'checkRecord')->name('checkRecord');
});

/*
|--------------------------------------------------------------------------
| Project Reporting Periods Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'reporting-periods',
    'as'        => 'projects.reporting-periods.',
    'controller'=> ReportingPeriodController::class
], function () {
    Route::get('list/{id}',             'index'       )->name('index'        );
    Route::post('store',                'store'       )->name('store'        );
    Route::post('update',               'update'      )->name('update'       );
    Route::delete('delete/{id}',        'destroy'     )->name('destroy'      );
    Route::post('range/store',          'storeRange'  )->name('range.store'  );
    Route::post('range/update',         'updateRange' )->name('range.update' );
    Route::delete('range/delete/{id}',  'destroyRange')->name('range.destroy');
});

/*
|--------------------------------------------------------------------------
| Project Budget Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'    => 'budgets',
    'as'        => 'projects.budget.',
    'controller'=> BudgetController::class
], function () {
    Route::get('list/{id}',   'index')->name('index');
});