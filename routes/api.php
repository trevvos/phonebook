<?php

use App\Http\Controllers\Api\PhonebookController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/contacts', PhonebookController::class);
