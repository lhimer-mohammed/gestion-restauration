<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServantsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["register"=> false , "reset"=> false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('categories',CategoryController::class);
Route::resource('tables',TableController::class);
Route::resource('servants',ServantsController::class);
Route::resource('menus',MenuController::class);
Route::get('payments',[PaymentController::class, "index"])->name("payments.index");
Route::resource('sales',SalesController::class);
Route::get('reports',[ReportController::class, "index"])->name("reports.index");
Route::post('reports/generate',[ReportController::class, "generate"])->name("reports.generate");
Route::post('reports/export',[ReportController::class, "export"])->name("reports.export");


