<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- color of address bar in mobile browser -->
    <meta name="theme-color" content="#F5C332">
    <!-- favicon  -->
    <link rel="shortcut icon" href="{{asset('img/ui/white-logo.png')}}" type="image/x-icon">
    <!-- font awesome css -->
    <link rel="stylesheet" href="{{asset('css/plugins/font-awesome.min.css')}}">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('css/plugins/bootstrap.min.css')}}">
    <!-- swiper css -->
    <link rel="stylesheet" href="{{asset('css/plugins/swiper.min.css')}}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{asset('css/plugins/datepicker.css')}}">
    <!-- mapbox css -->
    <link href="{{asset('css/plugins/mapbox-style.css')}}" rel='stylesheet'>
    <!-- fancybox css -->
    <link rel="stylesheet" href="{{asset('css/plugins/fancybox.min.css')}}">
    <!-- starbelly css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- page title -->
    <title>More & More</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite([ 'resources/js/app.js'])
</head>

<body>
<!-- preloader -->
<div class="sb-preloader">
    <div class="sb-preloader-bg"></div>
    <div class="sb-preloader-body">
        <div class="sb-loading">
            <div class="sb-percent"><span class="sb-preloader-number" data-count="101">00</span><span>%</span></div>
        </div>
        <div class="sb-loading-bar">
            <div class="sb-bar"></div>
        </div>
    </div>
</div>
<!-- preloader end -->

<!-- click effect -->
<div class="sb-click-effect"></div>
<!-- loader -->
<div class="sb-load"></div>


@include('layouts.header')
<div class="sb-app">
    <!-- dynamic content -->
    <!-- Back to top button -->
    <a id="backbutton"></a>
    <div id="sb-dynamic-content" class="sb-transition-fade">
        @yield('content')
        <section class="sb-p-0-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="sb-promo-frame sb-mb-30">
                            <div class="sb-promo-content">
                                <div class="sb-text-frame">
                                    <h3 class="sb-mb-10">Talabat</h3>
                                    <h3 class="sb-mb-15">More And More Juices </h3>
                                    <p class="sb-text sb-text-sm sb-mb-15">Delivers to You</p>
                                    <!-- button -->
                                    <a href="https://www.talabat.com/kuwait/more-and-more-juices" class="sb-btn sb-ppc"
                                       target="_blank">
                      <span class="sb-icon">
                        <img src="{{asset('img/ui/icons/delivery.svg')}}" alt="icon">
                      </span>
                                        <span>Order now</span>
                                    </a>
                                    <!-- button end -->
                                </div>
                                <div class="sb-image-frame">
                                    <div class="sb-illustration-4">
                                        <img src="{{asset('img/ui/talabat-logo.svg')}}" alt="burger" class="sb-burger">
                                        <div class="sb-cirkle-1 talabat"></div>
                                        <div class="sb-cirkle-2 talabat"></div>
                                        <div class="sb-cirkle-3 talabat"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="sb-promo-frame sb-mb-30">
                            <div class="sb-promo-content">
                                <div class="sb-text-frame">
                                    <h3 class="sb-mb-10">Deliveroo</h3>
                                    <h3 class="sb-mb-15">More And More Juice </h3>
                                    <p class="sb-text sb-text-sm sb-mb-15">Delivered to your door</p>
                                    <!-- button -->
                                    <a href="https://deliveroo.com.kw/en/brands/more-and-more-juice" class="sb-btn sb-ppc"
                                       target="_blank">
                      <span class="sb-icon">
                        <img src="{{asset('img/ui/icons/delivery.svg')}}" alt="icon">
                      </span>
                                        <span>Order now</span>
                                    </a>
                                    <!-- button end -->
                                </div>
                                <div class="sb-image-frame">
                                    <div class="sb-illustration-4">
                                        <img src="{{asset('img/ui/deliveroo-logo.svg')}}" alt="burger" class="sb-burger">
                                        <div class="sb-cirkle-1 deliveroo"></div>
                                        <div class="sb-cirkle-2 deliveroo"></div>
                                        <div class="sb-cirkle-3 deliveroo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

</div>
</body>
@include('layouts.footer')
</html>





