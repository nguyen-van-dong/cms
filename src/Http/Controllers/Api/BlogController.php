<?php

namespace Module\Cms\Http\Controllers\Api;

use Module\Cms\Http\Resources\CategoryDetailResource;
use Module\Cms\Http\Resources\CategoryResource;
use Module\Cms\Http\Resources\PostDetailResource;
use Module\Cms\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Module\Cms\Models\Category;
use Module\Cms\Models\Post;
use Module\Seo\Models\Url;

class BlogController extends Controller
{
  /**
   * Get categories
   */
  public function categories()
  {
    $categoriesCached = Cache::get('categories');
    if (!$categoriesCached) {
      $categories = Category::with(['posts' => function ($query) {
        $query->where('is_active', 1);
      }])->where('is_active', 1)->defaultOrder()->get();
      Cache::put('categories', $categories);
    } else {
      $categories = $categoriesCached;
    }

    return CategoryResource::collection($categories);
  }

  /**
   * Get posts by category id
   */
  public function detail($id)
  {
    $category = Category::findOrFail($id);
    $posts = $category->posts()->with(['author', 'categories', 'comments' => function ($query) {
      $query->where('is_published', 1);
    }])->where('is_active', 1)->orderBy('published_at', 'DESC')->paginate(10);
    return CategoryDetailResource::collection($posts);
  }

  /**
   * Get posts or search
   */
  public function posts(Request $request)
  {
    $keyword = $request->get('q');
    if ($keyword) {
      $posts = Post::with(['author', 'categories', 'comments' => function ($query) {
        $query->where('is_published', 1);
      }])->where('is_active', true)
         ->where(function($query) use($keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('content', 'LIKE', '%'.$keyword.'%');
          })
         ->orderBy('id', 'DESC')->paginate(8);
    } else {
      $posts = Post::with(['author', 'categories', 'comments' => function ($query) {
        $query->where('is_published', 1);
      }])->where('is_active', true)->orderBy('id', 'DESC')->paginate(8);
    }
    return PostResource::collection($posts);
  }

  /**
   * Get post by slug
   */
  public function getPostBySlug($slug)
  {
    if (is_numeric($slug)) {
      $post = Post::findOrFail($slug);
      return new PostDetailResource($post);
    }
    $url = Url::where(['urlable_type' => 'Module\Cms\Models\Post', 'request_path' => $slug])->first();
    $post = Post::findOrFail($url->urlable_id);
    return new PostDetailResource($post);
  }
}
