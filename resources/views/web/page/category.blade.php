@extends('cms::web.master')

@section('seometa')
    @seometa
@endsection

@section('title', settings('name_website').' - '.$item->name)

@section('content')
    <div class="w3l-homeblock2 py-2">
        @foreach($subCategory as $subCat)
            @php($postsInCat = get_posts_by_category_id($subCat->id))
            @if ($postsInCat->count() > 0)
                <div class="container pt-md-4 pb-md-5">
                <!-- block -->
                    <h3 class="category-title mb-3"> {{ $subCat->name }}</h3>
                    <div class="row">
                        @foreach($postsInCat as $post)
                        <div class="col-lg-3 col-md-6 mt-lg-5 mt-4">
                            <div class="card">
                                <div class="card-header p-0 position-relative">
                                    <a href="{{ $post->url }}">
                                        <img class="card-img-bottom d-block radius-image-full" src="{{ $post->thumbnail }}"
                                             alt="Card image cap">
                                    </a>
                                </div>
                                <div class="card-body blog-details">
                                    <a href="{{ $post->url }}" class="blog-desc" title="{{ $post->name }}">{{ $post->name }}</a>
                                    <div>
                                        <p> {{ $post->created_at->format('Y-m-d') }} </p>
                                        <span class="fa fa-clock-o"></span> {{ convert_to_min_read($post->content) }} min read
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if ($postsInCat->count() > config('cms.item_in_category'))
                        <div class="row mt-4">
                            <div class="col-lg-8 col-md-6 item"></div>
                            <div class="col-lg-4 col-md-6 item text-right">
                                <a href="{{$subCat->url}}" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    @endif
                    <hr>
                </div>
            @endif
        @endforeach
    </div>
@stop
