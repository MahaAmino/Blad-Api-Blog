<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth'])->group(function(){
Route::middleware(['CheckBanned'])->group(function(){
Route::middleware(['admin'])->group(function(){
    Route::get("/createT",[TagController::class , 'create'])->name('tag.create');
    Route::delete("/destroyT/{tag}",[TagController::class , 'destroy'])->name('tag.destroy');
    Route::get('/tags/{tag}',[TagController::class , 'edit'])->name('tag.edit');
    Route::get("/create",[CategoryController::class , 'create'])->name('cat.create');
    Route::get("/categories/{category}",[CategoryController::class, 'edit'])->name('cat.edit');
    Route::delete("/destroy/{category}",[CategoryController::class , 'destroy'])->name('cat.destroy');
    Route::get('/admin/users',[AdminController::class , 'index'])->name('admin.users.index');
    Route::get('/admin/users/create',[AdminController::class , 'create'])->name('admin.users.create');
    Route::put("/admin/users/{user}",[AdminController::class , 'ban'])->name('admin.users.ban');
    Route::delete('/admin/users/{user}',[AdminController::class , 'destroy'])->name('admin.users.destroy');
});
    Route::get("/",[PostController::class , 'index'])->name('post.index');
    Route::get("/post/{post}",[PostController::class , 'show'])->name('post.show');
    Route::get("/edit/{post}",[PostController::class , 'edit'])->name('post.edit');
    Route::put("/post/{post}",[PostController::class , 'update'])->name('post.update');
    Route::get("/add",[PostController::class , 'create'])->name('post.create');
    Route::post("/post",[PostController::class , 'store'])->name('post.store');
    Route::delete("/post/{post}",[PostController::class , 'destroy'])->name('post.destroy');

    Route::get("/CommentAdd/{post_id}",[CommentController::class , 'create'])->name('commentCreate');
    Route::post("/CommentStore/{id}",[CommentController::class , 'store'])->name('commentStore');
    Route::get("/comm_edit/{comment}",[CommentController::class, 'edit'])->name('commentEdit');
    Route::put("/CommentUpdate/{comment}",[CommentController::class , 'update'])->name('commentUpdate');
    Route::delete("/CommentDestroy/{comment}",[CommentController::class , 'destroy'])->name('commentDestroy');

    Route::post('/admin/users/store',[AdminController::class , 'store'])->name('admin.users.store');

    Route::get('/category',[CategoryController::class , 'index'])->name('showAllCategories');
    Route::post("/store",[CategoryController::class , 'store'])->name('cat.store');
    Route::get("/show/{category}",[CategoryController::class , 'show'])->name('cat.show');
    Route::put("/update/{category}",[CategoryController::class , 'update'])->name('cat.update');

    Route::get('/tag',[TagController::class , 'index'])->name('showAllTags');
    Route::post("/storeT",[TagController::class , 'store'])->name('tag.store');
    Route::get("/showT/{tag}",[TagController::class , 'show'])->name('tag.show');
    Route::put("/updateTag/{tag}",[TagController::class , 'update'])->name('tag.update');

    Route::get('logout',[AuthController::class , 'logout'])->name('logout');
});
});
Route::middleware(['guest'])->group(function(){
    Route::get('login',[AuthController::class , 'ShowLoginForm'])->name('loginShow');
    Route::post('login',[AuthController::class , 'login'])->name('login');
    Route::get('register',[AuthController::class , 'ShowRegisterForm'])->name('registerShow');
    Route::post('register',[AuthController::class , 'register'])->name('register');
});


