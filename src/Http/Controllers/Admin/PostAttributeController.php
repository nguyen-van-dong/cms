<?php

namespace Module\Cms\Http\Controllers\Admin;

use DnSoft\Eav\Http\Controllers\Admin\AttributeController;
use Module\Cms\Models\Post;

class PostAttributeController extends AttributeController
{

    public function getAdminMenuId(): string
    {
        return 'cmsPostAttribute';
    }

    public function getEntityType(): string
    {
        return Post::class;
    }

    public function getNamePrefixRoute(): string
    {
        return 'cms.admin.post-attribute.';
    }
}
