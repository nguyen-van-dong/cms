<?php

namespace Module\Cms\Http\Resources;

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
      'slug' => $this->seoUrl()->first()->request_path ?? '',
      'thumbnail' => $this->thumbnail,
      'author' => $this->author->display_name ? $this->author->display_name : $this->author->name,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'comments_count' => $this->comments->count(),
      'count_like' => $this->like,
      'viewed' => $this->view_count,
    ];
  }
}
