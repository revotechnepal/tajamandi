@extends('frontend.layouts.app')

@section('content')

    <!-- Banner Section -->
    {{-- <div class="hero__item set-bg my-5" style="background-size:cover;" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}" >
        <div class="hero__text">
                   <span>FRESH FRUIT AND VEGETABLE</span>
            <h2>All Your Grocery Items </h2>
            <p>Free Pickup and Delivery Available</p>
            <a href="{{ route('shop') }}" class="primary-btn">SHOP NOW</a>
        </div>
    </div> --}}

    <section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($slider as $slideritem)
            <div onclick="location.href=" style="cursor: pointer; background-repeat: no-repeat;" class="single-hero-items set-bg" data-setbg="{{Storage::disk('uploads')->url($slideritem->images)}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>{{$slideritem->subtitle}}</span>
                            <h1>{{$slideritem->title}}</h1>
                            <p>{{$slideritem->description}}</p>
                            <a href="{{route('shop')}}" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    {{-- <div class="off-card">
                        <h2>Sale <span>{{$slideritem->discount}}%</span></h2>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>
</section>
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
                            <div onclick="location.href='{{route('subcategory', $subcategory->slug)}}';" style="cursor: pointer;" class="categories__item set-bg"
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
                                <div class="product-lg-6 col-md-4 col-sm-6 product-container">
                                    <div class="product__discount__item product__discount">
                                        @php
                                            $image = DB::table('product_images')
                                                ->where('product_id', $product->id)
                                                ->first();
                                            $discountamount = ($product->discount / 100) * $product->price;
                                            $afterdiscount = $product->price - $discountamount;
                                        @endphp
                                        <div onclick="location.href='{{ route('products', $product->slug) }}';" style="cursor: pointer;" class="product__discount__item__pic set-bg"
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
                            <div class="product-lg-6 col-md-4 col-sm-6 product-container">
                                <div class="product__item">
                                @php
                                    $image = DB::table('product_images')
                                        ->where('product_id', $product->id)
                                        ->first();
                                @endphp
                                    <div onclick="location.href='{{ route('products', $product->slug) }}';" style="cursor: pointer;" class="product__item__pic set-bg"
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
                                        <h5><a href="{{route('products', $product->slug)}}">{{$product->title}}</a></h5>
                                        <div class="product__item__price">Rs. {{$product->price}}</div>
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
            <div class="product__discount" style="border:none; margin-bottom:40px;">
                        <div class="section-title product__discount__title text-center">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($offerproducts as $product)
                                    <div class="col-lg-4 product-container">
                                        <div class="product__discount__item">
                                            @php
                                                $image = DB::table('product_images')
                                                    ->where('product_id', $product->id)
                                                    ->first();
                                                $discountamount = ($product->discount / 100) * $product->price;
                                                $afterdiscount = $product->price - $discountamount;
                                            @endphp
                                            <div onclick="location.href='{{ route('products', $product->slug) }}';" style="cursor: pointer;" class="product__discount__item__pic set-bg"
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
                                                <span>{{ $product->subcategory->title }}</span>
                                                <h5 style="font-size: 20px; font-weight: 650"><a href="{{ route('products', $product->slug) }}">{{ $product->title }}</a></h5>
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
            <div class="col-lg-12">
              <div class="latest-product__text">
                {{-- <h4>Latest Products</h4> --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Latest Products</h2>
                        </div>
                    </div>
                </div>
                <div class="latest-product__slider owl-carousel">
                  <div class="row latest-prdouct__slider__item">
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($filterproducts as $filterproduct)
                        @php
                            if($i < 5)
                            {
                                $show = 'block';
                                $i = $i+1;
                            }
                            else {
                                $show = 'none';
                                $i = $i+1;
                            }
                        @endphp
                        <a href="{{route('products', $filterproduct->slug)}}" class="latest-product__item col-lg-3 col-sm-6 " style="display: {{$show}}">
                            <div class="latest-product__item__pic">
                                @php
                                $image = DB::table('product_images')
                                    ->where('product_id', $filterproduct->id)
                                    ->first()
                                @endphp
                            <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$filterproduct->title}}" style="max-width: 110px; max-height: 110px;">
                            </div>
                            <div class="latest-product__item__text">
                            <h6>{{$filterproduct->title}}</h6>
                            <span>Rs. {{$filterproduct->price}}</span>
                            </div>
                        </a>
                      @endforeach
                  </div>

                  <div class="row latest-prdouct__slider__item">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($filterproducts as $filterproduct)
                      @php
                          if($i < 5)
                          {
                              $show = 'none';
                              $i = $i+1;
                          }
                          else {
                              $show = 'block';
                              $i = $i+1;
                          }
                      @endphp
                      <a href="{{route('products', $filterproduct->slug)}}" class="latest-product__item col-lg-3 col-sm-6" style="display: {{$show}}">
                          <div class="latest-product__item__pic">
                              @php
                              $image = DB::table('product_images')
                                  ->where('product_id', $filterproduct->id)
                                  ->first()
                              @endphp
                          <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$filterproduct->title}}" style="max-width: 110px; max-height: 110px;">
                          </div>
                          <div class="latest-product__item__text">
                          <h6>{{$filterproduct->title}}</h6>
                          <span>Rs. {{$filterproduct->price}}</span>
                          </div>
                      </a>
                    @endforeach
                </div>
                </div>
              </div>
            </div>


            <div class="col-lg-12">
                <div class="latest-product__text">
                  {{-- <h4>Latest Products</h4> --}}
                  <div class="row mt-5">
                      <div class="col-lg-12">
                          <div class="section-title">
                              <h2>Top Rated Products</h2>
                          </div>
                      </div>
                  </div>
                  <div class="latest-product__slider owl-carousel">
                    <div class="row latest-prdouct__slider__item">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($ratedproducts as $ratedproduct)
                          @php
                              if($i < 5)
                              {
                                  $show = 'block';
                                  $i = $i+1;
                              }
                              else {
                                  $show = 'none';
                                  $i = $i+1;
                              }
                          @endphp
                          <a href="{{route('products', $ratedproduct->product->slug)}}" class="latest-product__item col-lg-3 col-sm-6" style="display: {{$show}}">
                              <div class="latest-product__item__pic">
                                  @php
                                  $image = DB::table('product_images')
                                      ->where('product_id', $ratedproduct->product_id)
                                      ->first()
                                  @endphp
                              <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$ratedproduct->product->title}}" style="max-width: 110px; max-height: 110px;">
                              </div>
                              <div class="latest-product__item__text">
                              <h6>{{$ratedproduct->product->title}}</h6>
                              <span>Rs. {{$ratedproduct->product->price}}</span>
                              </div>
                          </a>
                        @endforeach
                    </div>

                    <div class="row latest-prdouct__slider__item">
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($ratedproducts as $ratedproduct)
                        @php
                            if($i < 5)
                            {
                                $show = 'none';
                                $i = $i+1;
                            }
                            else {
                                $show = 'block';
                                $i = $i+1;
                            }
                        @endphp
                        <a href="{{route('products', $ratedproduct->product->slug)}}" class="latest-product__item col-lg-3 col-sm-6" style="display: {{$show}}">
                            <div class="latest-product__item__pic">
                                @php
                                $image = DB::table('product_images')
                                    ->where('product_id', $ratedproduct->product_id)
                                    ->first()
                                @endphp
                            <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$ratedproduct->product->title}}" style="max-width: 110px; max-height: 110px;">
                            </div>
                            <div class="latest-product__item__text">
                            <h6>{{$ratedproduct->product->title}}</h6>
                            <span>Rs. {{$ratedproduct->product->price}}</span>
                            </div>
                        </a>
                      @endforeach
                  </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </section>
      <!-- Latest Product Section End -->
@endsection
