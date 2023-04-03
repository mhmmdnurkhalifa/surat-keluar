<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DownloadsController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\MailController as UserMailController;
use App\Http\Controllers\User\SettingController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::get('/', [UserDashboardController::class, 'index'])->name('user');
        Route::get('/mail', [UserMailController::class, 'index'])->name('mail');
        Route::get('/mail/create', [UserMailController::class, 'create'])->name('mail-create');
        Route::post('/mail', [UserMailController::class, 'store'])->name('mail-store');
        Route::get('/mail/update/{id}', [UserMailController::class, 'edit'])->name('mail-edit');
        Route::post('/mail/update/{id}', [UserMailController::class, 'update'])->name('mail-update');
        Route::get('/setting', [SettingController::class, 'index'])->name('setting-account');
        Route::post('/setting{redirect}', [SettingController::class, 'update'])->name('setting-redirect');

    }
);

Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin-dashboard');
        Route::resource('mail', MailController::class);
        Route::resource('user', UserController::class);
    });
