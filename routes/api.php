<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ExpensesController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Inventory
Route::match(['get','post',], 'inventory/list', [InventoryController::class,'list']);
Route::match(['get','post',], 'inventory/items', [InventoryController::class,'items']);
Route::match(['get','post',], 'inventory/create', [InventoryController::class,'create']);
Route::match(['get','post',], 'inventory/update', [InventoryController::class,'update']);
Route::match(['get','post',], 'inventory/delete', [InventoryController::class,'delete']);

// User
Route::match(['get','post',], 'user/list', [UserController::class,'list']);
Route::match(['get','post',], 'user/items', [UserController::class,'items']);
Route::match(['get','post',], 'user/create', [UserController::class,'create']);
Route::match(['get','post',], 'user/update', [UserController::class,'update']);
Route::match(['get','post',], 'user/delete', [UserController::class,'delete']);

// Profile
Route::match(['get','post',], 'profile/update', [ProfileController::class,'update']);
Route::match(['get','post',], 'profile/update_password', [ProfileController::class,'update_password']);

// Branch
Route::match(['get','post',], 'branch/list', [BranchController::class,'list']);
Route::match(['get','post',], 'branch/items', [BranchController::class,'items']);
Route::match(['get','post',], 'branch/create', [BranchController::class,'create']);
Route::match(['get','post',], 'branch/update', [BranchController::class,'update']);
Route::match(['get','post',], 'branch/delete', [BranchController::class,'delete']);

// Category
Route::match(['get','post',], 'category/list', [CategoryController::class,'list']);
Route::match(['get','post',], 'category/items', [CategoryController::class,'items']);
Route::match(['get','post',], 'category/create', [CategoryController::class,'create']);
Route::match(['get','post',], 'category/update', [CategoryController::class,'update']);
Route::match(['get','post',], 'category/delete', [CategoryController::class,'delete']);

// Menu
Route::match(['get','post',], 'menu/list', [MenuController::class,'list']);
Route::match(['get','post',], 'menu/list2', [MenuController::class,'list2']);
Route::match(['get','post',], 'menu/items', [MenuController::class,'items']);
Route::match(['get','post',], 'menu/create', [MenuController::class,'create']);
Route::match(['get','post',], 'menu/update', [MenuController::class,'update']);
Route::match(['get','post',], 'menu/delete', [MenuController::class,'delete']);
Route::match(['get','post',], 'menu/find_items', [MenuController::class,'find_items']);
Route::match(['get','post',], 'menu/find_all', [MenuController::class,'find_all']);
Route::match(['get','post',], 'menu/save_order', [MenuController::class,'save_order']);
Route::match(['get','post',], 'menu/invoice', [MenuController::class,'invoice']);
Route::match(['get','post',], 'menu/find_invoice', [MenuController::class,'find_invoice']);


// Sales
Route::match(['get','post',], 'sales/list', [SalesController::class,'list']);
Route::match(['get','post',], 'sales/items', [SalesController::class,'items']);
Route::match(['get','post',], 'sales/create', [SalesController::class,'create']);
Route::match(['get','post',], 'sales/generate', [SalesController::class,'generate']);

// Ingredients
Route::match(['get','post',], 'ingredients/list', [IngredientsController::class,'list']);
Route::match(['get','post',], 'ingredients/items', [IngredientsController::class,'items']);
Route::match(['get','post',], 'ingredients/create', [IngredientsController::class,'create']);
Route::match(['get','post',], 'ingredients/update', [IngredientsController::class,'update']);

// Expenses
Route::match(['get','post',], 'expenses/list', [ExpensesController::class,'list']);
Route::match(['get','post',], 'expenses/items', [ExpensesController::class,'items']);
Route::match(['get','post',], 'expenses/create', [ExpensesController::class,'create']);
Route::match(['get','post',], 'expenses/update', [ExpensesController::class,'update']);