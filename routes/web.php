<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;


Route::get("/", [HomeController::class, 'index'])->name('home');
Route::post("/upload", [PdfController::class, 'upload'])->name('upload');


Route::get("/amir", function(){

    dd(url('amir'));

});
