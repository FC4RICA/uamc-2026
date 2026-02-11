<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\ProfileController;
use App\Http\Controllers\Member\SubmissionController;
use App\Http\Controllers\Member\PaymentController;

Route::name('public.')
    ->group(function () {
        Route::view('/', 'public.home')->name('home');
        Route::view('/schedule', 'public.schedule')->name('schedule');
        Route::view('/criteria', 'public.criteria')->name('criteria');
        Route::view('/about', 'public.about')->name('about');
        Route::view('/rules', 'public.rules')->name('rules');
        Route::view('/templates', 'public.form-template')->name('templates');
    });

// member
Route::prefix('member')
    ->middleware('auth')
    ->name('member.')
    ->group(function () {

        Route::controller(PaymentController::class)
            ->prefix('/payments')
            ->name('payment.')
            ->group(function () {
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{payment}/download', 'download')->name('download');
            });

        Route::controller(SubmissionController::class)
            ->prefix('/submissions')
            ->name('submission.')
            ->group(function () {
                Route::name('abstract.')
                    ->prefix('/abstract')
                    ->group(function () {
                        Route::get('/', 'indexAbstract')->name('index');
                        Route::get('/create', 'createAbstract')->name('create');
                        Route::post('/', 'storeAbstract')->name('store');
                        Route::get('/edit', 'editAbstract')->name('edit');
                        Route::put('/', 'updateAbstract')->name('update');
                        
                        Route::delete('/', 'delete')->name('delete');
                    });
                
                Route::get('/files/{file}/download', 'fileDownload')->name('file.download');
            });

        Route::controller(ProfileController::class)
            ->prefix('/profiles')
            ->name('profile.')
            ->group(function () {
                Route::get('/edit', 'edit')->name('edit');
                Route::put('/', 'update')->name('update');
            });

        Route::get('/', [MemberController::class, 'index'])
            ->name('index');

    });

// admin
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', AdminDashboardController::class)
            ->name('index');

        Route::post('/settings/{key}/toggle', SettingController::class)
            ->name('setting.toggle');

        Route::controller(AdminSubmissionController::class)
            ->prefix('/submissions')
            ->name('submission.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{submission}', 'show')->name('show');
                Route::get('/{submission}/edit', 'edit')->name('edit');
                Route::put('/{submission}', 'update')->name('update');
                Route::get('/{submission}/folder', 'folder')->name('folder');
                Route::delete('/{submission}', 'delete')->name('delete');
                Route::post('/{submission}/status', 'updateStatus')->name('status.update');
            });

        Route::controller(AdminPaymentController::class)
            ->prefix('/payments')
            ->name('payment.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{user}', 'show')->name('show');
            });

        Route::controller(AdminUserController::class)
            ->prefix('/users')
            ->name('user.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
            });
    });