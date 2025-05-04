<?php

use App\Http\Controllers\Api\ContactController;
use Illuminate\Support\Facades\Route;

Route::post('/contact', [ContactController::class, 'store']);
Route::get('/contacts', [ContactController::class, 'index']);
