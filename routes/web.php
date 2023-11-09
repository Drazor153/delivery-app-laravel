<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\OrdersApi;
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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [Dashboard::class, 'index']);

Route::get('/api/orders', [OrdersApi::class, 'paginatedOrders']);