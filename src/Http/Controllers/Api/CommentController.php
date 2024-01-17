<?php

namespace Module\Cms\Http\Controllers\Api;

use DnSoft\Core\Utils\BuildTree;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Module\Cms\Http\Resources\CommentResource;
use Module\Cms\Models\Comment;

class CommentController extends Controller
{
  public function getComments($post_id)
  {
    $items = Comment::wherePostId($post_id)->get();
    return BuildTree::buildCommentTree($items);
  }

  /**
   * Store a comment
   */
  public function store(Request $request)
  {
    $item = Comment::create($request->all());
    return new CommentResource($item);
  }
}