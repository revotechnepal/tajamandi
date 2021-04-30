@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Tajamandi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>{{$subcategory->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
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
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title product__discount__title text-center">
                                    <h2>{{$subcategory->title}} Products</h2>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        @if (count($products) == 0)
                            <div class="col-md-12 text-center">
                                <h3>No products yet..</h3>
                            </div>
                        @else
                        @foreach ($products as $product)
                        @if ($product->discount > 0)
                            <div class="col-lg-4">
                                <div class="product__discount__item">
                                    @php
                                        $image = DB::table('product_images')
                                            ->where('product_id', $product->id)
                                            ->first();
                                        $discountamount = ($product->discount / 100) * $product->price;
                                        $afterdiscount = $product->price - $discountamount;
                                    @endphp
                                    <div onclick="location.href='{{route('products', $product->slug)}}';" style="cursor: pointer;" class="product__discount__item__pic set-bg"
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
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                            @php
                                $image = DB::table('product_images')
                                    ->where('product_id', $product->id)
                                    ->first();
                            @endphp
                                <div onclick="location.href='{{route('products', $product->slug)}}';" style="cursor: pointer;" class="product__item__pic set-bg"
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
                        @endif

                    </div>
                    {{-- <div class="product__pagination text-center">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
