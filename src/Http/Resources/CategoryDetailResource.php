<?php

namespace Module\Cms\Http\Resources;

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
      'title' => $this->name,
      'description' => strip_tags($this->description),
      'content' => $this->content,
      'thumbnail' => $this->thumbnail,
      'url' => $this->url,
      'author' => $this->author->display_name ? $this->author->display_name : $this->author->name,
      'category' => $this->categories()->first()->name ?? '',
      'comments_count' => $this->comments->count(),
      'count_like' => $this->like,
    ];
  }
}
