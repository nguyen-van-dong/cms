<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ __('More information') }}</h3>
    </div>
    <div class="card-body">
        <div class="col-12 col-md-12">
            @singleFile([
                'name' => 'thumbnail',
                'type' => 'file',
                'label' => __('Thumbnail'),
                'idHolder' => 'thumbnailPostHolder',
                'files' => 'files',
            ])

            @tags(['label' => 'Tags'])

            @checkbox(['name' => 'is_featured', 'label' => __('Is new?'),])
        </div>
    </div>
</div>
