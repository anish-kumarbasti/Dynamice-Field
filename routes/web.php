<?php

use App\Http\Controllers\CategoryCntroller;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\SubCategoryModelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('redirect', [CategoryCntroller::class, 'redirect'])->name('redirect');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('admin/dashbaord', [CategoryCntroller::class, 'admindashbaord'])->name('admin.dashboard');
    Route::get('manage/category', [CategoryCntroller::class, 'index'])->name('manage.category');
    Route::post('manage/category', [CategoryCntroller::class, 'save'])->name('manage.category.save');
    Route::get('category/edit{id}', [CategoryCntroller::class, 'edit'])->name('category.edit');
    Route::put('category/update/{id}', [CategoryCntroller::class, 'update'])->name('category.update');
    Route::delete('category/delete/{id}', [CategoryCntroller::class, 'destroy'])->name('category.delete');

    //Sub Controller 
    Route::get('sub/category/manage', [SubCategoryModelController::class, 'index'])->name('sub.category.manage');
    Route::post('category/manage', [SubCategoryModelController::class, 'save'])->name('sub.category.save');
    Route::get('category/manage/{id}', [SubCategoryModelController::class, 'edit'])->name('sub.category.edit');
    Route::put('category/manage/{id}/update', [SubCategoryModelController::class, 'update'])->name('sub.category.edit.update');
    Route::delete('sub/category/delete/{id}', [SubCategoryModelController::class, 'destroy'])->name('sub.category.delete');

    //Manage Product
    Route::get('manage/product', [ManageProductController::class, 'index'])->name('manage.product');
    Route::post('manage/product/save', [ManageProductController::class, 'store'])->name('manage.product.save');
    Route::get('get-category/{categoryId}', [ManageProductController::class, 'category']);
    Route::get('all/products', [ManageProductController::class, 'show'])->name('all.products');
    Route::get('manage/product/edit/{id}', [ManageProductController::class, 'edit'])->name('manage.product.edit');
    Route::put('manage/product/update/{id}', [ManageProductController::class, 'update'])->name('manage.product.update');
    Route::delete('manage/product/delete/{id}', [ManageProductController::class, 'destroy'])->name('manage.product.delete');

    //Shop product
    Route::get('shops/products', [ManageProductController::class, 'shopproduct'])->name('shops.products');
    Route::post('add/to/card', [ManageProductController::class, 'addtoproduct'])->name('addtocard');
    Route::get('user/cart/products', [ManageProductController::class, 'usercart'])->name('user.cart.product');
    Route::get('remove/user/card/{id}', [ManageProductController::class, 'usercartremove'])->name('remove.cart.product');
});
