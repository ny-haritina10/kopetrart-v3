<?php

use App\Http\Controllers\Cost\ProductCostUnitController;
use App\Http\Controllers\Cost\CostCenterDetailController;
use App\Http\Controllers\Cost\CostCenterSharedController;
use App\Http\Controllers\Cost\ExpenseCostUnitController;
use App\Http\Controllers\General\ExerciceController;
use App\Http\Controllers\Misc\CenterController;
use App\Http\Controllers\Misc\ExpenseController;
use App\Http\Controllers\Misc\ProductController;
use App\Http\Controllers\Misc\SectionController;
use App\Http\Controllers\Misc\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ CostCenterDetailController::class, 'index' ]);

Route::get('/cost/expense', [ ExpenseCostUnitController::class, 'index' ]);
Route::get('/cost/center/detail', [ CostCenterDetailController::class, 'index' ]);
Route::get('/cost/center/shared', [ CostCenterSharedController::class, 'index' ]);
Route::get('/cost/product', [ ProductCostUnitController::class, 'index' ]);

Route::resource('/section', SectionController::class);
Route::resource('/exercice', ExerciceController::class);
Route::resource('/unit', UnitController::class);
Route::resource('/center', CenterController::class);
Route::resource('/product', ProductController::class);
Route::resource('/expense', ExpenseController::class);
