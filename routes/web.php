<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
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

// アルバム
Route::get('/', [AlbumsController::class, 'index'])->name('albums.index'); // 一覧取得
Route::middleware('auth')->group(function () {
    Route::resource('albums', AlbumsController::class)->except([
        'index'
    ]);
});

// フォト
Route::resource('albums.photos', PhotoController::class)->shallow()->only([
    'index', 'show'
]);
Route::middleware('auth')->group(function () {
    Route::resource('albums.photos', PhotoController::class)->shallow()->except([
        'index', 'show'
    ]);
});

// ユーザー情報
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // 編集
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // 更新
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // 削除
});

require __DIR__ . '/auth.php';
