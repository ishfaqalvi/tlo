<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Indicator Routes
|--------------------------------------------------------------------------
*/
Route::group(['as' => 'indicators.', 'controller' => IndicatorController::class], function () {
    Route::get('list',                  'index'      )->name('index'     );
    Route::get('create',                'create'     )->name('create'    );
    Route::post('store',                'store'      )->name('store'     );
    Route::get('edit/{id}',             'edit'       )->name('edit'      );
    Route::get('show/{id}',             'show'       )->name('show'      );
    Route::patch('update/{indicator}',  'update'     )->name('update'    );
    Route::delete('delete/{id}',        'destroy'    )->name('destroy'   );
    Route::post('set-project',          'setProject' )->name('setProject');
});

/*
|--------------------------------------------------------------------------
| Targets Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'targets',
    'as'         => 'indicators.targets.',
    'controller' => TargetController::class
], function () {
    Route::get('list/{id}',                     'index'                 )->name('index'                 );
    Route::post('report/store',                 'reportStore'           )->name('report.store'          );
    Route::delete('report/delete/{id}',         'reportDestroy'         )->name('report.destroy'        );
    Route::post('disaggregation/store',         'disaggregationStore'   )->name('disaggregation.store'  );
    Route::delete('disaggregation/delete/{id}', 'disaggregationDestroy' )->name('disaggregation.destroy');
});

/*
|--------------------------------------------------------------------------
| Data Collections Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'data-collections',
    'as'         => 'indicators.data-collections.',
    'controller' => DataCollectionController::class
], function () {
    Route::get('list/{id}',             'index'     )->name('index'     );
    Route::post('store',                'store'     )->name('store'     );
    Route::post('update',               'update'    )->name('update'    );
    Route::delete('delete/{id}',        'destroy'   )->name('destroy'   );
    Route::post('check_limit',          'checkLimit')->name('checklimit');
});

/*
|--------------------------------------------------------------------------
| Data Collections Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'contributions',
    'as'         => 'indicators.contributions.',
    'controller' => ContributionController::class
], function () {
    Route::get('list/{id}',             'index'      )->name('index'      );
    Route::post('store',                'store'      )->name('store'      );
    Route::delete('delete/{id}',        'destroy'    )->name('destroy'    );
    Route::post('check_record',         'checkRecord')->name('checkRecord');
});