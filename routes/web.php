<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\SubscriptionsAdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['verified'])->name('dashboard');

Route::resource('/your_abonnements', SubscriptionsController::class)->middleware(['verified']);

Route::resource('/subscriptions_admin', SubscriptionsAdminController::class)->middleware(['verified','Admin']);
//Route::get('subscriptions_admin/edit/{$id}',[SubscriptionsController::class,'update']);


require __DIR__.'/auth.php';
