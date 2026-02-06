<?php

use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']); // GET - http://127.0.0.1:8000/api/users?page=2
Route::get('/users/{user}', [UserController::class, 'show']); // GET - http://127.0.0.1:8000/api/users/1
Route::post('/users', [UserController::class, 'store']); // POST - http://127.0.0.1:8000/api/users

Route::get('/bills', [BillController::class, 'index']); // GET - http://127.0.0.1:8000/api/bills?page=2
Route::get('/bills/{bill}', [BillController::class, 'show']); // GET - http://127.0.0.1:8000/api/bills/1
Route::post('/bills', [BillController::class, 'store']); // POST - http://127.0.0.1:8000/api/bills


