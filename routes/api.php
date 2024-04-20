<?php

use App\Http\Controllers\ExpenseSource;
use App\Http\Controllers\ExpenseSourceController;
use App\Http\Controllers\IncomeSourceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearController;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix('admin')->group(function(){
    Route::resource('users',UserController::class)->names('users');
});

// Route::middleware('auth:sanctum')->prefix('rakib')->group(function(){
//     Route::resource('pcategory',ProductCategoryController::class)->names('pcategory');
// });


//helal of kre rakhse, pore calu krte hbe



Route::prefix('rakib')->group(function(){
    Route::resource('expense',ExpenseSourceController::class)->names('expense');
});

Route::prefix('rakib')->group(function(){
    Route::resource('incomes',IncomeSourceController::class)->names('incomes');
});

Route::prefix('rakib')->group(function(){
    Route::resource('pcategory',ProductCategoryController::class)->names('pcategory');
});


Route::prefix('rakib')->group(function(){
    Route::resource('year',YearController::class)->names('year');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[LoginController::class,'login']);
Route::post('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');