<?php

use App\Http\Controllers\AdminController;
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
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/edit', 'edit')->name('edit');
            Route::put('/', 'update')->name('update');
            Route::get('/file/{file}/download', 'fileDownload')->name('file.download');
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
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');
        
        Route::get('/submission', [AdminController::class, 'indexSubmission'])
            ->name('submission.index');

        Route::get('/submission/{id}', [AdminController::class, 'showSubmission'])
            ->name('submission.show');
        
        Route::get('/attendee', [AdminController::class, 'indexAttendee'])
            ->name('attendee.index');
    });