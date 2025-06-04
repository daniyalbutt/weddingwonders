<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\EventController;
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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('venues', VenueController::class);
    Route::resource('items', ItemController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::post('portfolio/delete', [PortfolioController::class, 'deleteImage'])->name('portfolio.delete');
    Route::resource('events', EventController::class);
    Route::get('item/list', [ItemController::class, 'itemList'])->name('item.list');
});