<div class="col-md-9 col-sm-9">
  <ul class="nav nav-tabs scrollable">
    <li class="nav-item">
      <a class="nav-link active save-tab" data-toggle="pill" href="#catalogProductInfo">
        {{ __('Thông tin chung') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link save-tab" data-toggle="pill" href="#cmsCategoryAttribute">
        {{ __('cms::category.tabs.attribute') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link save-tab" data-toggle="pill" href="#catalogProductSeo">
        {{ __('cms::post.tabs.seo') }}
      </a>
    </li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active mt-3" id="catalogProductInfo">
      <div class="row">
        <div class="col-12 col-md-12">
          @input(['name' => 'name', 'label' => __('cms::post.name'), ])
          @sumoselect(['name' => 'categories', 'label' => __('cms::post.category'), 'multiple' => true, 'options' => get_cms_category_parent_options()])
          @textarea(['name' => 'description', 'label' => __('cms::post.description'), ])
          @ckeditor(['name' => 'content', 'label' => __('cms::post.content'), ])
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="cmsCategoryAttribute">
      @attributes(['entityType' => \Module\Cms\Models\Post::class])
    </div>
    <div class="tab-pane fade mt-3" id="catalogProductSeo">
      @seo
    </div>
  </div>
</div>
<div class="col-md-3 col-sm-3">
  <div class="alert alert-info" role="alert">
    @translatableAlert
  </div>
  @translatable
  <!-- <hr> -->
  @checkbox(['name' => 'is_active', 'label' => __('Is Published'), 'default' => true])
  @mediaV2(['name' => 'image', 'id' => 'image-component-1', 'type' => 'image', 'show_button' => true])
  <hr>
  <x-button-save-edit />
</div>