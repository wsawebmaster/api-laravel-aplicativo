<?php

use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('users', [UserController::class, 'index']); // http://127.0.0.1:8000/api/users?page=2

Route::get('bills', [BillController::class, 'index']); // http://127.0.0.1:8000/api/bills?page=2
