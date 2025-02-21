<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CommentController;
use GuzzleHttp\Promise\RejectedPromise;

Route::get('/', function () {
    return view('welcome');
});





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

Route::resource('annonces', AnnonceController::class);


Route::prefix('annonces')->group(function () {
    Route::get('/', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::post('/', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('/{annonce}', [AnnonceController::class, 'show'])->name('annonces.show');
});


Route::middleware('auth')->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';


