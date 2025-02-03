<?php
// routes/api.php
// In routes/api.php
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ContactController;

Route::middleware('company.header')->group(function () {
    // Organization routes
    Route::post('organization/view', [OrganizationController::class, 'view']);
    Route::post('organization/search', [OrganizationController::class, 'search']);
    
    // Contact routes
    Route::post('contact/view', [ContactController::class, 'view']);
    Route::post('contact/search', [ContactController::class, 'search']);
});