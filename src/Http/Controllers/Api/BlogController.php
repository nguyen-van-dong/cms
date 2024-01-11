<?php

namespace Module\Cms\Http\Controllers\Api;

use DateTime;
use DnSoft\Core\Utils\Core;
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
    if (is_numeric($id)) {
      $category = Category::findOrFail($id);
      return new CategoryDetailResource($category);
    }
    $slug = Core::convertSlug($id);
    $url = Url::where(['urlable_type' => 'Module\Cms\Models\Category', 'request_path' => $slug])->first();
    
    $category = Category::findOrFail($url->urlable_id);
    $posts = $category->posts()->with(['author', 'categories', 'comments' => function ($query) {
      $query->where('is_published', 1);
    }])->where('is_active', 1)->orderBy('published_at', 'DESC')->paginate(10);
    return [
      'posts' => PostResource::collection($posts),
      'category' => new CategoryResource($category)
    ];
  }

  public function getCategoryDetail($id)
  {
    if (is_numeric($id)) {
      $category = Category::findOrFail($id);
      return new CategoryDetailResource($category);
    }
    $slug = Core::convertSlug($id);

    $url = Url::where(['urlable_type' => 'Module\Cms\Models\Category', 'request_path' => $slug])->first();
    $category = Category::findOrFail($url->urlable_id);
    return new CategoryDetailResource($category);
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
        ->where(function ($query) use ($keyword) {
          $query->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('content', 'LIKE', '%' . $keyword . '%');
        })
        ->orderBy('id', 'DESC')->paginate(8);
    } elseif ($month = $request->search) {
      $year = $request->year;
      if (!$year) {
        $year = date('Y');
      }
      $posts = Post::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', date('n', strtotime($month)))
        ->paginate(10);
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
    $slug = Core::convertSlug($slug);
    $url = Url::where(['urlable_type' => 'Module\Cms\Models\Post', 'request_path' => $slug])->first();
    $post = Post::findOrFail($url->urlable_id);
    $catIds = $post->categories->pluck('id');
    $relatedPosts = null;
    if ($catIds->count() > 0) {
      $relatedPosts = Post::whereHas('categories', function ($query) use ($catIds) {
        $query->whereIn('id', $catIds);
      })->where('id', '!=', $post->id)->inRandomOrder()->limit(2)->get();
    }
    return [
      'post' => new PostDetailResource($post),
      'related_posts' => $relatedPosts ? PostDetailResource::collection($relatedPosts) : []
    ];
  }

  public function getArchives(Request $request)
  {
    $year = $request->year;
    if (!$year) {
      $year = date('Y');
    }
    $posts = Post::whereYear('created_at', $year)->get();
    $countsPerMonth = [];
    $posts->each(function ($item) use (&$countsPerMonth) {
      $createdAt = \Carbon\Carbon::parse($item['created_at']);
      // Get the month and year from the created_at timestamp
      $month = $createdAt->format('n'); // 'n' returns month without leading zeros (1 to 12)
      $year = $createdAt->format('Y');

      // Increment the count for that month
      $dateObj = DateTime::createFromFormat('!m', $month);
      $monthName = $dateObj->format('F');
      $countsPerMonth[$year][$monthName] = isset($countsPerMonth[$year][$monthName]) ? $countsPerMonth[$year][$monthName] + 1 : 1;
    });
    return response()->json($countsPerMonth[$year]);
  }
}
