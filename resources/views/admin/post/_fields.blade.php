<ul class="nav nav-tabs scrollable">
  <li class="nav-item">
    <a class="nav-link active save-tab" data-toggle="pill" href="#catalogProductInfo">
      {{ __('cms::post.tabs.info') }}
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link save-tab" data-toggle="pill" href="#cmsComment">
      {{ __('Comment') }}
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link save-tab" data-toggle="pill" href="#cmsPostAttribute">
      {{ __('cms::post.tabs.attribute') }}
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link save-tab" data-toggle="pill" href="#catalogProductSeo">
      {{ __('cms::post.tabs.seo') }}
    </a>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane fade show active" id="catalogProductInfo">
    <div class="row">
      <div class="col-12 col-md-12">
        @input(['name' => 'name', 'label' => __('cms::post.name'), 'require' => true])
        @sumoselect(['name' => 'categories', 'label' => __('cms::post.category'), 'multiple' => true, 'options' => get_cms_category_parent_options()])
        @simpleCkeditor(['name' => 'description', 'label' => __('cms::post.description'), ])
        @simpleCkeditor(['name' => 'content', 'label' => __('cms::post.content'), ])
        @checkbox(['name' => 'is_active', 'label' => __('Is Published'),])
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="cmsComment">
    @include('cms::admin.post.comment', ['items' => $item->comments()->withDepth()->defaultOrder()->get(), 'post' => $item])
  </div>

  <div class="tab-pane fade" id="cmsPostAttribute">
    @attributes(['entityType' => \Module\Cms\Models\Post::class])
  </div>

  <div class="tab-pane fade" id="catalogProductSeo">
    @seo
  </div>
</div>