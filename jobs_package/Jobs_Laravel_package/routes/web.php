<?php

use Illuminate\Support\Facades\Route;
use Jobs\Http\Controllers\CompanyController;
use Jobs\Http\Controllers\JobController;

Route::middleware(['web'])->group(function () {
    Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
    Route::post('companies', [CompanyController::class, 'store'])->name('jobs.companies.store');
});
