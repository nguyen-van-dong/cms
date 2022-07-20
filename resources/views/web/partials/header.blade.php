<header class="w3l-header">
    <div class="container">
        <!--/nav-->
        <nav class="navbar navbar-expand-lg navbar-light fill px-lg-0 py-0 px-sm-3 px-0">
            <a class="navbar-brand" href="/">
{{--                <span class="fa fa-newspaper-o">--}}
{{--            if logo is image enable this--}}
{{--                        <a class="navbar-brand" href="/">--}}
                            <img src="{{ asset('vendor/dnsoft/admin/img/logo.png') }}" alt="Your logo" title="Your logo" style="height:35px;" />
                            </span> {{ settings('name_website') }}</a>
{{--                        </a>--}}

            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <span class="fa icon-expand fa-bars"></span>
                <span class="fa icon-close fa-times"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav class="mx-auto">
                    <div class="search-bar">
                        <form class="search" action="{{ route('cms.web.home.search') }}">
                            <input type="search" value="{{ request('q') }}" class="search__input" name="q" placeholder="{{ __('cms::web.search') }}"
                                   onload="equalWidth()" required>
                            <span class="fa fa-search search__icon"></span>
                        </form>
                    </div>
                </nav>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown @@pages__active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('cms::web.program') }} <span class="fa fa-angle-down"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach(get_sub_category(1) as $subCat)
                            <a class="dropdown-item @@b__active" href="{{ $subCat->url }}">{{ $subCat->name }}</a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item @@contact__active">
                        <a class="nav-link" target="_blank" href="https://dnshop.vn">Shop</a>
                    </li>
                    <li class="nav-item @@contact__active">
                        <a class="nav-link" href="#course">{{ __('cms::web.course') }}</a>
                    </li>
                    <li class="nav-item @@contact__active">
                        <a class="nav-link" href="{{ route('cms.web.contact.index') }}"> {{ __('cms::web.contact') }}</a>
                    </li>
                    @php
                        //$supportedLocales = LaravelLocalization::getSupportedLocales();
                        $currentLocale = LaravelLocalization::getCurrentLocale();
                    @endphp
                    <li class="nav-item dropdown @@pages__active">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ get_flag_img($currentLocale) }}" alt=""> <span class="fa fa-angle-down"></span>
                        </a>
                        <div class="dropdown-menu" style=" min-width: 9rem" aria-labelledby="navbarDropdown">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                @if ($currentLocale != $localeCode)
                                <a style="margin-left: 60px;" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    <img src="{{ get_flag_img($localeCode) }}" alt="{{ $properties['native'] }}">
                                </a><br>
                                @endif
                                {{--  <a class="dropdown-item @@b__active" hreflang="{{ $localeCode }}" href="c">{{ $properties['native'] }}</a>--}}
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
            <!-- toggle switch for light and dark theme -->
{{--            <div class="mobile-position">--}}
{{--                <nav class="navigation">--}}
{{--                    <div class="theme-switch-wrapper">--}}
{{--                        <label class="theme-switch" for="checkbox">--}}
{{--                            <input type="checkbox" id="checkbox">--}}
{{--                            <div class="mode-container">--}}
{{--                                <i class="gg-sun"></i>--}}
{{--                                <i class="gg-moon"></i>--}}
{{--                            </div>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </nav>--}}
{{--            </div>--}}
            <!-- //toggle switch for light and dark theme -->
    </nav>
    </div>
    <!--//nav-->
</header>
