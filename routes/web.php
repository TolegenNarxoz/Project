<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth2\RegisterContorller;
use App\Http\Controllers\Auth2\LoginContorller;
use App\Models\Product;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('lang/{lang}', [LangController::class, 'switchLang'])->name('switch.lang');

Route::middleware('auth')->group(function (){
    Route::resource('/products', ProductController::class)->except('show','index');
    Route::resource('/categories', CategoryController::class)->except('index');
    Route::resource('/reviews', ReviewController::class);

    Route::post('/product/{product}/basketall',[ProductController::class, 'basketAll'])->name('products.basketAll');
    Route::get('/product/basket',[ProductController::class, 'basket'])->name('products.basket');
//    Route::post('/product/{product}/unbasket',[ProductController::class,'unbasketAll'])->name('products.unbasketAll');
//    Route::put('/product/basket/{basket}/edit', [ProductController::class,'editbasket'])->name('products.editBasket');

    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin,moderator')->group(function (){
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
        Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::put('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
    });

    Route::middleware('hasrole:admin,moderator')->group(function (){
        Route::get('/adm/categories', [CategoryController::class, 'index'])->name('categories.indexx');
        Route::get('/categories/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});

Route::resource('/products', ProductController::class);
Route::get('/products/search', [ProductController::class, 'index'])->name('products.search');
Route::resource('/categories', CategoryController::class);
Route::get('posts/category/{category}',[ProductController::class, 'postsByCategory'])->name('products.category');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterContorller::class, 'create'])->name('register.form');
Route::post('/register', [RegisterContorller::class, 'register'])->name('register');

Route::post('/logout', [LoginContorller::class, 'logout'])->name('logout');
Route::get('/login', [LoginContorller::class, 'create'])->name('login.form');
Route::post('/login', [LoginContorller::class, 'login'])->name('login');
