<div class="w3l-homeblock3">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        <div class="left-right">
            <h3 class="section-title-left mb-sm-4 mb-2"> Bài viết mới nhất</h3>
            <a href="beauty.html" class="more btn btn-small mb-sm-0 mb-4">View more</a>
        </div>
        <div class="row">
            @foreach($latestPosts as $post)
            <div class="col-lg-6 mt-4">
                <div class="bg-clr-white hover-box">
                    <div class="row">
                        <div class="col-sm-5 position-relative">
                            <a href="{{ $post->url }}" class="image-mobile">
                                <img class="card-img-bottom d-block radius-image-full" src="{{ $post->thumbnail }}"
                                     alt="Card image cap">
                            </a>
                        </div>
                        <div class="col-sm-7 card-body blog-details align-self">
                            <a href="{{ $post->url }}" class="blog-desc">{{ $post->name }}.</a>
                            <div class="author align-items-center">
                                <img src="{{ $post->author->avatar }}" alt="" class="img-fluid rounded-circle" />
                                <ul class="blog-meta">
                                    <li>
                                        <a href="#">Author: {{ $post->author->name }}</a> </a>
                                    </li>
                                    <li class="meta-item blog-lesson">
                                        <span class="meta-value">Published At: {{ $post->created_at }}</span>
                                        <p class="meta-value ml-2"><p class="fa fa-clock-o"></p> {{ convert_to_min_read($post->content) }} min read</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
        </div>
    </div>
</div>
