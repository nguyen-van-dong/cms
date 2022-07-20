<?php

namespace Module\Cms\Services;

use Module\Cms\Repositories\PageRepositoryInterface;

class PageService
{
    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function renderPage($key): string
    {
        try {
            $page = $this->findKey($key);
            return $page->content;
        } catch (\Exception $exception) {
            return '<strong>' . 'Page not found' .'</strong>';
        }
    }

    public function findKey($key)
    {
        return $this->pageRepository->findByCondition(['key' => $key])->first();
    }
}
