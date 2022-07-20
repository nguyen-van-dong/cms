<?php

namespace Module\Cms\Http\Controllers\Web;

use Module\Cms\Repositories\CategoryRepositoryInterface;
use Module\Seo\Http\Controllers\Web\SeoController;

class CategoryController extends SeoController
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {

    }

    public function detail($id)
    {
        $item = $this->categoryRepository->getById($id);
        $subCategory = $item->children()->get();
        if ($subCategory->count() > 0) {
            return view('cms::web.page.category', compact('item', 'subCategory'));
        } else {
            $posts = $item->posts()->paginate(config('cms.item_in_category', 8));
            return view('cms::web.page.category-detail', compact('item', 'posts'));
        }
    }
}
