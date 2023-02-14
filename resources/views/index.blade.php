@extends('layouts.app')
@section('content')

    <section class="sb-menu-section sb-p-90-60">
        <div class="sb-bg-1">
            <div></div>
        </div>
        <div class="container">
            <!-- filter -->
            <div class="sb-filter mb-30">
                <a href="#." data-filter="*" class="sb-filter-link sb-active">All </a>
                @foreach($categories as $category)
                    <a href="#." data-filter=".{{str_replace(' ', '', $category->name)}}"
                       class="sb-filter-link">{{$category->name}}</a>
                @endforeach
            </div>
            <!-- filter end -->
            <div class="sb-masonry-grid">
                <div class="sb-grid-sizer"></div>
                @foreach($products as $product)
                    <div class="sb-grid-item sb-item-25 {{str_replace(' ', '', $product->category->name)}}">
                        <a data-fancybox="menu" data-no-swup href="{{$product->image_url}}"
                           class="sb-menu-item sb-mb-2">
                            <div class="sb-cover-frame">
                                <img src="{{$product->image_url}}" alt="{{$product->image_name}}">
                            </div>
                            <div class="sb-card-tp">
                                <h4 class="sb-card-title">{{$product->name}}</h4>
                                <div class="sb-price"> {{$product->prices[0]['price']}}
                                    <sub>{{$product->currency}}</sub></div>
                            </div>
                     <a style="width: 100%;justify-content: center;" href="/product/{{$product->id}}" class="sb-btn sb-ppc" target="_blank">
                      <span class="sb-icon">
                        <img src="img/ui/icons/search.svg" alt="icon">
                      </span><span>View sizes</span></a>

                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- menu end -->


@endsection
