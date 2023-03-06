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
                            <a href="{{url('/menu')}}">{{ __('menu.menu') }}</a>
                        </li>
                        <li>
                            <a href="{{url('/contact')}}">{{ __('menu.contact') }}</a>
                        </li>
                        <li class="sb-has-children">
                            <a href> {{ __('menu.language') }} </a>
                            <ul>
                                <li value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>
                                    <a href="{{ route('changeLang').'?lang=en' }}"> {{ __('menu.english') }} </a>
                                </li>
                                <li value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>
                                    <a href="{{ route('changeLang').'?lang=ar' }}"> {{ __('menu.arabic') }} </a>
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
