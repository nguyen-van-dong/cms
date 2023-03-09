<?php

namespace Module\Cms\Http\Controllers\Admin;

use DnSoft\Core\Facades\MenuAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Cms\Http\Requests\CategoryRequest;
use Module\Cms\Repositories\CategoryRepository;
use Module\Cms\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{ /**
 * @var CategoryRepositoryInterface|CategoryRepository
 */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        $items = $this->categoryRepository->paginateTree($request->input('max', 20));
        $version = get_version_actived();
        return view("cms::$version.'admin.category.index", compact('items'));
    }

    public function create(Request $request)
    {
        MenuAdmin::activeMenu('cms_category');

        $item = [];
        $version = get_version_actived();
        return view("cms::$version.admin.category.create", compact('item'));
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
        $version = get_version_actived();
        return view("cms::$version.admin.category.edit", compact('item'));
    }

    public function show($id)
    {
        MenuAdmin::activeMenu('cms_category');
        $category = $this->categoryRepository->find($id);
        $keyword = request('keyword');
        $published = request('published');
        if ($keyword && !$published) {
            $items = $category->posts()->where('name', 'like', '%'. $keyword .'%')
            ->orWhere('description', 'like', '%'. $keyword .'%')
            ->orWhere('content', 'like', '%'. $keyword .'%')
            ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        } else if ($keyword && $published) {
            $items = $category->posts()->where('is_active', $published)
            ->orWhere('name', 'like', '%'. $keyword .'%')
            ->orWhere('description', 'like', '%'. $keyword .'%')
            ->orWhere('content', 'like', '%'. $keyword .'%')
            ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        } else if (!$keyword && (isset($published) && $published == 0) || (isset($published) && $published == 1)) {
            $items = $category->posts()->where('is_active', $published)
            ->orderBy('id', 'DESC')->paginate(10)->withQueryString();
        } else {
            $items = $category->posts()->orderBy('id', 'DESC')->paginate(10);
        }

        $version = get_version_actived();
        return view("cms::$version.admin.post.index", compact('category', 'items'));
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

        if ($request->wantsJson()) {
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
