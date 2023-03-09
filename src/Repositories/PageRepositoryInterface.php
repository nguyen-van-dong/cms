<?php

namespace Module\Cms\Repositories;

use DnSoft\Core\Repositories\BaseRepositoryInterface;

interface PageRepositoryInterface extends BaseRepositoryInterface
{
    public function findByKey($key);
}
