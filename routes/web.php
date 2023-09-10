<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backoffice\BackofficeController;
use App\Http\Controllers\GitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('backoffice')
    ->group(function() {
        Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
        Route::post('/do-login', [AuthController::class, 'doLogin'])->name('do-login')->middleware('guest');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

        Route::get('/dashboard', [BackofficeController::class, 'index'])->name('dashboard')->middleware('auth');
        Route::get('/roles', [BackofficeController::class, 'roles'])->name('roles')->middleware('auth');
        Route::get('/permissions', [BackofficeController::class, 'permissions'])->name('permissions')->middleware('auth');
        Route::get('/users', [BackofficeController::class, 'users'])->name('users')->middleware('auth');
        Route::get('/deleted-users', [BackofficeController::class, 'deletedUsers'])->name('deleted-users')->middleware('auth');
        Route::get('/repositories', [GitController::class, 'getRepositories'])->name('repositories')->middleware('auth');

        Route::post('/create-user', [BackofficeController::class, 'createUser'])->name('create-user')->middleware('auth');
        Route::get('/edit-user/{id}', [BackofficeController::class, 'editUser'])->name('edit-user')->middleware('auth');
        Route::post('/update-user', [BackofficeController::class, 'updateUser'])->name('update-user')->middleware('auth');
        Route::get('/delete-user/{id}', [BackofficeController::class, 'deleteUser'])->name('delete-user')->middleware('auth');

        Route::post('/create-role', [BackofficeController::class, 'createRole'])->name('create-role')->middleware('auth');
        Route::get('/edit-role/{id}', [BackofficeController::class, 'editRole'])->name('edit-role')->middleware('auth');
        Route::post('/update-role', [BackofficeController::class, 'updateRole'])->name('update-role')->middleware('auth');
        Route::get('/delete-role/{id}', [BackofficeController::class, 'deleteRole'])->name('delete-role')->middleware('auth');

        Route::get('/manage-permission/{id}', [BackofficeController::class, 'managePermission'])->name('manage-permission')->middleware('auth');
        Route::post('/store-manage-permission', [BackofficeController::class, 'storeManagedPermission'])->name('store-permission')->middleware('auth');
    });
