<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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


//user route
Route::get('employees',[EmployeeController::class,'index']);
Route::get('fetch-employees',[EmployeeController::class,'fetchEmployee']);
Route::post('employees',[EmployeeController::class,'store']);
Route::get('edit_employee/{id}',[EmployeeController::class,'editEmployee']);
Route::post('update_employee/{id}',[EmployeeController::class,'updateEmployee']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
