<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [OrderController::class, 'index']);
Route::get('/login', [LoginController::class, 'login']);
Route::get('/signup', [SignUpController::class, 'signup']);
Route::get('/checkout', [OrderController::class, 'checkout']);
Route::get('/success', [OrderController::class, 'success']);

// Route::post('/checkout', [OrderController::class, 'checkout']);
Route::get('/invoice/{id}', [OrderController::class, 'invoice']);
Route::get('/ticket/{id}', [OrderController::class, 'ticket']);
