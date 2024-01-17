<?php

namespace Module\Cms\Http\Resources;

use DnSoft\Core\Utils\Core;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
      'description' => $this->description,
      'content' => $this->content,
      'url' => $this->url,
      'slug' => Core::buildSlug($this->url),
      'image' => $this->thumbnail ? $this->thumbnail->url : null,
      'author' => $this->author->display_name ? $this->author->display_name : $this->author->name,
      'created_at' => $this->created_at->toFormattedDateString(),
      'comments_count' => $this->comments()->where('is_published', true)->count(),
      'count_like' => $this->like,
      'viewed' => $this->view_count,
    ];
  }
}
