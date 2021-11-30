<?php

use App\Http\Controllers\ColumnController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/tables', TableController::class);

Route::resource('/columns', ColumnController::class);


Route::resource('/tickets', TicketController::class);

Route::resource('/comments', CommentController::class);


Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'showLoginForm'])->name('admin.loginForm');
Route::post('/admin', [App\Http\Controllers\Admin\AdminController::class, 'loginAdmin'])->name('admin.login');

Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users');

// update utilisateur par l' admin
Route::put('/admin/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.update');
Route::delete('/admin/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.delete');


Route::get('/profil', function () {
    return view('trello.profil');
})->name('user.profil');

















Route::get('/home2', function () {
    return view('trello.home');
});
