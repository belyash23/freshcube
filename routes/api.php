<?php

use App\Http\Controllers\ActionsHistoriesController;
use App\Http\Controllers\DealsController;
use Illuminate\Support\Facades\Route;

Route::get('/deals', [DealsController::class, 'list']);
Route::post('/link-contact', [DealsController::class, 'linkContact']);
Route::get('/history', [ActionsHistoriesController::class, 'list']);
