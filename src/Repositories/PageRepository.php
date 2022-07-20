<?php

namespace Module\Cms\Repositories;

use Dnsoft\Core\Repositories\BaseRepository;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
    public function findByKey($key)
    {
        return $this->model->where(['key' => $key])->first();
    }
}
