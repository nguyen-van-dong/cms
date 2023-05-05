<?php

namespace Module\Cms\Repositories;

use DnSoft\Core\Repositories\BaseRepository;
use DnSoft\Core\Repositories\NestedRepositoryTrait;

class PageRepository extends BaseRepository implements PageRepositoryInterface
{
  use NestedRepositoryTrait;

  public function findByKey($key)
  {
    return $this->model->where(['key' => $key])->first();
  }


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
