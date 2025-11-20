<?php

use Illuminate\Support\Facades\Route;
use JobsLaravelPackage\Http\Controllers\JobController;

Route::group([
    'middleware' => ['web'],
], function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    Route::post('/jobs/{job}/apply', [JobController::class, 'applyStore'])->name('jobs.apply.store');
    Route::post('/jobs/{job}/bookmark', [JobController::class, 'toggleBookmark'])->name('jobs.bookmark');
});
