<?php

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



use App\Http\Controllers\RemoveBackgroundController;

Route::get('/', [RemoveBackgroundController::class, 'index'])->name('index');
Route::post('/remove-background', [RemoveBackgroundController::class, 'removeBackground'])->name('remove-background');
Route::post('/preview', [RemoveBackgroundController::class, 'preview'])->name('preview');
Route::get('/processed-image', [RemoveBackgroundController::class, 'showProcessedImage'])->name('show-processed-image');
Route::get('/download-processed-image', [RemoveBackgroundController::class, 'downloadProcessedImage'])->name('download-processed-image');
Route::post('/remove-background', [RemoveBackgroundController::class, 'removeBackground'])->name('remove-background');
Route::get('/download-processed', [RemoveBackgroundController::class, 'downloadProcessedImage'])->name('downloadProcessed');
