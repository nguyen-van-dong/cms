<?php

namespace Module\Cms\Http\Controllers\Web;

use Module\Cms\Models\Category;
use Module\Cms\Models\Post;
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
        $totalPosts = Post::count();
        $item = $this->categoryRepository->getById($id);
        $categories = Category::where('is_active', 1)->get();
        $posts = $item->posts()->orderBy('id', 'DESC')->paginate(10);
        return view('web.blog.index', compact('item', 'posts', 'totalPosts', 'categories'));
    }
}
