<div class="col-md-9 col-sm-9">
  <ul class="nav nav-tabs scrollable mr-3">
    <li class="nav-item">
      <a class="nav-link active save-tab" data-toggle="pill" href="#catalogProductInfo">
        {{ __('cms::page.tabs.info') }}
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link save-tab" data-toggle="pill" href="#catalogProductSeo">
        {{ __('cms::page.tabs.seo') }}
      </a>
    </li>
  </ul>

  <div class="tab-content mt-3">
    <div class="tab-pane fade show active" id="catalogProductInfo">
      <div class="row">
        <div class="col-12 col-md-12">
          @input(['name' => 'name', 'label' => __('cms::page.name'), ])
          @slug(['name' => 'key', 'label' => __('cms::page.key'), 'field_slug' => 'name'])
          @textarea(['name' => 'description', 'label' => __('cms::page.description'), 'autoResize' => true,])
          @ckeditor(['name' => 'content', 'label' => __('cms::page.content'),])
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="catalogProductSeo">
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
  <hr>
  <x-button-save-edit />
</div>