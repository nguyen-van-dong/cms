<?php

namespace Module\Cms\Http\Resources;

use DnSoft\Core\Utils\Core;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
      'url' => $this->url,
      'slug' => Core::buildSlug($this->url),
      'counts' => $this->posts()->where('is_active', true)->count(),
      'icon' => $this->icon,
      'description' => $this->description,
    ];
  }
}
