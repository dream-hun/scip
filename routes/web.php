<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CooperativeController;
use App\Http\Controllers\Admin\FarmerController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function (): void {

    Route::resource('permissions', PermissionsController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('cooperatives', CooperativeController::class);
    Route::resource('farmers', FarmerController::class);
});
