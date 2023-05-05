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

  /**
   * Category detail
   */
  public function detail($id)
  {
    $totalPosts = Post::where('is_active', 1)->count();
    $item = $this->categoryRepository->getById($id);
    $categories = Category::with(['posts' => function ($query) {
      $query->where('is_active', 1);
    }])->where('is_active', 1)->defaultOrder()->get();
    $posts = $item->posts()->where('is_active', 1)->orderBy('id', 'DESC')->paginate(10);
    $categoryDetail = config('cms.category_detail_v1');
    return view($categoryDetail, compact('item', 'posts', 'totalPosts', 'categories'));
  }
}
