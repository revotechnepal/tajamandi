@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$product->title}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index')}}">Home</a>
                            <a href="{{route('shop')}}">{{$product->subcategory->title}}</a>
                            <span>{{$product->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{ Storage::disk('uploads')->url($productimage->filename) }}" alt="{{$product->title}}">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            @foreach ($productimages as $image)
                                <img data-imgbigurl="{{ Storage::disk('uploads')->url($image->filename) }}"
                                    src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$product->title}}">
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class=" col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->title}}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        @if ($product->discount > 0)
                            @php
                                $discountamount = ($product->discount / 100) * $product->price;
                                $afterdiscount = $product->price - $discountamount;
                            @endphp
                            <div class="product__details__price">Rs. {{$afterdiscount}} <span style="font-size: 20px; color: grey;"><strike>Rs. {{$product->price}}</strike> ({{$product->discount}}% off)</span></div>
                        @else
                            <div class="product__details__price">Rs. {{$product->price}}</div>
                        @endif
                        <p>{!! $product->details !!}</p>
                        @if (Auth::guest() || Auth::user()->role_id != 3)
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0)" onclick="openLoginModal();" class="primary-btn">ADD TO CART</a>
                            <a href="javascript:void(0)" onclick="openLoginModal();" class="heart-icon"><span class="icon_heart_alt"></span></a>
                        @elseif(Auth::user()->role_id==3)
                            <form action="{{route('addtocart', $product->id)}}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="1" name="quantity" min="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if ($product->discount > 0)
                                        @php
                                            $discountamount = ($product->discount / 100) * $product->price;
                                            $afterdiscount = $product->price - $discountamount;
                                        @endphp
                                        <input type="hidden" value="{{$afterdiscount}}" name="price" class="form-control">
                                    @else
                                        <input type="hidden" value="{{$product->price}}" name="price" class="form-control">
                                    @endif
                                </div>
                                <a href="#" class="primary-btn" onclick="this.parentNode.submit()">ADD TO CART</a>
                                <a href="{{route('addtowishlist', $product->id)}}" class="heart-icon"><span class="icon_heart_alt"></span></a>
                            </form>
                        @endif
                        <ul>
                            <li><b>Availability</b> <span>{{$product->quantity}} units In Stock</span></li>
                            {{-- <li><b>Shipping</b> <span>01 day shipping. <samp> Free pickup today</samp></span></li> --}}
                            <li><b>Weight</b> <span>{{$product->quantity}} {{$product->unit}}</span></li>
                            <li><b>Vendor</b> <span>{{$product->vendor->name}}</span></li>
                            {{-- <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(1)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus
                                        suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet
                                        quam
                                        vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                        accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis
                                        a
                                        pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam
                                        vehicula
                                        elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci
                                        luctus
                                        et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet
                                        aliquam
                                        vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                        sed sit amet dui. Proin eget tortor risus.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Reviews</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                @if (count($relatedproducts) == 0)
                    <div class="col-md-12 text-center">
                        <h3>No related products...</h3>
                    </div>
                @else
                    @foreach ($relatedproducts as $product)
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
                                            <h5 style="font-size: 20px; font-weight: 650"><a href="{{ route('products', $product->slug) }}">{{ $product->title }}</a></h5>
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
                @endif
                {{-- <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('frontend/img/product/product-2.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('frontend/img/product/product-3.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('frontend/img/product/product-7.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection
