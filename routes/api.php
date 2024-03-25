<?php

use App\Http\Controllers\Api\PhonebookController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/contacts', PhonebookController::class);
Route::get('/report', [PhonebookController::class, 'report'])->name('contacts.report');
