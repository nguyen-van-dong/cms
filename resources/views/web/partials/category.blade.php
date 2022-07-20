<section class="w3l-homeblock1">
    <div class="container py-md-4">
        <div class="grids-area-hny main-cont-wthree-fea row">
            @php($subCategory = get_sub_category(1))
            @foreach($subCategory as $subCat)
            <div class="col-lg-3 col-6 grids-feature">
                <a href="{{ $subCat->url }}">
                    <div class="area-box">
                        <span class="{{ $subCat->class }}"></span>
                        <h4 class="title-head">{{ $subCat->name }}</h4>
                    </div>
                </a>
            </div>
            @endforeach
{{--            <div class="col-lg-3 col-6 grids-feature">--}}
{{--                <a href="/lap-trinh">--}}
{{--                    <div class="area-box">--}}
{{--                        <span class="fa fa-female"></span>--}}
{{--                        <h4 class="title-head">Lập Trình</h4>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6 grids-feature mt-lg-0 mt-md-4 mt-3">--}}
{{--                <a href="/thu-thuat">--}}
{{--                    <div class="area-box">--}}
{{--                        <span class="fa fa-cutlery"></span>--}}
{{--                        <h4 class="title-head">Thủ thuật</h4>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="col-lg-3 col-6 grids-feature mt-lg-0 mt-md-4 mt-3">--}}
{{--                <a href="/contact-me">--}}
{{--                    <div class="area-box">--}}
{{--                        <span class="fa fa-pie-chart"></span>--}}
{{--                        <h4 class="title-head">Liên hệ</h4>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>
</section>
