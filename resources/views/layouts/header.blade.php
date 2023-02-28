<!-- top bar -->
<div class="sb-top-bar-frame">
    <div class="sb-top-bar-bg"></div>
    <div class="container">
        <div class="sb-top-bar">
            <a href="{{url('/')}}" class="sb-logo-frame">
                <!-- logo img -->
                <img src="{{asset('img/ui/logo.png')}}" alt="More & More">
            </a>
            <!-- menu -->
            <div class="sb-right-side">
                <nav id="sb-dynamic-menu" class="sb-menu-transition">
                    <ul class="sb-navigation">
                        <li>
                            <a href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/menu')}}">Menu</a>
                        </li>
                        <li>
                            <a href="{{url('/contact')}}">Contact</a>
                        </li>
                    </ul>
                </nav>
                <div class="sb-buttons-frame">
                    <div class="sb-menu-btn"><span></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- top bar end -->
