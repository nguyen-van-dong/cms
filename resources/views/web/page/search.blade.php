@extends('cms::web.master')

@section('seometa')
{{--    @seometa--}}
@endsection

@section('title', settings('name_website').' - '. request('q'))

@section('content')
    <div class="w3l-homeblock2">
        <div class="container pt-md-4 pb-md-5">
            <!-- block -->
            <h6 class="category-title mb-3">{{ __('cms::web.result', ['count' => $posts->count()]) }} `<strong>{{ request('q') }}`</strong> </h6>
            <div class="row">
                @if ($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 mt-lg-5 mt-4">
                            <div class="card">
                                <div class="card-header p-0 position-relative">
                                    <a href="{{ $post->url }}">
                                        <img class="card-img-bottom d-block radius-image-full" src="{{ $post->thumbnail }}"
                                             alt="Card image cap">
                                    </a>
                                </div>
                                <div class="card-body blog-details">
                                    <a href="{{ $post->url }}" class="blog-desc" title="{{ $post->name }}">{{ $post->name }}</a>
                                    <p>{{ substring_meaning_words($post->description, 10, ' ...') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12 col-md-6 mt-lg-5 mt-4">
                        <h3 class="text-center">{{ __('cms::web.post.no_post') }}</h3>
                    </div>
                @endif
            </div>
            <div class="mt-5">
                {{ $posts->links() }}
            </div>
            {{--            {{ $posts->links('cms::web.custom.pagination', ['items' => $posts]) }}--}}

        </div>
    </div>
@stop
