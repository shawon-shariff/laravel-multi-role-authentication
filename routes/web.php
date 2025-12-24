<?php

use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransformationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/transformation', [TransformationController::class, 'transformation'])->name('view.transformation');
    Route::get('/generative-background', [TransformationController::class, 'generativeBackground'])->name('view.generative-background');
    Route::get('/generative-fill', [TransformationController::class, 'generativeFill'])->name('view.generative-fill');
    Route::get('/generative-replace', [TransformationController::class, 'generativeReplace'])->name('view.generative-replace');
    Route::get('/generative-remove', [TransformationController::class, 'generativeRemove'])->name('view.generative-remove');
    Route::get('/generative-recolor', [TransformationController::class, 'generativeRecolor'])->name('view.generative-recolor');
    Route::get('/generative-restore', [TransformationController::class, 'generativeRestore'])->name('view.generative-restore');
    Route::get('/generative-enhance', [TransformationController::class, 'generativeEnhance'])->name('view.generative-enhance');
    Route::get('/generative-upscale', [TransformationController::class, 'generativeUpscale'])->name('view.generative-upscale');

    Route::post('/upload-image', [ImageUploadController::class, 'uploadImage']);
    Route::post('/gen-bg', [ImageUploadController::class, 'genBackground']);
    Route::post('/gen-fill', [ImageUploadController::class, 'genFill']);
    Route::post('/gen-replace', [ImageUploadController::class, 'genReplace']);
    Route::post('/gen-remove', [ImageUploadController::class, 'genRemove']);
    Route::post('/gen-recolor', [ImageUploadController::class, 'genRecolor']);
    Route::post('/gen-restore', [ImageUploadController::class, 'genRestore']);
    Route::post('/gen-enhance', [ImageUploadController::class, 'genEnhance']);
    Route::post('/gen-upscale', [ImageUploadController::class, 'genUpscale']);

    //Media Gallery
    Route::get('/media', [TransformationController::class, 'media'])->name('view.media');

});

// Upload Image


require __DIR__ . '/auth.php';
require __DIR__ . '/admin-auth.php';
require __DIR__ . '/super-admin-auth.php';
