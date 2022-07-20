<?php

namespace Module\Cms\Models;

use Dnsoft\Core\Traits\AttributeAndTranslatableTrait;

use Dnsoft\Core\Traits\TreeCacheableTrait;
use Dnsoft\Media\Traits\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Module\Cms\Http\Controllers\Web\CategoryController;
use Module\Seo\Traits\SeoableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Module\Cms\Models\Category
 *
 * @property int $id
 * @property array|null $name
 * @property array|null $description
 * @property string|null $slug
 * @property int $is_active
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Kalnoy\Nestedset\Collection|Category[] $children
 * @property-read int|null $children_count
 * @property mixed $entity
 * @property-read array $translations
 * @property mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dnsoft\Media\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read Category|null $parent
 * @property-read \Kalnoy\Nestedset\Collection|Category[] $posts
 * @property-read int|null $posts_count
 * @property-read \Module\Seo\Models\Meta|null $seoMeta
 * @property-read \Module\Seo\Models\Url|null $seoUrl
 * @property-read \Illuminate\Database\Eloquent\Collection|\Module\Seo\Models\Url[] $seoUrls
 * @property-read int|null $seo_urls_count
 * @property-write mixed $seo_url
 * @property-write mixed $seometa
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Category d()
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Category hasAttribute($key, $value)
 * @method static \Dnsoft\Core\Support\TreeCacheableQueryBuilder|Category newModelQuery()
 * @method static \Dnsoft\Core\Support\TreeCacheableQueryBuilder|Category newQuery()
 * @method static \Dnsoft\Core\Support\TreeCacheableQueryBuilder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use TreeCacheableTrait;
    use AttributeAndTranslatableTrait;
    use HasMediaTrait;
    use LogsActivity;
    use SeoableTrait;

    protected static string $logName = 'cms_category';

    protected $table = 'cms__categories';

    protected $fillable = [
        'name',
        'parent_id',
        'description',
        'is_active',
    ];

    public array $translatable = [
        'name',
        'description',
    ];

    public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'cms__category_post');
    }

    public function getUrl(): string
    {
        return route('cms.web.category.detail', $this->id);
    }

    public function getController(): string
    {
        return CategoryController::class;
    }
}
