<?php

namespace Module\Cms\Repositories;

use Dnsoft\Core\Repositories\BaseRepository;
use Dnsoft\Core\Repositories\NestedRepositoryTrait;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    use NestedRepositoryTrait;

    public function paginateTree($itemPerPage)
    {
        $data = $this->model->query();

        if ($name = request('name')) {
            $data->where(function ($q) use ($name) {
                foreach (explode(' ', $name) as $keyword) {
                    if ($keyword = trim($keyword)) {
                        $q->where('name', 'like', "%{$keyword}%");
                    }
                }
            });
        }

        return $data
            ->withDepth()
            ->defaultOrder()
            ->paginate($itemPerPage);
    }
}
