<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PageController;

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
    return redirect()->guest(route('login'));
});

Auth::routes();

//  Admin Web Views
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/branch',[PageController::class,'branch']);
    Route::get('/order-{branch_id}',[PageController::class,'order']);
    Route::get('/inventory',[PageController::class,'inventory']);
    Route::get('/sales-report',[PageController::class,'sales_report']);
    Route::get('/manage-user',[PageController::class,'manage_user']);
    Route::get('/menu',[PageController::class,'menu']);
    Route::get('/profile',[PageController::class,'profile']);
    Route::get('/expenses',[PageController::class,'expenses']);
});

//  Staff Web Views
Route::group(['middleware' => ['auth', 'staff']], function() {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
});
