<?php

namespace Module\Cms\Repositories;

use Dnsoft\Core\Repositories\BaseRepositoryInterface;

interface PageRepositoryInterface extends BaseRepositoryInterface
{
    public function findByKey($key);
}
