<?php
// routes/api.php
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['log.api'])->group(function () {
    // Contact routes
    Route::post('/contact/view', [ContactController::class, 'view']);
    
    // Organization routes
    Route::post('/organization/view', [OrganizationController::class, 'view']);
});