<?php

use App\Http\Controllers\Web\Admin\AuthController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\IdentitasWebController;
use App\Http\Controllers\Web\Admin\UserController;
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
    // Wait user template
    return redirect()->route('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/my-profile', [UserController::class, 'myProfile'])->name('myProfile');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::middleware('is_super_admin')->group(function () {
            Route::prefix('identitas-web')->group(function () {
                Route::get('/', [IdentitasWebController::class, 'create'])->name('identitasWeb');
                Route::post('/store', [IdentitasWebController::class, 'store'])->name('identitasWebStore');
            });
        });
        Route::middleware('is_admin')->group(function () {
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('users');
                Route::post('/datagrid', [UserController::class, 'datagrid'])->name('usersDatagrid');
                Route::post('/create', [UserController::class, 'create'])->name('usersCreate');
                Route::post('/store', [UserController::class, 'store'])->name('usersStore');
                Route::post('/destroy', [UserController::class, 'destroy'])->name('usersDestroy');
                Route::post('/change-status', [UserController::class, 'changeStatus'])->name('changeStatusUsers');
            });
        });
        Route::middleware('is_partner')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
    });
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
});
