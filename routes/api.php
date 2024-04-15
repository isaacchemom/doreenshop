<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\applicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/addsupplier', [applicationController::class, 'addsupplier']);
Route::get('/getsuppliers', [applicationController::class, 'getsuppliers']);
Route::patch('/editSupplier/{id}', [applicationController::class, 'editSupplier']);
Route::post('/deleteSupplier/{id}', [applicationController::class, 'deleteSupplier']);


Route::post('/addProduct', [applicationController::class, 'addProduct']);
Route::get('/getProducts', [applicationController::class, 'getProducts']);
Route::patch('/updateProduct/{id}', [applicationController::class, 'updateProduct']);
Route::post('/deleteProduct/{id}', [applicationController::class, 'deleteProduct']);


Route::post('/addCategory', [applicationController::class, 'addCategory']);
Route::get('/getCategories', [applicationController::class, 'getCategories']);
Route::patch('/updateCategory/{id}', [applicationController::class, 'updateCategory']);
Route::post('/deleteCategory/{id}', [applicationController::class, 'deleteCategory']);

Route::post('/addDepartment', [applicationController::class, 'addDepartment']);
Route::get('/getDepartments', [applicationController::class, 'getDepartments']);
Route::patch('/updateDepartment/{id}', [applicationController::class, 'updateDepartment']);
Route::post('/deleteDepartment/{id}', [applicationController::class, 'deleteDepartment']);

Route::post('/addStaff', [applicationController::class, 'addStaff']);
Route::get('/getStaff', [applicationController::class, 'getStaff']);
Route::patch('/editStaff/{id}', [applicationController::class, 'editStaff']);
Route::post('/deleteStaff/{id}', [applicationController::class, 'deleteStaff']);


Route::post('/saleProduct', [applicationController::class, 'saleProduct']);
Route::get('/getSales', [applicationController::class, 'getSales']);
Route::post('/updateSales', [applicationController::class, 'updateSales']);
Route::post('/deleteSales', [applicationController::class, 'deleteSales']);

Route::get('/getDailySales', [applicationController::class, 'getDailySales']);

Route::get('/getMonthlySales', [applicationController::class, 'getMonthlySales']);

Route::get('/getWeeklySales', [applicationController::class, 'getWeeklySales']);

Route::get('/getSalesReport', [applicationController::class, 'getSalesReport']);