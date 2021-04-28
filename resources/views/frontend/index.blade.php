@extends('frontend.layouts.app')

@section('content')

    <!-- Banner Section -->
    <div class="hero__item set-bg my-5" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}">
        <div class="hero__text">
            <span>FRUIT FRESH</span>
            <h2>Vegetable <br />100% Organic</h2>
            <p>Free Pickup and Delivery Available</p>
            <a href="{{ route('shop') }}" class="primary-btn">SHOP NOW</a>
        </div>
    </div>
    <!-- Banner Section end -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                        <h2>Our Categories</h2>
                    </div>
                </div>
                <div class="categories__slider owl-carousel">
                    @foreach ($subcategories as $subcategory)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg"
                                data-setbg="{{ Storage::disk('uploads')->url($subcategory->image_name) }}">
                                <h5><a href="{{route('subcategory', $subcategory->slug)}}">{{ $subcategory->title }}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($featuredproducts as $product)
                    @if ($product->discount > 0)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="product__discount__item">
                                        @php
                                            $image = DB::table('product_images')
                                                ->where('product_id', $product->id)
                                                ->first();
                                            $discountamount = ($product->discount / 100) * $product->price;
                                            $afterdiscount = $product->price - $discountamount;
                                        @endphp
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ Storage::disk('uploads')->url($image->filename) }}">
                                            <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                            <ul class="product__item__pic__hover">

                                                @if (Auth::guest() || Auth::user()->role_id != 3)
                                                    <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                                @elseif(Auth::user()->role_id==3)
                                                    <li><a href="{{ route('addtowishlist', $product->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="{{ route('products', $product->slug) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                                @endif

                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <h5><a href="{{ route('products', $product->slug) }}">{{ $product->title }}</a></h5>
                                            <div class="product__item__price">Rs. {{ $afterdiscount }} <span>Rs.
                                                    {{ $product->price }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="product__item">
                                @php
                                    $image = DB::table('product_images')
                                        ->where('product_id', $product->id)
                                        ->first();
                                @endphp
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ Storage::disk('uploads')->url($image->filename)}}">
                                        <ul class="product__item__pic__hover">
                                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                        @elseif(Auth::user()->role_id==3)
                                            <li><a href="{{ route('addtowishlist', $product->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                            <li><a href="{{ route('products', $product->slug) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                        @endif
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{route('products', $product->slug)}}">{{$product->title}}</a></h6>
                                        <h5>Rs. {{$product->price}}</h5>
                                    </div>
                                </div>
                            </div>
                            @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Discount Products -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="product__discount">
                        <div class="section-title product__discount__title text-center">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($offerproducts as $product)
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            @php
                                                $image = DB::table('product_images')
                                                    ->where('product_id', $product->id)
                                                    ->first();
                                                $discountamount = ($product->discount / 100) * $product->price;
                                                $afterdiscount = $product->price - $discountamount;
                                            @endphp
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{ Storage::disk('uploads')->url($image->filename) }}">
                                                <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>{{ $product->subcategory->title }}</span>
                                                <h5><a href="{{ route('products', $product->slug) }}">{{ $product->title }}</a></h5>
                                                <div class="product__item__price">Rs. {{ $afterdiscount }} <span>Rs.
                                                        {{ $product->price }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!-- discount end -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('frontend/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                    @php
                                        $i=1;
                                    @endphp
                                @foreach ($filterproducts as $product)
                                @php
                                    if($i < 4)
                                    {
                                        $show = 'block';
                                        $i = $i+1;
                                    }
                                    else {
                                        $show = 'none';
                                        $i = $i+1;
                                    }
                                @endphp
                                    <a href="{{route('products', $product->slug)}}" class="latest-product__item" style="display: {{$show}}">
                                        <div class="latest-product__item__pic">
                                            @php
                                                $image = DB::table('product_images')
                                                    ->where('product_id', $product->id)
                                                    ->first()
                                            @endphp
                                            <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$product->title}}" style="max-width: 110px; max-height: 110px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$product->title}}</h6>
                                            <span>Rs. {{$product->price}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                    @php
                                        $i=1;
                                    @endphp
                                @foreach ($filterproducts as $product)
                                @php
                                    if($i < 4)
                                    {
                                        $show = 'none';
                                        $i = $i+1;
                                    }
                                    else {
                                        $show = 'block';
                                        $i = $i+1;
                                    }
                                @endphp
                                    <a href="{{route('products', $product->slug)}}" class="latest-product__item" style="display: {{$show}}">
                                        <div class="latest-product__item__pic">
                                            @php
                                                $image = DB::table('product_images')
                                                    ->where('product_id', $product->id)
                                                    ->first()
                                            @endphp
                                            <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$product->title}}" style="max-width: 110px; max-height: 110px;">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$product->title}}</h6>
                                            <span>Rs. {{$product->price}}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-1.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-2.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-3.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-1.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-2.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-3.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-1.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-2.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-3.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-1.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-2.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{ asset('frontend/img/latest-product/lp-3.jpg') }}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
@endsection