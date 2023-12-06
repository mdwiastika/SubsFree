<?php

use App\Http\Controllers\OtherController;
use App\Http\Controllers\Web\Admin\AuthController;
use App\Http\Controllers\Web\Admin\CategoryRoomController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\IdentitasWebController;
use App\Http\Controllers\Web\Admin\RoomController;
use App\Http\Controllers\Web\Admin\TransactionRoomController;
use App\Http\Controllers\Web\Admin\TransactionSubscriptionController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\User\AboutController;
use App\Http\Controllers\Web\User\HistoryTransactionController;
use App\Http\Controllers\Web\User\HomeController;
use App\Http\Controllers\Web\User\RoomController as UserRoomController;
use App\Http\Controllers\Web\User\SubscriptionUserController;
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

Route::get('/', [HomeController::class, 'main'])->name('home');
Route::get('/about', [AboutController::class, 'main'])->name('userAbout');
Route::get('/rooms', [UserRoomController::class, 'main'])->name('userRooms');
Route::get('/rooms/{slug_room}', [UserRoomController::class, 'detail'])->name('userRoomDetail');
Route::get('/admin', function () {
    // Wait user template
    return redirect()->route('dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/subscription', [SubscriptionUserController::class, 'main'])->name('userSubscriptionUser');
    Route::get('/subscription/payment', [SubscriptionUserController::class, 'createPayment'])->name('createPaymentSubscription');
    Route::post('/subscription/callback', [SubscriptionUserController::class, 'callbackPayment']);
    Route::get('/history-transactions', [HistoryTransactionController::class, 'main'])->name('historyTransaction');
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
            Route::prefix('category-room')->group(function () {
                Route::get('/', [CategoryRoomController::class, 'index'])->name('categoryRoom');
                Route::post('/datagrid', [CategoryRoomController::class, 'datagrid'])->name('categoryRoomDatagrid');
                Route::post('/create', [CategoryRoomController::class, 'create'])->name('categoryRoomCreate');
                Route::post('/store', [CategoryRoomController::class, 'store'])->name('categoryRoomStore');
                Route::post('/destroy', [CategoryRoomController::class, 'destroy'])->name('categoryRoomDestroy');
            });
            Route::prefix('transaction-subscription')->group(function () {
                Route::get('/', [TransactionSubscriptionController::class, 'index'])->name('transactionSubscription');
                Route::post('/datagrid', [TransactionSubscriptionController::class, 'datagrid'])->name('transactionSubscriptionDatagrid');
                Route::post('/create', [TransactionSubscriptionController::class, 'create'])->name('transactionSubscriptionCreate');
                Route::post('/store', [TransactionSubscriptionController::class, 'store'])->name('transactionSubscriptionStore');
                Route::post('/destroy', [TransactionSubscriptionController::class, 'destroy'])->name('transactionSubscriptionDestroy');
            });
            Route::prefix('other')->group(function () {
                Route::get('/cariUser', [OtherController::class, 'cariUser'])->name('otherCariUser');
                Route::get('/cariCategoryRoom', [OtherController::class, 'cariCategoryRoom'])->name('otherCariCategoryRoom');
                Route::get('/cariRoom', [OtherController::class, 'cariRoom'])->name('otherCariRoom');
            });
        });
        Route::middleware('is_partner')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::prefix('transaction-room')->group(function () {
                Route::get('/', [TransactionRoomController::class, 'index'])->name('transactionRoom');
                Route::post('/datagrid', [TransactionRoomController::class, 'datagrid'])->name('transactionRoomDatagrid');
                Route::post('/create', [TransactionRoomController::class, 'create'])->name('transactionRoomCreate');
                Route::post('/store', [TransactionRoomController::class, 'store'])->name('transactionRoomStore');
                Route::post('/destroy', [TransactionRoomController::class, 'destroy'])->name('transactionRoomDestroy');
            });
            Route::prefix('room')->group(function () {
                Route::get('/', [RoomController::class, 'index'])->name('room');
                Route::post('/datagrid', [RoomController::class, 'datagrid'])->name('roomDatagrid');
                Route::post('/create', [RoomController::class, 'create'])->name('roomCreate');
                Route::post('/store', [RoomController::class, 'store'])->name('roomStore');
                Route::post('/destroy', [RoomController::class, 'destroy'])->name('roomDestroy');
            });
        });
    });
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('postRegister');
});
