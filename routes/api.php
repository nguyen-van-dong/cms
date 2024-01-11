<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Module\Cms\Http\Controllers\Api\BlogController;

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

Route::get('/categories', [BlogController::class, 'categories'])->name('cms.api.blog.categories');
Route::get('/categories/{id}', [BlogController::class, 'detail'])->name('cms.api.blog.category-detail');
Route::get('/categories/detail/{id}', [BlogController::class, 'getCategoryDetail'])->name('cms.api.blog.get-category-detail');
Route::get('/posts', [BlogController::class, 'posts'])->name('cms.api.blog.posts');
Route::get('/posts/{slug}', [BlogController::class, 'getPostBySlug'])->name('cms.api.blog.get-post');
Route::get('/archives', [BlogController::class, 'getArchives'])->name('cms.api.blog.archives');