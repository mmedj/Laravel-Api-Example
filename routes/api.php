<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// routes/api.php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[UserController::class,'register']);
Route::resource('posts', PostController::class);
Route::resource('posts.comments', CommentController::class)->shallow();
Route::post('comments', [CommentController::class, 'store']); // Endpoint for creating a comment
Route::resource('comments', CommentController::class)->except(['create', 'edit']);
Route::put('comments/{commentId}/edit', [CommentController::class, 'update']);
Route::delete('comments/{commentId}/delete', [CommentController::class, 'destroy']);
Route::get('posts/{postId}/comments', [CommentController::class, 'index']);