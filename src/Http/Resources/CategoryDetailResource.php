<?php

namespace Module\Cms\Http\Resources;

use DnSoft\Core\Utils\Core;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'description' => $this->description,
      'content' => $this->content,
      'thumbnail' => $this->thumbnail ? $this->thumbnail->url : null,
      'url' => Core::buildSlug($this->url),
    ];
  }
}
