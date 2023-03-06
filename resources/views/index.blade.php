@extends('layouts.app')
@section('content')
    <section class="sb-p-60-30" style="padding-top: 150px!important;">
        <div class="container">
            <div class="sb-group-title sb-mb-30">
                <div class="sb-left sb-mb-30">
                    <h2 class="sb-mb-30">{{ __('home.category-headingp1') }} <span>{{ __('home.category-headingp2') }}</span></h2>
                    <p class="sb-text">{{ __('home.category-subheading') }}</p>
                </div>
                <div class="sb-right sb-mb-30">
                    <!-- button -->
                    <a href="/menu" class="sb-btn sb-m-0">
                <span class="sb-icon">
                  <img src="img/ui/icons/menu.svg" alt="icon">
                </span>
                        <span>{{ __('home.view-full-menu') }}</span>
                    </a>
                    <!-- button end -->
                </div>
            </div>
            <div class="row">
                @if(isset($categories))
                    @foreach($categories as $category)
                        <div class="col-lg-4">
                            <a href="/menu/{{str_replace(' ', '', $category->name)}}" class="sb-categorie-card sb-categorie-card-2 sb-mb-30">
                                <div class="sb-card-body">
                                    <div class="sb-category-icon">
                                        <img src="{{$category->image_url}}" alt="icon">
                                    </div>
                                    <div class="sb-card-descr">
                                        <h3  style="text-align: right;" class="sb-mb-10">{{$category->name}}</h3>
                                        <p style="display:none;" class="sb-text">{{$category->description}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
            <section class="sb-short-menu sb-p-0-90">
                <div class="sb-bg-2">
                    <div></div>
                </div>
                <div class="container">
                    <div class="sb-group-title sb-mb-30">
                        <div class="sb-left sb-mb-30">
                            <h2 class="sb-mb-30">{{ __('home.most') }} <span>{{ __('home.popular') }}</span></h2>
                        </div>
                        <div class="sb-right sb-mb-30">
                            <!-- slider navigation -->
                            <div class="sb-slider-nav">
                                <div class="sb-prev-btn sb-short-menu-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"><i class="fas fa-arrow-left"></i></div>
                                <div class="sb-next-btn sb-short-menu-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"><i class="fas fa-arrow-right"></i></div>
                            </div>
                            <!-- slider navigation end -->
                            <!-- button -->
                            <a href="/menu" class="sb-btn">
                <span class="sb-icon">
                  <img src="img/ui/icons/menu.svg" alt="icon">
                </span>
                                <span>{{ __('home.full-menu') }}</span>
                            </a>
                            <!-- button end -->
                        </div>
                    </div>
                    <div class="swiper-container sb-short-menu-slider-4i swiper-container-horizontal">
                        <div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);">
                            @if(isset($products))
                                @foreach($products as $product)
                            <div class="swiper-slide swiper-slide-active" style="width: 330px; margin-right: 30px;">
                                <a  href="/product/{{$product->id}}" class="sb-menu-item">
                                    <div class="sb-cover-frame">
                                        <img src="{{$product->image_url}}" alt="product">
                                    </div>
                                    <div class="sb-card-tp">
                                        <h4 class="sb-card-title">{{$product->name}}</h4>
                                        <div class="sb-price">
                                            @foreach($product->prices as $price)
                                                @if($price->size=='Regular')
                                                    {{number_format($price->price,3)}}
                                                    @break
                                                @else
                                                    {{number_format($price->price,3)}}                                                    @break
                                                @endif
                                            @endforeach
                                            <sub>{{$product->currency}}</sub>
                                        </div>
                                        <div>

                                        </div>
                                    </div>
                                    <div class="sb-description">

                                    </div>
                                </a>

                            </div>
                                @endforeach
                            @endif
                        </div>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                </div>
            </section>

        </div>
    </section>
    <!-- menu end -->
@endsection
