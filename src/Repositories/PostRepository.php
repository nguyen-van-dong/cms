<?php

namespace Module\Cms\Repositories;

use DnSoft\Core\Repositories\AuthorRepositoryInterface;
use DnSoft\Core\Repositories\AuthorRepositoryTrait;
use DnSoft\Core\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface, AuthorRepositoryInterface
{
    use AuthorRepositoryTrait;
}
