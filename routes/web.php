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
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Proformat\ProformatController;
use App\Http\Controllers\Purchase\PurchaseOrderController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Sale\SaleController;
use App\Http\Controllers\Stock\StockController;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

Route::resource('/roles', RoleController::class)->middleware('check.role:ADMIN');

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

Route::post('login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('proformat', controller: ProformatController::class);
Route::get('/proformat/accept/{id}', [ProformatController::class, 'accept'])->name('proformat.accept')->middleware('check.role:Manager');
Route::delete('/proformat/reject/{id}', [ProformatController::class, 'reject'])->name('proformat.reject')->middleware('check.role:Manager');

Route::resource('purchase_order', PurchaseOrderController::class);
Route::get('/purchase_order/validate/{id}', [ PurchaseOrderController::class, 'validate'])->name('purchase_order.validate');
Route::resource('purchases', PurchaseController::class);
Route::resource('sales', SaleController::class);
Route::resource('stocks', StockController::class);