@extends('layouts.app')
@section('content')
    <!-- banner -->
    <section class="sb-banner sb-banner-xs product-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- main title -->
                    <div class="sb-main-title-frame">
                        <div class="sb-main-title">
                            <h1 class="sb-h2">{{ __('product.banner-title') }}</h1>
                            <ul class="sb-breadcrumbs">
                                <li><a class="text-uppercase" href="/">{{ __('menu.home') }}</a></li>

                                <li>
                                    <div class="text-uppercase"> {{$product->category->name}} </div>
                                </li>
                                <li>
                                    <div class="text-uppercase"> {{$product->name}} </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- main title end -->
                </div>
            </div>
        </div>
    </section>
    <!-- banner end -->

    <!-- product -->
    <section class="sb-p-90-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="sb-gallery-item sb-gallery-square sb-mb-90">
                        <img src="{{$product->image_url}}" alt="{{$product->image_name}}">
                        <!-- button -->
                        <a data-fancybox="menu" data-no-swup="" href="{{$product->image_url}}"
                           class="sb-btn sb-btn-2 sb-btn-icon sb-btn-gray sb-zoom">
                  <span class="sb-icon">
                    <img src="{{url('img/ui/icons/zoom.svg')}}" alt="icon">
                  </span>
                        </a>
                        <!-- button end -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sb-product-description sb-mb-90">
                        <div class="sb-price-frame sb-mb-30">
                            <h3>{{$product->name}}</h3>
                            <div class="sb-price">
                                @foreach($product->prices as $price)
                                    @if($price->size=='Regular')
                                        {{number_format($price->price,3)}}
                                        @break
                                    @else
                                        {{number_format($price->price,3)}}
                                        @break
                                    @endif
                                @endforeach
                                    <sub>{{$product->currency}}</sub>
                            </div>

                        </div>
                        <div class="sb-text sb-mb-30">{{$product->category->name}}</div>
                        <ul class="sb-stars sb-mb-25">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                        <div class="sb-text sb-mb-30">{!!$product->description!!}</div>
                        <div style="display:none;" class="row">
                            <div class="col-lg-4">
                                <div class="sb-features-item sb-features-item-sm sb-mb-30">
                                    <div class="sb-number">01</div>
                                    <div class="sb-feature-text">
                                        <h4 class="sb-mb-15">Add to the cart and place an order</h4>
                                        <p class="sb-text sb-text-sm">Porro comirton pera nemo veniam</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="sb-features-item sb-features-item-sm sb-mb-30">
                                    <div class="sb-number">02</div>
                                    <div class="sb-feature-text">
                                        <h4 class="sb-mb-15">Enter your phone number and address</h4>
                                        <p class="sb-text sb-text-sm">Eligendi adipisci numquam.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="sb-features-item sb-features-item-sm sb-mb-30">
                                    <div class="sb-number">03</div>
                                    <div class="sb-feature-text">
                                        <h4 class="sb-mb-15">Enjoy your favorite food at home!</h4>
                                        <p class="sb-text sb-text-sm">Nnecessitatibus praesentium</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sb-masonry-grid sb-tabs" style="position: relative; height: 299px;">
                            <div class="sb-grid-sizer" style="position: absolute; display: none;"></div>
                            <div class="sb-grid-item sb-ingredients-tab"
                                 style="position: absolute; left: 0%; top: 0px;">
                                <div class="sb-tab">
                                    <ul class="sb-list">
                                        @foreach($product->prices as $prod)
                                            <li>
                                                <b class="text-capitalize"><i class="fa-solid fa-cup-togo"></i>{{ __('product.'.str_replace(' ', '', $prod->size)) }}</b><span>{{number_format($prod->price,3)}}   {{$product->currency}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product end -->
    <section class="sb-short-menu sb-p-0-90">
        <div class="container">
            <div class="sb-group-title sb-mb-30">
                <div class="sb-left sb-mb-30">
                    <h2 class="sb-cate-title sb-mb-30">{{ __('product.related-products') }}</h2>
                </div>
                @if(count($relatedProducts)>4)
                    <div class="sb-right sb-mb-30">
                        <!-- slider navigation -->
                        <div class="sb-slider-nav">
                            <div class="sb-prev-btn sb-short-menu-prev swiper-button-disabled" tabindex="0"
                                 role="button" aria-label="Previous slide" aria-disabled="true"><i
                                    class="fas fa-arrow-left"></i></div>
                            <div class="sb-next-btn sb-short-menu-next" tabindex="0" role="button"
                                 aria-label="Next slide" aria-disabled="false"><i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                        <!-- slider navigation end -->
                    </div>
                @endif
            </div>
            <div class="swiper-container sb-short-menu-slider-4i swiper-container-horizontal">
                <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                    @foreach($relatedProducts as $rproduct)
                        <div class="swiper-slide" style="width: 270px; margin-right: 30px;">
                            <div class="sb-menu-item">
                                <a href="{{route('home.product.show',$rproduct->id)}}" class="sb-cover-frame">
                                    <img src="{{$rproduct->image_url}}" alt="{{$rproduct->image_name}}">
                                </a>
                                <div class="sb-card-tp">
                                    <h4 class="sb-card-title"><a href="{{route('home.product.show',$rproduct->id)}}">{{$rproduct->name}}</a>
                                    </h4>
                                    <div class="sb-price">
                                        <sub>{{$rproduct->currency}}</sub>
                                        @foreach($rproduct->prices as $rprice)
                                            @if($rprice->size=='Regular')
                                                {{number_format($price->price,3)}}
                                                @break
                                            @else
                                                {{number_format($price->price,3)}}
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
