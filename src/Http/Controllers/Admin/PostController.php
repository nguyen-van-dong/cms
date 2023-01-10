<?php

namespace Module\Cms\Http\Controllers\Admin;

use Dnsoft\Core\Facades\MenuAdmin;
use Dnsoft\Media\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Cms\Http\Requests\PostRequest;
use Module\Cms\Models\Post;
use Module\Cms\Repositories\PostRepositoryInterface;

class PostController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = $this->postRepository->paginate(10);
        return view('cms::admin.post.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        MenuAdmin::activeMenu('cms_post');
        $item = null;
        return view('cms::admin.post.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return Response
     */
    public function store(PostRequest $request)
    {
        $post = $this->postRepository->createWithAuthor($request->all());

        if ($request->input('continue')) {
            return redirect()
                ->route('cms.admin.post.edit', $post->id)
                ->with('success', __('cms::post.notification.created'));
        }

        return redirect()
            ->route('cms.admin.post.index')
            ->with('success', __('cms::post.notification.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        MenuAdmin::activeMenu('cms_post');
        $item = $this->postRepository->getById($id);
        return view('cms::admin.post.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param $id
     * @return Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = $this->postRepository->updateById($request->all(), $id);

        if ($request->input('continue')) {
            return redirect()
                ->route('cms.admin.post.edit', $post->id)
                ->with('success', __('cms::post.notification.updated'));
        }

        return redirect()
            ->route('cms.admin.post.index')
            ->with('success', __('cms::post.notification.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request  $request
     * @param  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $item = $this->postRepository->delete($id);
        if ($request->ajax()) {
            Session::flash('success', __('cms::post.notification.deleted'));
            return response()->json([
                'success' => true,
            ]);
        }

        return redirect()
            ->route('cms.admin.post.index')
            ->with('success', __('cms::post.notification.deleted'));
    }
}
