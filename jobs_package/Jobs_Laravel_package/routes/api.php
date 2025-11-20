<?php

use Illuminate\Support\Facades\Route;
use Jobs\Http\Controllers\ApplicationController;
use Jobs\Http\Controllers\AtsController;
use Jobs\Http\Controllers\CoverLetterController;
use Jobs\Http\Controllers\CvController;
use Jobs\Http\Controllers\InterviewController;
use Jobs\Http\Controllers\JobController;
use Jobs\Http\Controllers\ScreeningController;
use Jobs\Http\Controllers\SubscriptionController;

Route::middleware(['api'])->group(function () {
    Route::apiResource('jobs', JobController::class)->except(['create', 'edit']);
    Route::apiResource('applications', ApplicationController::class)->only(['index', 'store', 'update']);

    Route::get('ats/stages', [AtsController::class, 'stages']);
    Route::post('applications/{jobApplication}/ats/move', [AtsController::class, 'move']);

    Route::get('jobs/{job}/screening', [ScreeningController::class, 'questions']);
    Route::post('jobs/{job}/screening', [ScreeningController::class, 'storeQuestion']);
    Route::post('applications/{jobApplication}/screening-answers', [ScreeningController::class, 'answer']);

    Route::get('cover-letters', [CoverLetterController::class, 'index']);
    Route::post('cover-letters', [CoverLetterController::class, 'store']);

    Route::get('cvs', [CvController::class, 'index']);
    Route::post('cvs', [CvController::class, 'store']);

    Route::get('subscriptions', [SubscriptionController::class, 'index']);
    Route::post('subscriptions', [SubscriptionController::class, 'store']);

    Route::get('applications/{jobApplication}/interviews', [InterviewController::class, 'index']);
    Route::post('applications/{jobApplication}/interviews', [InterviewController::class, 'store']);
});
