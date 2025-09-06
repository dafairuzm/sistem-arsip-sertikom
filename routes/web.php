<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\CategoryController;


Route::get('/', fn() => redirect()->route('letters.index'));


Route::resource('letters', LetterController::class);
Route::get('letters/{letter}/download', [LetterController::class, 'download'])->name('letters.download');


Route::resource('categories', CategoryController::class);


Route::view('/about', 'about')->name('about');