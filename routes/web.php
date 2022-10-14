<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\DetailsController;

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
Route::get('post-recycles',[PostController::class,'recycle'])->name('post.recycle');
Route::post('restore/{id}', [PostController::class, 'restore'])->name('post.restore');
Route::delete('permanent/delete/{id}', [PostController::class, 'forceDelete'])->name('post.forceDelete');
Route::resource('post',PostController::class);

Route::get('user-recycles',[UserController::class,'recycle'])->name('user.recycle');
Route::post('restore/{id}', [UserController::class, 'restore'])->name('user.restore');
Route::delete('permanent/delete/{id}', [UserController::class, 'forceDelete'])->name('user.forceDelete');
Route::resource('user',UserController::class);


Route::resource('users', UserController::class);
Route::resource('events', \App\Http\Controllers\EventController::class);
Route::resource('users.events',\App\Http\Controllers\UserEventController::class);
Route::resource('events.users',\App\Http\Controllers\EventUserController::class);

Route::post('users/{user}/events/{event}/book',[UserController::class,'book_event'])->name('book.event');


Route::get('details-recycles',[DetailsController::class,'recycle'])->name('details.recycle');
Route::post('restore/{id}', [DetailsController::class, 'restore'])->name('details.restore');
Route::delete('permanent/delete/{id}', [DetailsController::class, 'forceDelete'])->name('details.forceDelete');
Route::resource('details',DetailsController::class);
