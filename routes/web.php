<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BillingContoller;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('billings', [BillingContoller::class, 'index'])
    ->middleware('auth')
    ->name('billings.index');