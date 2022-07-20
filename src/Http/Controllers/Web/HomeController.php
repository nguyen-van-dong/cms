<?php

namespace Module\Cms\Http\Controllers\Web;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Module\Cms\Models\Post;
use Module\Cms\Repositories\PostRepositoryInterface;
use Spatie\QueryBuilder\QueryBuilder;

class HomeController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $latestPosts = Post::limit(6)->latest()->get();
        return view('cms::web.home.index', compact('latestPosts'));
    }

    /**
     * @return Application|Factory|View
     */
    public function aboutMe()
    {
        return view('cms::web.home.about-me');
    }

    /**
     * @return Application|Factory|View
     */
    public function search()
    {
        $posts = Post::where('is_active', 1)
            ->search(request('q'))
            ->paginate(20);
        return view('cms::web.page.search', compact('posts'));
    }
}
