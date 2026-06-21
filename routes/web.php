<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/blog/create', [\App\Http\Controllers\Admin\BlogController::class, 'create'])
        ->name('admin.blog.create');

    Route::post('/blog/store', [\App\Http\Controllers\Admin\BlogController::class, 'store'])
        ->name('admin.blog.store');

    Route::get('/blogs', [\App\Http\Controllers\Admin\BlogController::class, 'index'])
        ->name('admin.blog.index');

    Route::get('/blog/edit/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])
        ->name('admin.blog.edit');

    Route::post('/blog/update/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'update'])
        ->name('admin.blog.update');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('blog', BlogController::class);
});


Route::get('/blog', [BlogController::class, 'indexp'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');



require __DIR__ . '/auth.php';
