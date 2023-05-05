<?php

namespace Module\Cms\Models;

use DnSoft\Core\Traits\AttributeAndTranslatableTrait;
use DnSoft\Core\Traits\TreeCacheableTrait;
use Illuminate\Database\Eloquent\Model;
use Module\Cms\Http\Controllers\Web\PageController;
use Module\Seo\Traits\SeoableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Module\Cms\Models\Page
 *
 * @property int $id
 * @property array|null $name
 * @property string $key
 * @property array|null $description
 * @property array|null $content
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property mixed $entity
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Page hasAttribute($key, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Page extends Model
{
  use TreeCacheableTrait;
  use SeoableTrait;
  use AttributeAndTranslatableTrait;
  // use SearchableTrait;

  protected $table = 'cms__pages';

  protected static $logName = 'cms_page';

  protected $fillable = [
    'name',
    'key',
    'description',
    'content',
    'is_active',
    'url',
    'parent_id',
  ];

  public $translatable = [
    'name',
    'description',
    'content',
  ];

  /**
   * Searchable rules.
   *
   * @var array
   */
  protected $searchable = [
    /**
     * Columns and their priority in search results.
     * Columns with higher values are more important.
     * Columns with equal values have equal importance.
     *
     * @var array
     */
    'columns' => [
      'cms__pages.name' => 10,
      'cms__pages.description' => 10,
    ],
  ];

  public function getUrl(): string
  {
    return route('cms.web.page.detail', $this->id);
  }

  public function getController(): string
  {
    return PageController::class;
  }

  public function getSubPages()
  {
    return $this->hasMany($this, 'parent_id');
  }
}
