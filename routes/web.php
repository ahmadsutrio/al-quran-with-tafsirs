<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurahController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/surah/{name}',[SurahController::class,'index'])->name('surah');