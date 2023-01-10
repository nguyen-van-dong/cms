<?php

namespace Module\Cms\Http\Controllers\Web;

use Module\Cms\Repositories\PageRepositoryInterface;
use Module\Seo\Http\Controllers\Web\SeoController;

class PageController extends SeoController
{
    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function detail($id)
    {
        $item = $this->pageRepository->getById($id);
        return view('cms::web.page.page-detail', compact('item'));
    }

    public function renderPage($key)
    {
        if (is_numeric($key)) {
            $page = $this->pageRepository->find($key);
            $key = $page->key;
        } else {
            $page = $this->pageRepository->findByKey($key);
        }
        return view('cms::web.page.detail', compact('key', 'page'));
    }
}
