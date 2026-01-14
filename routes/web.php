<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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
        Route::get('/', [MemberController::class, 'index'])
            ->name('index');

        Route::get('/payment', [MemberController::class, 'indexPayment'])
            ->name('payment.index');

        Route::get('/profile', [MemberController::class, 'indexProfile'])
            ->name('profile.index');

        Route::put('/profile', [MemberController::class, 'updateProfile'])
            ->name('profile.update');

        Route::get('/submission/create', [MemberController::class, 'createSubmission'])
            ->name('submission.create');

        Route::post('/submission', [MemberController::class, 'storeSubmission'])
            ->name('submission.store');

        Route::get('/submission', [MemberController::class, 'indexSubmission'])
            ->name('submission.index');

        Route::get('/submission/{id}/edit', [MemberController::class, 'editSubmission'])
            ->name('submission.edit');

        Route::put('/submission/{id}', [MemberController::class, 'updateSubmission'])
            ->name('submission.update');

        // unused
        // Route::get('/research/{research}', [MemberController::class, 'editResearch'])
        //     ->name('research.edit');

        // Route::put('/research/{research}', [MemberController::class, 'updateResearch'])
        //     ->name('research.update');

        // Route::delete('/research/{research}', [MemberController::class, 'destroyResearch'])
        //     ->name('research.destroy');

        // Route::resource('member/research', ResearchController::class)
        //     ->only(['edit', 'update', 'destroy']);
    });

// Route::get('member', 'MemberControl@index');
// Route::get('member/profile', 'MemberControl@profile');
// Route::get('member/submission', 'MemberControl@showSubmission');
// Route::post('member/submission', 'MemberControl@submissionPaper');
// Route::get('member/check', 'MemberControl@checkSubmission');
// Route::get('member/edit/{id?}', 'MemberControl@showEditPaper');
// Route::post('member/edit/{id}', 'MemberControl@editPaper');
// Route::get('member/delete/{id}', 'MemberControl@deletePaper');
// Route::post('member/editprofile', 'MemberControl@editProfile');

// // download file -- use direct asset() instead
// Route::get('download/abstractTH/{id}', 'FileControl@downloadAbstractTH');
// Route::get('download/abstractEN/{id}', 'FileControl@downloadAbstractEN');
// Route::get('download/extended/{id}', 'FileControl@downloadAbstractEX');
// Route::get('download/fulltext/{id}', 'FileControl@downloadFullText');
// Route::get('download/poster/{id}', 'FileControl@downloadPoster');
// Route::get('download/ms/abstract-th-template', 'FileControl@downloadAbstractTemplateThMs');
// Route::get('download/pdf/abstract-th-template', 'FileControl@downloadAbstractTemplateThPdf');
// Route::get('download/ms/abstract-en-template', 'FileControl@downloadAbstractTemplateEnMs');
// Route::get('download/pdf/abstract-en-template', 'FileControl@downloadAbstractTemplateEnPdf');
// Route::get('download/ms/abstract-extended-template', 'FileControl@downloadExtendedAbstractTemplateMs');
// Route::get('download/pdf/abstract-extended-template', 'FileControl@downloadExtendedAbstractTemplatePdf');
// Route::get('download/poster-template', 'FileControl@downloadPosterTemplate');
// Route::get('download/fulltext-th-template', 'FileControl@downloadFullTextTemplateTH');
// Route::get('download/fulltext-en-template', 'FileControl@downloadFullTextTemplateEN');
// Route::get('download/oral-announcement', 'FileControl@downloadAnnouncementOral');
// Route::get('download/poster-announcement', 'FileControl@downloadAnnouncementPoster');
// Route::get('download/conference-handbook', 'FileControl@downloadHandbook');
// Route::get('download/book-of-abstract', 'FileControl@downloadBookOfAbstract');
// Route::get('download/zoom-handbook', 'FileControl@downloadZoomHandbook');
// Route::get('download/award/oral', 'FileControl@downloadOralReward');
// Route::get('download/award/poster', 'FileControl@downloadPosterReward');

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

// Route::get('admin', 'AdminControl@index');
// Route::post('admin/signin', 'Auth\AuthController@adminLogin');

// // admin register route
// // Route::post('admin/reg', 'Auth\AuthController@createAdmin');
// // Route::get('admin/reg', function () {
// //     return view('registeradmin');
// // });

// Route::get('admin/dashboard', 'AdminControl@dashboard');

// Route::get('admin/committee', 'AdminControl@showCommittee');

// Route::get('admin/committee/add', 'AdminControl@showAddCommittee');

// Route::post('admin/committee/add', 'AdminControl@addCommittee');

// Route::get('admin/committee/edit/{id}', 'AdminControl@showEditCommitee');

// Route::post('admin/committee/edit/{id}', 'AdminControl@editCommitee');

// Route::get('admin/committee/delete/{id}', 'AdminControl@deleteCommittee');

// Route::get('admin/paper', 'AdminControl@showPaperList');

// Route::get('admin/paper/{id}', 'AdminControl@showEditPaper');

// Route::post('admin/paper/{id}', 'AdminControl@editPaper');

// Route::get('admin/attend', 'AdminControl@showAttend');

// Route::get('admin/schedule/add', 'AdminControl@showAddSchedule');

// Route::get('admin/shedule/delete/{id}', 'AdminControl@deleteSchedule');

// Route::post('admin/schedule/add', 'AdminControl@addSchedule');

// Route::get('admin/schedule/{id}', 'AdminControl@showEditSchedule');

// Route::post('admin/schedule/{id}', 'AdminControl@editSchedule');

// Route::get('admin/announce', 'AdminControl@announce');

// Route::get('admin/unannounce', 'AdminControl@unAnnounce');

// Route::get('admin/openregister', 'AdminControl@announceRegister');

// Route::get('admin/closeregister', 'AdminControl@unannounceRegister');

// Route::get('admin/opensubmission', 'AdminControl@announceSubmission');

// Route::get('admin/closesubmission', 'AdminControl@unannounceSubmission');

// // api
// Route::post('search/paper', 'SearchControl@searchPaper');

// Route::post('search/committee', 'SearchControl@searchCommittee');

// Route::get('v1/getmemberbytype', 'AdminControl@showByType');

// Route::get('v1/getmemberbyid', 'AdminControl@getAttenedByID');

// Route::get('v1/export', 'ExportFile@get_members');
