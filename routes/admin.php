<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('dashboard', DashboardController::class)->name('dashboard');

/*
|--------------------------------------------------------------------------
| Projects Route
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'projects',
    'as'         => 'projects.',
    'controller' => ProjectController::class
], function () {
    Route::get('list',                 'index'  )->name('index'	 );
    Route::get('create',               'create' )->name('create' );
    Route::post('store',               'store'  )->name('store'	 );
    Route::get('edit/{id}',            'edit'   )->name('edit'	 );
    Route::get('show/{id}',            'show'   )->name('show'	 );
    Route::patch('update/{project}',   'update' )->name('update' );
    Route::delete('delete/{id}',       'destroy')->name('destroy');
    Route::post('stakeholder/store',        'stakeholderStore'  )->name('stakeholder.store'	 );
    Route::delete('stakeholder/delete/{id}','stakeholderDestroy')->name('stakeholder.destroy');
});

/*
|--------------------------------------------------------------------------
| Stakeholders Route
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'stakeholders',
    'as'         => 'stakeholders.',
    'controller' => StakeholderController::class
], function () {
    Route::get('list',                  'index'  )->name('index'  );
    Route::get('create',                'create' )->name('create' );
    Route::post('store',                'store'  )->name('store'  );
    Route::get('edit/{id}',             'edit'   )->name('edit'	  );
    Route::get('show/{id}',             'show'   )->name('show'	  );
    Route::patch('update/{stakeholder}','update' )->name('update' );
    Route::delete('delete/{id}',        'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Config Route
|--------------------------------------------------------------------------
*/
Route::prefix('/catalog')->namespace('\App\Http\Controllers\Admin\Catalog')->group(__DIR__.'/catalog.php');

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/
Route::controller(RoleController::class)->prefix('roles')->as('roles.')->group(function () {
	Route::get('list',				'index'			)->name('index'		   );
	Route::get('create',			'create'		)->name('create'	   );
	Route::post('store',			'store'			)->name('store'		   );
	Route::get('edit/{id}',			'edit'			)->name('edit'		   );
	Route::get('show/{id}',			'show'			)->name('show'		   );
	Route::patch('update/{role}',	'update'		)->name('update'	   );
	Route::delete('delete/{id}',	'destroy'		)->name('destroy'	   );
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
	Route::get('list',				'index'			)->name('index'		   );
	Route::get('create',			'create'		)->name('create'	   );
	Route::post('store',			'store'			)->name('store'		   );
	Route::get('edit/{id}',			'edit'			)->name('edit'		   );
	Route::get('show/{id}',			'show'			)->name('show'		   );
	Route::patch('update/{user}',	'update'		)->name('update'	   );
	Route::delete('delete/{id}',	'destroy'		)->name('destroy'	   );
	Route::get('profile', 		 	'profileEdit'	)->name('profileEdit'  );
    Route::post('profile',		 	'profileUpdate'	)->name('profileUpdate');
    Route::post('check_email', 	 	'checkEmail'	)->name('checkEmail'   );
    Route::post('check_password',	'checkPassword'	)->name('checkPassword');
});

/*
|--------------------------------------------------------------------------
| Notifications Routes
|--------------------------------------------------------------------------
*/
Route::controller(NotificationController::class)->prefix('notifications')->as('notifications.')->group(function () {
	Route::get('index', 		  	'index'  )->name('index'  );
	Route::get('show/{id}', 		'show'   )->name('show'	  );
	Route::delete('destroy/{id}', 	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Audit Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuditController::class)->prefix('audits')->as('audits.')->group(function () {
	Route::get('index', 		 	'index'	 )->name('index'  );
	Route::get('show/{id}', 	 	'show'	 )->name('show'	  );
	Route::delete('destroy/{id}',	'destroy')->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::controller(SettingController::class)->prefix('settings')->as('settings.')->group(function () {
	Route::get('index', 		'index'		)->name('index'		  );
	Route::get('clear-cache', 	'clearCache')->name('clear-cache' );
	Route::post('save', 		'save'		)->name('save'		  );
});

/*
|--------------------------------------------------------------------------
| Error Log Route
|--------------------------------------------------------------------------
*/
Route::get('logs',
	[\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']
)->name('logs');
