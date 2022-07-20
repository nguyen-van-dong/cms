<section class="app-footer">
    <footer class="footer-28 py-5">
        <div class="footer-bg-layer">
            <div class="container py-lg-3">
                <div class="row footer-top-28">
                    <div class="col-lg-4 footer-list-28 copy-right mb-lg-0 mb-sm-5 mt-sm-0 mt-4">
                        <a class="navbar-brand mb-3" href="index.html">
{{--                            <span class="fa fa-newspaper-o"></span> Dnsoft Blog</a>--}}
                        <img src="{{ asset('vendor/dnsoft/admin/img/logo.png') }}" alt="Your logo" title="Your logo" style="height:35px;" />
                        </span> {{ settings('name_website') }}</a>
                        <p class="copy-footer-28"> {{ settings('footer') }} </p>
                        <h5 class="mt-2">Design by <a href="http://dnguyen.xyz/about">Dong Nguyen</a></h5>
                        <h5>Phone: {{ settings('contact_phone') }}</h5>
                        <h5>Email: <a href="mailto:{{ settings('contact_email') }}">{{ settings('contact_email') }}</a></h5>
                    </div>
                    <div class="col-lg-8 row">

                        {!! \FrontendMenu::render('footer-program-menu', 'cms::web.custom.footer-program-menu') !!}

                        {!! \FrontendMenu::render('footer-category-menu', 'cms::web.custom.footer-category-menu') !!}

                        {!! \FrontendMenu::render('footer-social-menu', 'cms::web.custom.footer-social-menu') !!}

                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- /move top -->
</section>
