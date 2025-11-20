<?php

use Illuminate\Support\Facades\Route;
use JobsLaravelPackage\Http\Controllers\Api\AtsController;
use JobsLaravelPackage\Http\Controllers\Api\OpeningController;
use JobsLaravelPackage\Http\Controllers\Api\TaxonomyController;

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
    'prefix' => 'api/jobs',
], function () {
    Route::get('/', [OpeningController::class, 'index']);
    Route::post('/', [OpeningController::class, 'store']);
    Route::get('/taxonomies/categories', [TaxonomyController::class, 'categories']);
    Route::get('/taxonomies/tags', [TaxonomyController::class, 'tags']);
    Route::get('/taxonomies/skills', [TaxonomyController::class, 'skills']);
    Route::get('/taxonomies/locations', [TaxonomyController::class, 'locations']);
    Route::get('/taxonomies/expert-levels', [TaxonomyController::class, 'expertLevels']);
    Route::get('/taxonomies/qualifications', [TaxonomyController::class, 'qualifications']);
    Route::get('/openings/{opening}/stages', [AtsController::class, 'stages']);
    Route::put('/applications/{application}/stage', [AtsController::class, 'updateStage']);
    Route::get('/{opening}', [OpeningController::class, 'show']);
    Route::put('/{opening}', [OpeningController::class, 'update']);
    Route::delete('/{opening}', [OpeningController::class, 'destroy']);
});
