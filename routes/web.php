<?php

use App\Http\Middleware\IsAdmin;
use App\Livewire\AddStock;
use App\Livewire\Products\AddProduct;
use App\Livewire\Products\Product;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('store', 'dashboard.store')->name('dash.store');
});

Route::middleware(['auth', 'verified', IsAdmin::class])->group(function () {
    Volt::route('products/add', AddProduct::class)->name('product.add');

    Volt::route('products/stock/add', AddStock::class)->name('stock.add');

    Volt::route('products/{id}', Product::class)->name('product.product');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
