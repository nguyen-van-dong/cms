<?php

namespace Module\Cms\Http\Controllers\Admin;

use Dnsoft\Core\Facades\MenuAdmin;
use Dnsoft\Media\Models\Mediable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Module\Cms\Http\Requests\CategoryRequest;
use Module\Cms\Models\Category;
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

        return view('cms::admin.category.index', compact('items'));
    }

    public function create(Request $request)
    {
        MenuAdmin::activeMenu('cms_category');

        $item = [];

        return view('cms::admin.category.create', compact('item'));
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

        return view('cms::admin.category.edit', compact('item'));
    }

    public function show($id)
    {
        MenuAdmin::activeMenu('cms_category');

        $category = $this->categoryRepository->find($id);

        $items = $category->posts()->paginate(10);

        return view('cms::admin.post.index', compact('category', 'items'));
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
