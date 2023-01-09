<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('top');
// });

// Route::get('/', [PhotoController::class, 'index'])->name('photo.index');

// ダッシュボード(navigation.php 17行目付近 92行目付近も変更する)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ログインしていなければログイン画面にリダイレクト
// Route::get('/', function () {
//     return view('top');
// })->middleware(['auth', 'verified'])->name('top');


// topページ表示
// Route::get('/', function () {
//     return view('top');
// })->name('top');

Route::get('/', [AlbumsController::class, 'index'])->name('album.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
