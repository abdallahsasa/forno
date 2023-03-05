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
                            <a href="{{url('/')}}">{{ __('menu.home') }}</a>
                        </li>
                        <li>
                            <a href="{{url('/menu')}}">Menu</a>
                        </li>
                        <li>
                            <a href="{{url('/contact')}}">Contact</a>
                        </li>
                        <li class="sb-has-children">
                            <a href> Language </a>
                            <ul>
                                <li value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>
                                    <a href="{{ route('changeLang').'?lang=en' }}"> English </a>
                                </li>
                                <li value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>
                                    <a href="{{ route('changeLang').'?lang=ar' }}"> Arabic </a>
                                </li>
                            </ul>
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
