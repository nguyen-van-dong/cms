<?php

namespace Module\Cms\Http\Resources;

use DnSoft\Core\Utils\Core;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
      'name' => $this->name,
      'email' => $this->email,
      'phone' => $this->phone,
      'content' => $this->content,
    ];
  }
}
