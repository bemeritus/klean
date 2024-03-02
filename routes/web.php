<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'main'])->name('main');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('service', [PageController::class, 'service'])->name('service');
Route::get('project', [PageController::class, 'project'])->name('project');
Route::get('contact', [PageController::class, 'contact'])->name('contact');


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'register_store'])->name('register.store');


Route::resource('posts', PostController::class);

Route::resources([
    'comments' => CommentController::class,
]);
