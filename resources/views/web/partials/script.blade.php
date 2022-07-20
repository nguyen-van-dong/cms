<!-- Template JavaScript -->
{{--<script src="{{ asset('vendor/dnsoft/cms/web/assets/js/jquery-3.3.1.min.js') }}"></script>--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="{{ asset('vendor/contact/web/js/newsletter.js') }}"></script>
<!-- disable body scroll which navbar is in active -->
<script>
    $(function () {
        $('.navbar-toggler').click(function () {
            $('body').toggleClass('noscroll');
        })
    });
</script>
<!-- disable body scroll which navbar is in active -->

<!-- theme changer js -->
<script src="{{ asset('vendor/dnsoft/cms/web/assets/js/theme-change.js') }}"></script>
<!-- //theme changer js -->

<!-- courses owlcarousel -->
<script src="{{ asset('vendor/dnsoft/cms/web/assets/js/owl.carousel.js')}}"></script>

<!-- script for testimonials -->
<script>
    $(document).ready(function () {
        $('.owl-testimonial').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            responsiveClass: true,
            autoplay: false,
            autoplayTimeout: 5000,
            autoplaySpeed: 1000,
            autoplayHoverPause: false,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                480: {
                    items: 1,
                    nav: false
                },
                667: {
                    items: 1,
                    nav: true
                },
                1000: {
                    items: 1,
                    nav: true
                }
            }
        })
    })
</script>
<!-- //script for testimonials -->

<!-- bootstrap -->
<script src="{{ asset('vendor/dnsoft/cms/web/assets/js/bootstrap.min.js') }}"></script>
