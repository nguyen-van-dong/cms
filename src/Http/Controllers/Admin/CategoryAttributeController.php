<?php

namespace Module\Cms\Http\Controllers\Admin;

use Dnsoft\Eav\Http\Controllers\Admin\AttributeController;
use Module\Cms\Models\Category;
use Module\Cms\Models\Post;

class CategoryAttributeController extends AttributeController
{

    public function getAdminMenuId(): string
    {
        return 'cmsCategoryAttribute';
    }

    public function getEntityType(): string
    {
        return Category::class;
    }

    public function getNamePrefixRoute(): string
    {
        return 'cms.admin.category-attribute.';
    }
}
