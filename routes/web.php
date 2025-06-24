<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AssignEventController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\HomeController;
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
    return redirect()->route('login');
})->middleware('auth');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::put('profile-update', [HomeController::class, 'profileUpdate'])->name('profile.update');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('venues', VenueController::class);
    Route::resource('items', ItemController::class);
    Route::get('item/quantity', [ItemController::class, 'itemQuantity'])->name('item.quantity');
    Route::resource('employees', EmployeeController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::post('portfolio/delete', [PortfolioController::class, 'deleteImage'])->name('portfolio.delete');
    Route::resource('events', EventController::class);
    Route::resource('templates', TemplateController::class);
    Route::get('item/list', [ItemController::class, 'itemList'])->name('item.list');
    Route::post('event-item/delete', [EventController::class, 'deleteEventItem'])->name('event-item.delete');
    Route::resource('assign/event', AssignEventController::class);
    Route::post('template-item/delete', [TemplateController::class, 'deleteTemplateItem'])->name('template-item.delete');
});