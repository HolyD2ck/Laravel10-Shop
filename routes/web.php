<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

 // Билли Джин => База
Route::get('/', [\App\Http\Controllers\ProductsController::class, 'main']);

Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

Route::get('/admin',\App\Http\Controllers\AdminController::class);

Auth::routes();
 // Билли Джин => Кувшин
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', \App\Http\Controllers\AdminController::class)->middleware('is_admin');
Route::resource('users',\App\Http\Controllers\UserController::class)->middleware('is_admin');
Route::resource('products',\App\Http\Controllers\ProductsController::class)->middleware('is_admin');
Route::resource('taskmasters',\App\Http\Controllers\TaskmastersController::class)->middleware('is_admin');
 // Билли Джин => Корзина
Route::post('/cart/{product}/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add')->middleware('auth');;
Route::delete('/cart/{cart}/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
