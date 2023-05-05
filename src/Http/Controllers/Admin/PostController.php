<?php

namespace Module\Cms\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use DnSoft\Media\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Module\Cms\Http\Requests\PostRequest;
use Module\Cms\Models\Post;
use Module\Cms\Repositories\PostRepositoryInterface;
use Module\Comment\Models\Comment;

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
    $keyword = request('keyword');
    $published = request('published');
    if ($keyword && !$published) {
      $items = Post::where('name', 'like', '%' . $keyword . '%')
        ->orWhere('description', 'like', '%' . $keyword . '%')
        ->orWhere('content', 'like', '%' . $keyword . '%')
        ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
    } else if ($keyword && $published) {
      $items = Post::where('is_active', $published)
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->orWhere('description', 'like', '%' . $keyword . '%')
        ->orWhere('content', 'like', '%' . $keyword . '%')
        ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
    } else if (!$keyword && (isset($published) && $published == 0) || (isset($published) && $published == 1)) {
      $items = Post::where('is_active', $published)
        ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
    } else {
      $items = $this->postRepository->paginate(10);
    }
    $version = get_version_actived();
    return view("cms::$version.admin.post.index", compact('items'));
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
    $version = get_version_actived();
    return view("cms::$version.admin.post.create", compact('item'));
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
    $version = get_version_actived();
    return view("cms::$version.admin.post.edit", compact('item'));
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
    if ($request->is_active && !$post->published_at) {
      $post->update([
        'published_at' => now(),
      ]);
    }
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

  /**
   * Show comment of post
   */
  public function showComment($id)
  {
    MenuAdmin::activeMenu('cms_post');
    $keyword = request('keyword');
    if ($keyword) {
      $items = Comment::where(['table_id' => $id, 'table_type' => Post::class])
        ->where('title', 'like', '%' . $keyword . '%')
        ->orWhere('content', 'like', '%' . $keyword . '%')
        ->withDepth()->defaultOrder()->get();
    } else {
      $items = Comment::where(['table_id' => $id, 'table_type' => Post::class])->withDepth()->defaultOrder()->get();
    }
    $version = get_version_actived();
    return view("cms::$version.admin.post.comment", compact('items'));
  }

  /**
   * Pubish post
   */
  public function publish(Request $request)
  {
    $post = $this->postRepository->find($request->post_id);
    $post->update([
      'is_active' => $request->is_publish,
      'published_at' => now(),
    ]);
    return response()->json([
      'success' => true,
      'is_published' => $request->is_publish,
      'post_id' => $post->id
    ]);
  }
}
