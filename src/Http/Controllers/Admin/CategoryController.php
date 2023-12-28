<?php

namespace Module\Cms\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use DnSoft\Core\Utils\BuildTree;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Cms\Http\Requests\CategoryRequest;
use Module\Cms\Repositories\CategoryRepository;
use Module\Cms\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
  /**
   * @var CategoryRepositoryInterface|CategoryRepository
   */
  private $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function index(Request $request)
  {
    if (request('keyword')) {
      $items = $this->categoryRepository->paginateWithSearch('name', 10);
    } else {
      $items = $this->categoryRepository->paginateTree($request->input('max', 10));
    }
    $treeCategory = BuildTree::buildCategoryTree($items);
    $item = null;
    return view("cms::admin.category.index", compact('items', 'item', 'treeCategory'));
  }

  public function create(Request $request)
  {
    MenuAdmin::activeMenu('cms_category');

    $item = [];

    return view("cms::admin.category.create", compact('item'));
  }

  public function store(CategoryRequest $request)
  {
    $item = $this->categoryRepository->create($request->all());

    if ($request->input('continue')) {
      return redirect()
        ->route('cms.admin.category.edit', $item->id)
        ->with('success', __('cms::category.notification.created'));
    }

    return redirect()
      ->route('cms.admin.category.index')
      ->with('success', __('cms::category.notification.created'));
  }

  public function edit($id)
  {
    MenuAdmin::activeMenu('cms_category');
    $item = $this->categoryRepository->find($id);

    if (request()->ajax()) {
      $html = view("cms::admin.category.form", compact('item'))->render();
      return response()->json([
        'message' => 'Success',
        'item' => $html,
        'route' => route('cms.admin.category.update', $item->id),
        'delete_url' => route('cms.admin.category.destroy', $item->id)
      ]);
    }
    return view("cms::admin.category.edit", compact('item'));
  }

  public function show($id)
  {
    MenuAdmin::activeMenu('cms_category');
    $category = $this->categoryRepository->find($id);
    $keyword = request('keyword');
    $published = request('published');
    if ($keyword && !$published) {
      $items = $category->posts()->where('name', 'like', '%' . $keyword . '%')
        ->orWhere('description', 'like', '%' . $keyword . '%')
        ->orWhere('content', 'like', '%' . $keyword . '%')
        ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
    } else if ($keyword && $published) {
      $items = $category->posts()->where('is_active', $published)
        ->orWhere('name', 'like', '%' . $keyword . '%')
        ->orWhere('description', 'like', '%' . $keyword . '%')
        ->orWhere('content', 'like', '%' . $keyword . '%')
        ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
    } else if (!$keyword && (isset($published) && $published == 0) || (isset($published) && $published == 1)) {
      $items = $category->posts()->where('is_active', $published)
        ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
    } else {
      $items = $category->posts()->orderBy('id', 'DESC')->paginate(10);
    }


    return view("cms::admin.post.index", compact('category', 'items'));
  }

  public function update($id, CategoryRequest $request)
  {
    $item = $this->categoryRepository->updateById($request->all(), $id);

    //        $item->syncMedia($request->input('gallery', []), 'gallery');

    if ($request->input('continue')) {
      return redirect()
        ->route('cms.admin.category.edit', $item->id)
        ->with('success', __('cms::category.notification.updated'));
    }

    return redirect()
      ->route('cms.admin.category.index')
      ->with('success', __('cms::category.notification.updated'));
  }

  public function moveUp($id)
  {
    $this->categoryRepository->moveUp($id);

    return redirect()
      ->route('cms.admin.category.index')
      ->with('success', __('cms::category.notification.updated'));
  }

  public function moveDown($id)
  {
    $this->categoryRepository->moveDown($id);

    return redirect()
      ->route('cms.admin.category.index')
      ->with('success', __('cms::category.notification.updated'));
  }

  public function destroy($id, Request $request)
  {
    $this->categoryRepository->delete($id);

    if ($request->ajax()) {
      Session::flash('success', __('cms::category.notification.deleted'));
      return response()->json([
        'success' => true,
      ]);
    }

    return redirect()
      ->route('cms.admin.category.index')
      ->with('success', __('cms::category.notification.deleted'));
  }
}
