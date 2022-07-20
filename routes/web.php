<?php

use Module\Cms\Http\Controllers\Web\PageController;
use Module\Cms\Http\Controllers\Web\HomeController;
use Module\Cms\Http\Controllers\Web\ContactController;
use Module\Cms\Http\Controllers\Web\CategoryController;
use Module\Cms\Http\Controllers\Web\PostController;

Route::prefix(LaravelLocalization::setLocale())->group(function () {
    //Route::get('page/{key}', [PageController::class, 'detail'])->name('cms.web.page.detail');

    if (config('cms.is_enable_route_cms')) {
        Route::get('/', [HomeController::class, 'index'])->name('cms.web.home.index');
        //Route::get('about-me', [HomeController::class, 'aboutMe'])->name('cms.web.home.about-me');
        Route::get('/contact-me', [ContactController::class, 'index'])->name('cms.web.contact.index');

        // Category Detail
        Route::get('category/{id}', [CategoryController::class, 'detail'])->name('cms.web.category.detail');

        // Post Detail
        Route::get('post/{id}', [PostController::class, 'detail'])->name('cms.web.post.detail');

        // Page Detail
        Route::get('page/{id}', [PageController::class, 'detail'])->name('cms.web.page.detail');

        // Search
        Route::get('search', [HomeController::class, 'search'])->name('cms.web.home.search');
    }
});
