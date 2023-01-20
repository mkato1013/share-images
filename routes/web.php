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

// // ダッシュボード(navigation.php 17行目付近 92行目付近も変更する)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// アルバム
Route::get('/', [AlbumsController::class, 'index'])->name('album.index'); // 一覧取得
Route::prefix('album')->group(function () {
    Route::get('/{id}', [AlbumsController::class, 'show'])->name('album.show'); // 一件取得
    Route::middleware('auth')->group(function () {
        Route::get('/', [AlbumsController::class, 'create'])->name('album.create'); // 作成
        Route::post('/', [AlbumsController::class, 'store'])->name('album.store'); // 登録
        Route::get('/edit/{id}', [AlbumsController::class, 'edit'])->name('album.edit'); // 編集
        Route::post('/{id}', [AlbumsController::class, 'update'])->name('album.update'); // 更新
        Route::delete('/{id}', [AlbumsController::class, 'destroy'])->name('album.destroy'); // 削除
    });

    Route::prefix('/{album_id}/photo')->group(function () {
        // フォト
        Route::get('/', [PhotoController::class, 'index'])->name('photo.index'); // 一覧取得
        Route::middleware('auth')->group(function () {
            Route::get('/create', [PhotoController::class, 'create'])->name('photo.create'); // 作成
            Route::post('/', [PhotoController::class, 'store'])->name('photo.store'); // 登録
            Route::get('/edit/{id}', [PhotoController::class, 'edit'])->name('photo.edit'); // 編集
            Route::post('/{id}', [PhotoController::class, 'update'])->name('photo.update'); // 更新
            Route::delete('/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy'); // 削除
        });
        Route::get('/{id}', [PhotoController::class, 'show'])->name('photo.show'); // 一件取得
    });

});

// Route::get('/album/{id}', [AlbumsController::class, 'show'])->name('album.show'); // 一件取得
// Route::middleware('auth')->group(function () {
//     Route::get('/album', [AlbumsController::class, 'create'])->name('album.create'); // 作成
//     Route::post('/album', [AlbumsController::class, 'store'])->name('album.store'); // 登録
//     Route::get('/album/edit/{id}', [AlbumsController::class, 'edit'])->name('album.edit'); // 編集
//     Route::post('/album/{id}', [AlbumsController::class, 'update'])->name('album.update'); // 更新
//     Route::delete('/album/{id}', [AlbumsController::class, 'destroy'])->name('album.destroy'); // 削除
// });

// // フォト
// Route::get('/album/{album_id}/photo', [PhotoController::class, 'index'])->name('photo.index'); // 一覧取得
// // Route::get('/album/{album_id}/photo/{id}', [PhotoController::class, 'show'])->name('photo.show'); // 一件取得
// Route::middleware('auth')->group(function () {
//     Route::get('/album/{album_id}/photo/create', [PhotoController::class, 'create'])->name('photo.create'); // 作成
//     Route::post('/album/{album_id}/photo', [PhotoController::class, 'store'])->name('photo.store'); // 登録
//     Route::get('/album/{album_id}/photo/edit/{id}', [PhotoController::class, 'edit'])->name('photo.edit'); // 編集
//     Route::post('/album/{album_id}/photo/{id}', [PhotoController::class, 'update'])->name('photo.update'); // 更新
//     Route::delete('/album/{album_id}/photo/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy'); // 削除
// });
// Route::get('/album/{album_id}/photo/{id}', [PhotoController::class, 'show'])->name('photo.show'); // 一件取得

// // フォト
// Route::get('/album/{album_id}/photo', [PhotoController::class, 'index'])->name('photo.index'); // 一覧取得
// // Route::get('/album/{album_id}/photo/{id}', [PhotoController::class, 'show'])->name('photo.show'); // 一件取得
// Route::middleware('auth')->group(function () {
//     Route::get('/album/{album_id}/photo/create', [PhotoController::class, 'create'])->name('photo.create'); // 作成
//     Route::post('/album/{album_id}/photo', [PhotoController::class, 'store'])->name('photo.store'); // 登録
//     Route::get('/album/{album_id}/photo/edit/{id}', [PhotoController::class, 'edit'])->name('photo.edit'); // 編集
//     Route::post('/album/{album_id}/photo/{id}', [PhotoController::class, 'update'])->name('photo.update'); // 更新
//     Route::delete('/album/{album_id}/photo/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy'); // 削除
// });
// Route::get('/album/{album_id}/photo/{id}', [PhotoController::class, 'show'])->name('photo.show'); // 一件取得


// ユーザー情報
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // 編集
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // 更新
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // 削除
});

require __DIR__ . '/auth.php';
