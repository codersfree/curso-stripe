<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BillingContoller;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureUserIsSuscribed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])
    ->name('home');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

Route::get('articles/{article}', [ArticleController::class, 'show'])
    ->middleware([
        'auth',
        EnsureUserIsSuscribed::class
    ])
    ->name('articles.show');

Route::get('billings', [BillingContoller::class, 'index'])
    ->middleware('auth')
    ->name('billings.index');

Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId);
});