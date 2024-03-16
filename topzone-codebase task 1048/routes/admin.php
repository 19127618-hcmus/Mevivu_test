<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Admin\Http\Controllers\Home\HomeController::class, 'index']);

// login
Route::controller(App\Admin\Http\Controllers\Auth\LoginController::class)
->middleware('guest:admin')
->prefix('/login')
->as('login.')
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/', 'login')->name('post');
});

Route::group(['middleware' => 'auth.admin:admin'], function(){
    
    //user
    Route::prefix('/manager-user')->as('user.')->group(function(){
        Route::controller(App\Admin\Http\Controllers\User\UserController::class)->group(function(){
            Route::get('/them', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');
            Route::put('/sua', 'update')->name('update');
            Route::post('/them', 'store')->name('store');
            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
        Route::get('/select-search', [AdminSearchController::class, 'selectSearch'])->name('selectsearch');
    });
    //admin
    Route::prefix('/manager-admin')->as('admin.')->group(function(){
        Route::controller(App\Admin\Http\Controllers\Admin\AdminController::class)->group(function(){
            Route::get('/them', 'create')->name('create');
            Route::get('/', 'index')->name('index');
            Route::get('/sua/{id}', 'edit')->name('edit');
            Route::put('/sua', 'update')->name('update');
            Route::post('/them', 'store')->name('store');
            Route::delete('/xoa/{id}', 'delete')->name('delete');
        });
        Route::get('/select-search', [AdminSearchController::class, 'selectSearch'])->name('selectsearch');
    });

    //ckfinder
    Route::prefix('/quan-ly-file')->as('ckfinder.')->group(function(){
        Route::any('/ket-noi', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
        ->name('connector');
        Route::any('/duyet', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
        ->name('browser');
    });
    Route::get('/dashboard', [App\Admin\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');

    //auth
    Route::controller(App\Admin\Http\Controllers\Auth\ProfileController::class)
    ->prefix('/profile')
    ->as('profile.')
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });

    Route::controller(App\Admin\Http\Controllers\Auth\ChangePasswordController::class)
    ->prefix('/password')
    ->as('password.')
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::put('/', 'update')->name('update');
    });
    Route::post('/logout', [App\Admin\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout');
});