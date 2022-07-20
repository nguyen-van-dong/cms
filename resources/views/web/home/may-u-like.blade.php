<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        @php($randomPosts = get_random_posts(2))
        <div class="row">
            <div class="col-lg-8">
                <h3 class="section-title-left mb-4"> Có thể bạn thích </h3>
                <div class="row">

                    <div class="col-lg-6 col-md-6 item">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="#blog-single.html">
                                    <img class="card-img-bottom d-block radius-image-full"
                                         src="{{ $randomPosts[0]->thumbnail }}" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body blog-details">
                                <span class="label-blue">{{ $randomPosts[0]->categories()->first()->name ?? ''}}</span>
                                <a href="{{ $randomPosts[0]->url }}" class="blog-desc">{{ $randomPosts[0]->name }}</a>
                                <p><p>{!! substring_meaning_words($randomPosts[0]->description, 13, ' ...') !!}</p></p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <img src="{{ asset('vendor/dnsoft/cms/web/assets/images/a1.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="#">Author: <i>{{ $randomPosts[1]->author->name }}</i></a> </a>
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> {{ $randomPosts[1]->created_at }}  </span>. <span
                                                class="meta-value ml-2"><span class="fa fa-clock-o"></span> {{ convert_to_min_read($randomPosts[1]->content) }} min</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-5 mt-4">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="{{$randomPosts[1]->url}}">
                                    <img class="card-img-bottom d-block radius-image-full"
                                         src="{{ $randomPosts[1]->thumbnail }}" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body blog-details">
                                <span class="label-blue">{{ $randomPosts[0]->categories()->first()->name ?? '' }}</span>
                                <a href="{{$randomPosts[1]->url}}" class="blog-desc"> {{ $randomPosts[1]->name }}</a>
                                <p>{!! substring_meaning_words($randomPosts[1]->description, 13, ' ...') !!}</p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <img src="{{ asset('vendor/dnsoft/cms/web/assets/images/a2.jpg')}}" alt="" class="img-fluid rounded-circle" />
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="#">Author: <i>{{ $randomPosts[1]->author->name }}</i></a> </a>
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value">{{ $randomPosts[1]->created_at }} </span>. <span
                                                class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1 min</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 left-right bg-clr-white p-3">
                    <h3 class="section-title-left align-self pl-2 mb-sm-0 mb-3">Advertise with us </h3>
                    <a class="btn btn-style btn-primary" href="#url">Learn more</a>
                </div>
            </div>

            <div class="col-lg-4 trending mt-lg-0 mt-5">
                <div class="topics">
                    <h3 class="section-title-left mb-4"> Topics</h3>
                    @foreach(get_sub_category(1) as $subCat)
                    <a href="{{ $subCat->url }}" class="topics-list mt-3">
                        <div class="list1">
                            <span class="{{ $subCat->class }}"></span>
                            <h4>{{ $subCat->name }}</h4>
                        </div>
                    </a>
                    @endforeach

                </div>
                <div class="sponsers mt-5">
                    <h3 class="section-title-left mb-4"> Our sponsers</h3>
                    <a href="#ad-banner"><img src="{{ asset('vendor/dnsoft/cms/web/assets/images/ad.jpg')}}" alt="" class="img-fluid radius-image-full" /></a>
                    <a href="#advertise" class="text-center d-block text-uppercase">Advertise with us </a>
                </div>
            </div>
        </div>
    </div>
</div>
