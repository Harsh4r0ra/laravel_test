<?php
// routes/web.php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Health check endpoint
Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

// Documentation route (if you want to add API documentation)
Route::get('/docs', function () {
    return view('api.documentation');
});