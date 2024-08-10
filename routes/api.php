<?php
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\TagController;
use App\Http\Controllers\api\CommentController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    /* Route::middleware(['CheckBanned'])->group(function(){ */
        Route::post('/logout',[AuthController::class,'logout']);

        Route::get("/getCategories",[CategoryController::class,'index']);
        Route::get("/getTags",[TagController::class,'index']);

        Route::get("/posts",[PostController::class,'index']);
        Route::get("/showPost/{post}",[PostController::class,'show']);
        Route::post("/storePost",[PostController::class,'store']);
        Route::put("/updatePost/{post}",[PostController::class,'update']);
        Route::delete("/deletePost/{post}",[PostController::class,'destroy']);

        Route::get("/showOneComment/{comment}",[CommentController::class,'index']);
        Route::get("/showComment/{post}",[CommentController::class,'show']);
        Route::post("/storeComment/{post}",[CommentController::class,'store']);
        Route::put("/updateComment/{comment}",[CommentController::class,'update']);
        Route::delete("/deleteComment/{comment}",[CommentController::class,'destroy']);
/* });*/
});
