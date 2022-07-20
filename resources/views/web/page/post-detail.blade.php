@extends('cms::web.master')

@section('title', settings('name_website').' - '.$item->name)

@section('seometa')

@section('content')
    <!-- single post -->
    <div class="w3l-homeblock2 ">
        <section class="">
            <div class="text11 py-lg-5 py-md-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3>{{ $item->name }}.</h3>
                            <ul class="blog-list">
                                <li>
                                    <p> Posted on <strong>{{ $item->created_at }}</strong></p>
                                </li>
                                <li>
                                    <p> <a href="#category"><strong>{{ convert_to_min_read($item->content) }} min read</strong></a></p>
                                </li>
                            </ul><br>
                            {!! $item->content !!}
                            <div class="text-right">
                                <strong>Author: <i>{{ $item->author->name }}</i></strong>
                            </div>
                        </div>
                        <div class="sidebar-side col-lg-4 col-md-12 col-sm-12 mt-lg-0 mt-5">
                            <aside class="sidebar">
                                <!-- Popular Post Widget-->
                                <div class="sidebar-widget popular-posts"style="border-radius: 35px;background-color: #ffffff;padding: 30px;">
                                    <h3>Recent Posts</h3><hr>

                                    @foreach($postsRelated as $postRelated)
                                        <div class="media-grid" style="margin-bottom: 10px">
                                            <div class="media">
                                                <a class="comment-img" href="#url">
                                                    <img src="{{ $postRelated->thumbnail  }}"
                                                         class="img-responsive" width="80px" style="border-radius: 50%" alt="placeholder image"></a>
                                                <div class="media-body comments-grid-right" style="margin-left: 10px">
                                                    <h5><a href="{{ $postRelated->url }}">{{$postRelated->name}}</a></h5>
                                                    <ul class="p-0 comment">
                                                        <p class="fa fa-clock-o"></p> {{ convert_to_min_read($postRelated->content) }} min read
                                                        <li class="">Author: <strong><i>{{ $postRelated->author->name }}</i></strong></li>
{{--                                                        <li class="">July 15th, 2020 at 11:00 am</li>--}}
                                                        <li class="">Published at: {{ $postRelated->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>

                                <div class="sidebar-widget popular-posts mt-4" style="border-radius: 35px;background-color: #ffffff;padding: 30px;">
                                    <h3>Category</h3><hr>
                                    <ul class="blog-cat">
                                        {!! \FrontendMenu::render('footer-category-menu', 'cms::web.custom.category-detail-page') !!}
                                    </ul>
                                </div>

                                <div class="sidebar-widget popular-posts mt-4" style="height: 400px; border-radius: 35px;background-color: #ffffff;padding: 30px;">
                                    <h3>For Advertising</h3><hr>
                                    <div class="media-grid" style="margin-bottom: 10px"></div>
                                </div>
                            </aside>
                        </div>
                    </div>

                    <hr>
                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <div class="comments">
                                <h3 class="aside-title mb-3">Recent comments (2)</h3>
                                <div class="comments-grids">

                                    <div class="media-grid">
                                        <div class="media">
                                            <a class="comment-img" href="#url">
                                                <img src="{{ asset('vendor/dnsoft/cms/web/assets/images/a2.jpg')}}" class="img-responsive" width="80px" style="border-radius: 50%" alt="placeholder image"></a>
                                            <div class="media-body comments-grid-right" style="margin-left: 10px">
                                                <h5>Charlie</h5>
                                                <ul class="p-0 comment">
                                                    <li class="">July 15th, 2020 at 05:45 pm </li>
                                                </ul>
                                                <p>Mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec purus
                                                    quis
                                                    tempor. Phasellus eu nec purus quis tempor.
                                                </p>
                                                <div>
                                                    <a href="#comment" class="text-primary">Reply</a>
                                                </div>

                                                <hr>
                                                <div class="media mt-4 mb-0 border-0 px-0 pb-0">
                                                    <a class="comment-img" href="#url"><img src="{{ asset('vendor/dnsoft/cms/web/assets/images/a3.jpg')}}"
                                                                                            style="border-radius: 50%"
                                                                                            class="img-responsive" width="80px" alt="placeholder image"></a>
                                                    <div class="media-body comments-grid-right" style="margin-left: 10px">
                                                        <h5>Jack Harry</h5>
                                                        <ul class="p-0 comment">
                                                            <li class="">July 15th, 2020 at 11:00 am</li>
                                                        </ul>
                                                        <p>Mattis ut hendrerit non, facilisis eget mauris. Sed ultricies nec purus quis tempor. dolor set.</p>
                                                        <div>
                                                            <a href="#comment" class="text-primary">Reply</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="leave-comment-form" id="comment">
                                <h3 class="aside-title">Leave a reply</h3><br>
                                <form action="#" method="post">
                                    <div class="input-grids">
                                        <div class="form-group">
                                            <input type="text" name="Name" class="form-control" placeholder="Your Name"
                                                   required="">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="Email" class="form-control" placeholder="Email"
                                                   required="">
                                        </div>
                                        <div class="form-group">
                                    <textarea name="Comment" class="form-control" placeholder="Your Comment"
                                              required=""></textarea>
                                        </div>
                                    </div>
                                    <div class="submit text-right">
                                        <button class="btn btn-style btn-primary">Post Comment</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- //single post -->
    </div>

    <div class="w3l-homeblock3 py-5">
        <div class="container py-lg-5 py-md-4">
            <h3 class="section-title-left mb-4">{{ __('cms::web.may_u_like') }} </h3>
            <div class="row">
                @php($randomPosts = get_random_posts(3, $item->id))
                @foreach($randomPosts as $postRd)
                <div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative">
                            <a href="{{ $postRd->url }}">
                                <img class="card-img-bottom d-block radius-image-full" src="{{ $postRd->thumbnail  }}"
                                     alt="Card image cap">
                            </a>
                        </div>
                        <div class="card-body blog-details">
                            <span class="label-blue">{{ $randomPosts[0]->categories()->first()->name ?? ''}}</span>
                            <a href="{{ $postRd->url }}" class="blog-desc">{{ $postRd->name }}</a>
                            <p>{{ substring_meaning_words($postRd->description, 15, ' ...') }}</p>
                            <div class="author align-items-center mt-3 mb-1">
                                <img src="{{ $postRd->author->avatar }}" alt="" class="img-fluid rounded-circle">
                                <ul class="blog-meta">
                                    <li>
                                        <a href="#">{{ __('cms::web.author') }}: <strong><i>{{ $postRd->author->name }}</i></strong></a>
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value"> {{ $postRd->created_at }} </span>. <span
                                            class="meta-value ml-2"><span class="fa fa-clock-o"></span> {{ convert_to_min_read($postRd->content) }} min read</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
