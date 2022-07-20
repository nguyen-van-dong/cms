<?php

namespace Module\Cms\Http\Controllers\Web;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Module\Cms\Models\Post;
use Module\Cms\Repositories\PostRepositoryInterface;
use Module\Seo\Http\Controllers\Web\SeoController;

class PostController extends SeoController
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
     * @param $id
     * @return Application|Factory|View
     */
    public function detail($id)
    {
        $item = $this->postRepository->getById($id);
        $postsRelated = Post::whereNotIn('id', [$item->id])->latest()->limit(5)->with('author')->get();
        return view('cms::web.page.post-detail', compact('item', 'postsRelated'));
    }
}
