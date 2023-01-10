<?php

use Module\Cms\Http\Controllers\Web\PageController;
use Module\Cms\Http\Controllers\Web\CategoryController;
use Module\Cms\Http\Controllers\Web\PostController;

Route::prefix(LaravelLocalization::setLocale())->group(function () {
    // Category Detail
    Route::get('category/{id}', [CategoryController::class, 'detail'])->name('cms.web.category.detail');

    // Post Detail
    Route::get('post/{id}', [PostController::class, 'detail'])->name('cms.web.post.detail');

    // Page Detail
    Route::get('page/{id}', [PageController::class, 'detail'])->name('cms.web.page.detail');

});

Route::feeds();
