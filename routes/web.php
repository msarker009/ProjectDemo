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

/*Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return "About Us";
});
Route::get('/user/{id}', function ($id) {
    return "User ID=".$id;
});*/


//user route
Route::get('users',[UserController::class,'index']);
Route::get('fetch-users',[UserController::class,'fetchUser']);
Route::post('users',[UserController::class,'store']);
Route::get('edit_user/{id}',[UserController::class,'editUser']);
Route::post('update_user/{id}',[UserController::class,'updateUser']);









//student route
Route::get('students',[StudentController::class,'index']);
Route::get('fetch_data',[StudentController::class,'fetchStudent']);
Route::post('students',[StudentController::class,'store']);
Route::get('edit_student/{id}',[StudentController::class,'editStudent']);
Route::post('update_student/{id}',[StudentController::class,'updateStudent']);
Route::delete('delete_student/{id}',[StudentController::class,'destroy']);


//employee route
Route::get('/show',[PageController::class,'index']);
Route::get('/about',[PageController::class,'about']);
Route::get('/employee',[EmployeeController::class,'index']);
Route::get('/add-employee',[EmployeeController::class,'create']);
Route::post('/store-employee',[EmployeeController::class,'store']);
Route::get('/edit-employee/{id}',[EmployeeController::class,'edit']);
Route::put('/update-employee/{id}',[EmployeeController::class,'update']);
Route::delete('/delete-employee/{id}',[EmployeeController::class,'destroy']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::get('posts',[PostController::class,'index']);
Route::get('add-posts',[PostController::class,'create']);*/
Route::middleware(['auth','isAdmin'])->group(function (){
    Route::resource('posts','\App\Http\Controllers\PostController');
});




