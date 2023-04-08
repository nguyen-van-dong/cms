<?php

use Illuminate\Support\Collection;
use Module\Cms\Models\Post;

if (!function_exists('get_cms_category_parent_options'))
{
    /**
     * @return array
     */
    function get_cms_category_parent_options(): array
    {
        $options = [];

        $categoryTreeList = \Module\Cms\Models\Category::withDepth()->get()->toFlatTree();
        foreach ($categoryTreeList as $item) {
            $options[] = [
                'value' => $item->id,
                'label' => trim(str_pad('', $item->depth * 3, '-')).' '.$item->name,
            ];
        }
        return $options;
    }
}

if (!function_exists('module_menu__get_all_pages'))
{
    /**
     * @return array
     */
    function module_menu__get_all_pages(): array
    {
        $options = [];
        $pages = \Module\Cms\Models\Page::all();
        foreach ($pages as $key => $item) {
            $options[] = [
                'value' => $item->id,
                'label' => $item->name,
            ];
        }

        return $options;
    }
}


if (!function_exists('get_cms_catalog_category_parent_options'))
{
    /**
     * @return array
     */
    function get_cms_catalog_category_parent_options(): array
    {
        $options = [];

        $categoryTreeList = \Module\Cms\Models\Category::all();
        foreach ($categoryTreeList as $item) {
            $options[] = [
                'value' => $item->id,
                'label' => trim(str_pad('', $item->depth * 3, '-')).' '.$item->name,
            ];
        }

        return $options;
    }
}

if (!function_exists('convert_to_min_read'))
{
    /**
     * @param $content
     * @return float
     */
    function convert_to_min_read($content): float
    {
        $count = round(str_word_count(strip_tags(htmlspecialchars_decode($content))) / config('cms.count_words_in_minute'));
        if ($count <= 0) {
            $count = 1;
        }
        return $count;
    }
}

if (!function_exists('get_random_posts'))
{
    /**
     * @param $limit
     * @param null $idPostCurrent
     * @return Collection
     */
    function get_random_posts($limit, $idPostCurrent = null): Collection
    {
        if ($idPostCurrent) {
            return Post::whereNotIn('id', [$idPostCurrent])->inRandomOrder()->limit($limit)->get();
        }
        return Post::inRandomOrder()->limit($limit)->get();
    }
}

if (!function_exists('get_posts_by_category_id'))
{
    /**
     * @param $categoryId
     * @return mixed
     */
    function get_posts_by_category_id($categoryId)
    {
        $category = app(\Module\Cms\Repositories\CategoryRepositoryInterface::class)->getById($categoryId);
        return $category->posts()->paginate(config('cms.item_in_category', 8));
    }
}

if (!function_exists('get_sub_category'))
{
    function get_sub_category($categoryId)
    {
        $item = app(\Module\Cms\Repositories\CategoryRepositoryInterface::class)->getById($categoryId);
        return $item->children()->get();
    }
}
