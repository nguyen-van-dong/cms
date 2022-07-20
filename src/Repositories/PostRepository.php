<?php

namespace Module\Cms\Repositories;

use Dnsoft\Core\Repositories\AuthorRepositoryInterface;
use Dnsoft\Core\Repositories\AuthorRepositoryTrait;
use Dnsoft\Core\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface, AuthorRepositoryInterface
{
    use AuthorRepositoryTrait;
}
