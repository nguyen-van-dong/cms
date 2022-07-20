<ul class="nav nav-tabs scrollable">
    <li class="nav-item">
        <a class="nav-link active save-tab" data-toggle="pill" href="#catalogProductInfo">
            {{ __('cms::post.tabs.info') }}
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
                @input(['name' => 'name', 'label' => __('cms::post.name'), ])
                @sumoselect(['name' => 'categories', 'label' => __('cms::post.category'), 'options' => get_cms_category_parent_options()])
                @textarea(['name' => 'description', 'label' => __('cms::post.description'), 'autoResize' => true,])
                @tinyeditor(['name' => 'content', 'label' => __('cms::post.content'),])

                @mediafile(['name' => 'thumbnail', 'label' => __('cms::post.thumbnail'),])

            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="catalogProductSeo">
        @seo
    </div>
</div>
