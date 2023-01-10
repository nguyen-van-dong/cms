@extends('web.layout.master')

@section('seometa')
@seometa
@endsection

@section('content')

<div class="page-title blog-page-title bg-img bg-6 overflow-x-hidden">
  <div class="overlay"></div>
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-7">
        <div class="row">
          <div class="col-12">
            <div class="page-title-content align-items-center text-left">
              <h1 class="page-name">
                {{ $item->name }}
              </h1>
            </div>

            <div class="col-lg-8 text-white py-5 px-lg-0">
              <div class="mb-5">
                @foreach($item->categories as $postCategory)
                <a href="{{ $postCategory->url }}" class="badge badge-secondary px-3 py-2 my-1 category-badge">
                  <i class="fas fa-hashtag pr-2"></i>{{ $postCategory->name }}
                </a>
                @endforeach
              </div>

              <div class="mb-5">
                @php($time = get_reading_time($item->content))
                <i class="fa fa-clock pr-2"></i> {{ $time }} {{ $time === 1 ? __('blog.reading_time.equal_1') : __('blog.reading_time.greater_1') }}
              </div>

              <img src="{{ $item->author ? $item->author->avatar : null }}" alt="Dong Nguyen" class="blog-author-image mr-2 shadow" height="45" width="45">
              <span class="meta-author text-black">{{ $item->author->name }}</span>&nbsp;·&nbsp;
              <span class="meta-date font-italic">{{ $item->published_at->toFormattedDateString() }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 px-lg-0 d-none d-md-block">
        <figure class="pb-3">
          <img class="rounded-thumbnail img-fluid shadow" src="{{ $item->thumbnail }}" alt="{{ get_setting('introduce_myself') }}">
        </figure>
      </div>
    </div>
  </div>
</div>

<div class="blog-page-main-wrapper blog-post-container pt-5 py-2">
  <div class="container">
    <div class="row justify-content-center full-width">
      <main class="col-lg-8 main-content">

        <div class="blog-single-post blog-post" id="blog-post-content">
          <div class="post-info">
            <div class="post-des mt-0">
              {!! $item->content !!}
            </div>
          </div>
        </div>

        @include('web.blog.subcribe')

        <div class="text-center">
          <hr>
          <div class="row py-3">
            @if ($item->previous)
            <div class="col-lg text-left">
              <a href="{{ $item->previous ? $item->previous->url : null }}" class="prev-next-container row align-items-center">
                <div class="col-2">
                  <i class="fas fa-chevron-left prev-next-button"></i>
                </div>
                <div class="col">
                  <strong>{{ __('blog.previous') }}:</strong><br>
                  {{ $item->previous ? $item->previous->name : null }}
                </div>
              </a>
            </div>
            @endif

            @if ($item->next)
            <div class="col-lg text-right pt-4 py-lg-0">
              <a href="{{ $item->next ? $item->next->url : null }}" class="prev-next-container row align-items-center">
                <div class="col">
                  <strong>{{ __('blog.next') }}:</strong><br>
                  {{ $item->next ? $item->next->name : null }}
                </div>
                <div class="col-2">
                  <i class="fas fa-chevron-right prev-next-button"></i>
                </div>
              </a>
            </div>
            @endif
          </div>
        </div>
        <hr>

        @include('cms::web.page.share')

        <!-- <div class="mt-5" id="disqus_thread"></div> -->
        <div class="text-left mt-5 mb-5" id="comment-area"></div>
        <input type="hidden" id="post_id" value="{{ $item->id }}" />
      </main>

      <aside class="col-lg-3 offset-lg-1">
        <div class="widget widget-tags">
          <div class="row align-items-center">
            <div class="col-3">
              <img src="{{ $item->author ? $item->author->avatar : null }}" alt="Dong Nguyen" class="blog-author-image mr-2 shadow" height="45" width="45">
            </div>
            <div class="col-lg-9">
              <p class="side-bar-author my-auto mb-0">Dong Nguyen</p>
            </div>
            <div class="col-12 widget-title"></div>
          </div>
          <div class="row mb-5">
            <p class="col-12 text-muted font-size-regular">
              {{ __('cms::post.introduce_myself') }}
              <br>
            </p>
            <div class="col-12 my-1">
              <a target="_blank" href="{{ get_setting('Facebook') }}" class="btn fill-style d-block my-2 twitter-button">
                <i class="fab fa-facebook pr-2"></i>Follow on Facebook
              </a>
            </div>
          </div>

          <h3 class="widget-title">Related</h3>
          <div class="mb-5 pb-1">

            @foreach($postsRelated as $postRelated)
            <div class="blog-post mb-4">
              <div class="post-thumb shadow mb-3">
                <a href="{{ $postRelated->url }}" class="d-block rounded-thumbnail shadow">
                  <img src="{{ $postRelated->thumbnail }}" alt="Behind the Dev: Matt Stauffer" class="rounded-thumbnail" loading="lazy">
                </a>
              </div>
              <div class="post-info">
                <h4 class="related-post-title">
                  <a href="{{ $postRelated->url }}">
                    {{ $postRelated->name }}
                  </a>
                </h4>

                <img src="{{ $item->author ? $item->author->avatar : null }}" alt="{{ $postRelated->name }}" class="blog-author-image-smaller mr-2 shadow-sm lazy" loading="lazy" height="45" width="45">
                <span class="meta-author">{{ $postRelated->author->name }}</span>
              </div>
            </div>
            @endforeach

          </div>

          <h3 class="widget-title pb-4"></h3>
          <div>
            <div class="author-box clearfix sponsor-section ml-0 my-4">
              <div class="author-info">
                <a class="author-info-head" target="_blank" href="{{ get_setting('buymecoffee') }}">
                  <!-- <h3>Sponsor Me! 🚀</h3> -->
                  <img src="https://camo.githubusercontent.com/3ba8042b343d12b84b85d2e6563376af4150f9cd09e72428349c1656083c8b5a/68747470733a2f2f63646e2e6275796d6561636f666665652e636f6d2f627574746f6e732f64656661756c742d6f72616e67652e706e67" alt="Buy Me A Coffee" style="height: 51px; width: 217px; max-width: 100%;" data-canonical-src="https://cdn.buymeacoffee.com/buttons/default-orange.png">
                </a>
                <div class="author-description">
                  <p class="mb-3 pt-2 font-size-regular">
                    {{ __('blog.buy_me_coffee') }}
                  </p>
                </div>
              </div>
            </div>

            @if(isset($referralLink))
            <h3 class="widget-title pb-4"></h3>
            <div class="blog-post mb-4">
              <div class="post-thumb shadow mb-3">
                <a href="https://battle-ready-laravel.com" class="d-block rounded-thumbnail shadow" target="_blank" rel="noreferrer noopener">
                  <img src="{{ asset('assets/web/images/sponsors/battle-ready-laravel-blog-side.png?v=1') }}" alt="Battle Ready Laravel" class="rounded-thumbnail" loading="lazy">
                </a>
              </div>
            </div>

            <div class="blog-post mb-4">
              <div class="post-thumb shadow mb-3">
                <a href="https://codecourse.com" class="d-block rounded-thumbnail shadow" target="_blank" rel="noreferrer noopener">
                  <img src="{{ asset('assets/web/images/sponsors/vertical-banner-codecourse.png') }}" alt="Codecourse" class="rounded-thumbnail" loading="lazy">
                </a>
              </div>
            </div>
            @endif

          </div>
        </div>
      </aside>
    </div>
  </div>
</div>

@endsection

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{{ url('/vendor/comment/web/js/comment.js') }}"></script>
@endpush

@push('style')
<link rel="stylesheet" href="{{ url('/vendor/comment/web/css/comment.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
<style>
  pre {
    font-size: 16px;
    background: hsla(0, 0%, 78%, .3);
    border: 1px solid #c4c4c4;
    border-radius: 2px;
    color: #353535;
    direction: ltr;
    font-style: normal;
    min-width: 200px;
    padding: 1em;
    tab-size: 4;
    text-align: left;
    white-space: pre-wrap;
  }
</style>
@endpush