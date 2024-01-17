<?php

use Illuminate\Support\Facades\Route;
use Module\Cms\Http\Controllers\Admin\CategoryController;
use Module\Cms\Http\Controllers\Admin\CommentController;
use Module\Cms\Http\Controllers\Admin\PostController;
use Module\Cms\Http\Controllers\Admin\PageController;
use Module\Cms\Http\Controllers\Admin\PostAttributeController;

Route::prefix('cms')->group(function () {

  Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])
      ->name('cms.admin.category.index')
      ->middleware('admin.can:cms.admin.category.index');

    Route::get('create', [CategoryController::class, 'create'])
      ->name('cms.admin.category.create')
      ->middleware('admin.can:cms.admin.category.create');

    Route::get('{id}/move-up', [CategoryController::class, 'moveUp'])->name('cms.admin.category.move-up');
    Route::get('{id}/move-down', [CategoryController::class, 'moveDown'])->name('cms.admin.category.move-down');

    Route::post('store', [CategoryController::class, 'store'])
      ->name('cms.admin.category.store')
      ->middleware('admin.can:cms.admin.category.create');

    Route::get('{id}/edit', [CategoryController::class, 'edit'])
      ->name('cms.admin.category.edit')
      ->middleware('admin.can:cms.admin.category.edit');

    Route::get('{id}/show', [CategoryController::class, 'show'])
      ->name('cms.admin.category.show')
      ->middleware('admin.can:cms.admin.category.show');

    Route::put('{id}/update', [CategoryController::class, 'update'])
      ->name('cms.admin.category.update')
      ->middleware('admin.can:cms.admin.category.edit');

    Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])
      ->name('cms.admin.category.destroy')
      ->middleware('admin.can:cms.admin.category.destroy');
  });

  Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])
      ->name('cms.admin.post.index')
      ->middleware('admin.can:cms.admin.post.index');

    Route::get('{id}/edit', [PostController::class, 'edit'])
      ->name('cms.admin.post.edit')
      ->middleware('admin.can:cms.admin.post.edit');

    Route::get('{id}/comments', [PostController::class, 'showComment'])
      ->name('cms.admin.post.comment')
      ->middleware('admin.can:cms.admin.post.comment');

    Route::put('{id}/update', [PostController::class, 'update'])
      ->name('cms.admin.post.update')
      ->middleware('admin.can:cms.admin.post.edit');

    Route::get('create', [PostController::class, 'create'])
      ->name('cms.admin.post.create')
      ->middleware('admin.can:cms.admin.post.create');

    Route::post('store', [PostController::class, 'store'])
      ->name('cms.admin.post.store')
      ->middleware('admin.can:cms.admin.post.create');

    Route::delete('{id}/destroy', [PostController::class, 'destroy'])
      ->name('cms.admin.post.destroy')
      ->middleware('admin.can:cms.admin.post.destroy');

    Route::post('published', [PostController::class, 'publish'])
      ->name('cms.admin.post.publish')
      ->middleware('admin.can:comment.admin.comment.publish');

    Route::prefix('post-attribute')->group(function () {
      Route::get('', [PostAttributeController::class, 'index'])
        ->name('cms.admin.post-attribute.index')
        ->middleware('admin.can:cms.admin.post-attribute.index');

      Route::get('create', [PostAttributeController::class, 'create'])
        ->name('cms.admin.post-attribute.create')
        ->middleware('admin.can:cms.admin.post-attribute.create');

      Route::post('/', [PostAttributeController::class, 'store'])
        ->name('cms.admin.post-attribute.store')
        ->middleware('admin.can:cms.admin.post-attribute.create');

      Route::get('{id}/edit', [PostAttributeController::class, 'edit'])
        ->name('cms.admin.post-attribute.edit')
        ->middleware('admin.can:cms.admin.post-attribute.edit');

      Route::put('{id}', [PostAttributeController::class, 'update'])
        ->name('cms.admin.post-attribute.update')
        ->middleware('admin.can:cms.admin.post-attribute.edit');

      Route::delete('{id}', [PostAttributeController::class, 'destroy'])
        ->name('cms.admin.post-attribute.destroy')
        ->middleware('admin.can:cms.admin.post-attribute.destroy');
    });
  });

  Route::prefix('page')->group(function () {
    Route::get('/', [PageController::class, 'index'])
      ->name('cms.admin.page.index')
      ->middleware('admin.can:cms.admin.page.index');

    Route::get('{id}/edit', [PageController::class, 'edit'])
      ->name('cms.admin.page.edit')
      ->middleware('admin.can:cms.admin.page.edit');

    Route::put('{id}/update', [PageController::class, 'update'])
      ->name('cms.admin.page.update')
      ->middleware('admin.can:cms.admin.page.edit');

    Route::get('create', [PageController::class, 'create'])
      ->name('cms.admin.page.create')
      ->middleware('admin.can:cms.admin.page.create');

    Route::get('{id}/move-up', [PageController::class, 'moveUp'])->name('cms.admin.page.move-up');
    Route::get('{id}/move-down', [PageController::class, 'moveDown'])->name('cms.admin.page.move-down');

    Route::post('store', [PageController::class, 'store'])
      ->name('cms.admin.page.store')
      ->middleware('admin.can:cms.admin.page.create');

    Route::delete('{id}/destroy', [PageController::class, 'destroy'])
      ->name('cms.admin.page.destroy')
      ->middleware('admin.can:cms.admin.page.destroy');
  });

  Route::prefix('comment')->group(function () {

    Route::post('{id}/reply', [CommentController::class, 'reply'])->name('cms.admin.comment.reply');

    Route::post('publish', [CommentController::class, 'publish'])
      ->name('cms.admin.comment d.publish')
      ->middleware('admin.can:cms.admin.comment.publish');

    Route::delete('{id}/destroy', [CommentController::class, 'destroy'])
      ->name('cms.admin.comment.destroy')
      ->middleware('admin.can:cms.admin.comment.destroy');
  });
});
