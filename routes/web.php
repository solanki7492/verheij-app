<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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
});

Auth::routes([
    'register' => false
]);

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::post('about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');
Route::post('about-us-detail', [HomeController::class, 'aboutUsDetail'])->name('aboutUsDetail');
Route::resource('products', ProductController::class);
Route::post('notify', [ProductController::class, 'notify'])->name('notify');
Route::post('settings', [HomeController::class, 'settings'])->name('settings');

Route::prefix('users')->name('users.')->middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/list', [UserController::class, 'list'])->name('list');
    Route::post('/create', [UserController::class, 'store'])->name('store');
    Route::post('/{user}/update', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}/delete', [UserController::class, 'destroy'])->name('destroy');
});


Route::get('/migrate', function () {
    Artisan::call('migrate');
});
