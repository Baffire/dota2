<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/post/{id}', [PostController::class, 'show'])->where('id', '[0-9]+');

Route::post('/comment/{postId}', [PostController::class, 'comment']);

Route::post('/like/{commentId}', [PostController::class, 'like']);

Route::post('/dislike/{commentId}', [PostController::class, 'dislike']);

Route::get('/get_comments/{postId}', [PostController::class, 'get_comments']);