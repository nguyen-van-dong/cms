<div class="col-md-8 col-sm-8" id="form-content" style="padding-top: 10px; border: 1px #ababab solid; background: white; border-radius: 5px">
  <div class="alert alert-info" role="alert">
    @translatableAlert
  </div>
  @input(['name' => 'name', 'label' => __('cms::post.name'), ])
  @select(['name' => 'parent_id', 'is_label' => true, 'label' => __('cms::category.parent'), 'options' => get_cms_category_parent_options()])
  @textarea(['name' => 'description', 'label' => __('cms::category.description'), ])
  @checkbox(['name' => 'is_featured', 'label' => __('cms::category.is_featured') ])
  @input(['name' => 'icon', 'label' => __('Icon'), ])
  @input(['name' => 'sort', 'label' => __('Sort'), ])
  @checkbox(['name' => 'is_active', 'label' => __('Enable?'),])
  <div class="form-group row">
    <div class="col-12">
      <button type="submit" class="btn btn-primary" style="font-size: 1.1em;"><i class="fa fa-save"></i> {{ __('core::button.save') }}</button>
    </div>
  </div>
</div>
