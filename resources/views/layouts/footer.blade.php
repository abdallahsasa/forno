
<footer>
    <div class="container">
        <div class="sb-footer-frame">
            <div class="sb-copy">Copyright More&More &copy; 2023. All Rights Reserved.</div>
            <ul class="sb-social">
                <li><a href="#."><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/moreandmore_kw/" target="_blank"><i class="fab fa-instagram"></i></a>
                </li>
                <li><a href="#."><i class="fab fa-snapchat"></i></a></li>
            </ul>
            <div class="sb-copy">Powered By <a href={{url('https://www.threedigitsoftware.com/')}} target="_blank">Three
                    Digit Software</a></div>
        </div>
    </div>

    <!-- jquery js -->
    <script src="{{asset('js/plugins/jquery.min.js')}}"></script>
    <!-- smooth scroll js -->
    <script src="{{asset('js/plugins/smooth-scroll.js')}}"></script>
    <!-- swup js -->
    <script src="{{asset('js/plugins/swup.min.js')}}"></script>
    <!-- swiper js -->
    <script src="{{asset('js/plugins/swiper.min.js')}}"></script>
    <!-- datepicker js -->
    <script src="{{asset('js/plugins/datepicker.js')}}"></script>
    <!-- isotope js -->
    <script src="{{asset('js/plugins/isotope.js')}}"></script>
    <!-- sticky -->
    <script src="{{asset('js/plugins/sticky.js')}}"></script>
    <!-- mapbox js -->
    <script src="{{asset('js/plugins/mapbox.min.js')}}"></script>
    <!-- fancybox js -->
    <script src="{{asset('js/plugins/fancybox.min.js')}}"></script>
    <!-- starbelly js -->
    <script src="{{asset('js/main.js')}}"></script>
    <script>
        var btn = $('#backbutton');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 30) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop:0}, '300');
        });
        $(".scroll").click(function() {
            $('html,body').animate({
                    scrollTop: $("#main").offset().top-200},
                'slow');
        });
        var url = "{{ route('changeLang') }}";
        $(".changeLang").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });
        @if(isset($categoryfilter) && $categoryfilter != "ALL")

        $(document).ready(function() {
        const link = document.getElementById("{{$categoryfilter}}");
        //console.log(link);
        link.click();
        });
        @endif
    </script>

</footer>
