<?php

namespace Module\Cms\Models;

use Dnsoft\Core\Traits\AttributeAndTranslatableTrait;
use Dnsoft\Media\Traits\HasMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Module\Cms\Http\Controllers\Web\PostController;
use Module\Seo\Traits\SeoableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Module\Cms\Models\Post
 *
 * @property int $id
 * @property array|null $name
 * @property array|null $description
 * @property array|null $content
 * @property string|null $slug
 * @property string|null $post_type
 * @property int $is_active
 * @property int $is_sticky
 * @property int|null $sort_order
 * @property int|null $category_id
 * @property string|null $author_type
 * @property int|null $author_id
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read Model|\Eloquent $author
 * @property \Kalnoy\Nestedset\Collection|\Module\Cms\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property mixed $entity
 * @property-read mixed $image
 * @property-read array $translations
 * @property mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dnsoft\Media\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Module\Seo\Models\Meta|null $seoMeta
 * @property-read \Module\Seo\Models\Url|null $seoUrl
 * @property-read \Illuminate\Database\Eloquent\Collection|\Module\Seo\Models\Url[] $seoUrls
 * @property-read int|null $seo_urls_count
 * @property-write mixed $gallery
 * @property-write mixed $seo_url
 * @property-write mixed $seometa
 * @method static \Illuminate\Database\Eloquent\Builder|Post hasAttribute($key, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAuthorType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsSticky($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{
    use AttributeAndTranslatableTrait;
    use HasMediaTrait;
    use LogsActivity;
    use SeoableTrait;
    use SearchableTrait;

    protected static $logName = 'cms_post';

    protected $table = 'cms__posts';

    protected $fillable = [
        'name',
        'description',
        'content',
        'is_active',
        'categories',
        'thumbnail'
    ];

    public $translatable = [
        'name',
        'description',
        'content',
    ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'cms__posts.name' => 10,
            'cms__posts.content' => 10,
        ],
    ];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'cms__category_post');
    }

    public function setCategoriesAttribute($value)
    {
        static::saved(function ($model) use ($value) {
            !$value || $this->categories()->sync($value);
        });
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function setThumbnailAttribute($value)
    {
        static::saved(function ($model) use ($value) {
            $model->syncMedia($value, 'thumbnail');
        });
    }

    public function getThumbnailAttribute()
    {
        return $this->getFirstMedia('thumbnail');
    }

    public function getUrl(): string
    {
        return route('cms.web.post.detail', $this->id);
    }

    public function getController(): string
    {
        return PostController::class;
    }
}
