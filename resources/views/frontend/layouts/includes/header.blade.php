<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
@php
    $setting = DB::table('settings')->first();
@endphp
<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="" style="max-width: 150px; max-height: 170px;"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            @if (Auth::guest() || Auth::user()->role_id != 3)
                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart"></i> <span>0</span></a></li>
                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
            @elseif(Auth::user()->role_id==3)
                @php
                    $cartproducts = DB::table('carts')->where('user_id', Auth::user()->id)->get();
                    $wishlistproducts = DB::table('wishlists')->where('user_id', Auth::user()->id)->get();
                @endphp
                <li><a href="{{route('wishlist')}}"><i class="fa fa-heart"></i> <span>{{count($wishlistproducts)}}</span></a></li>
                <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{count($cartproducts)}}</span></a></li>
            @endif
        </ul>
        {{-- <div class="header__cart__price">item: <span>$150.00</span></div> --}}
    </div>
    <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
            @if (Auth::guest() || Auth::user()->role_id != 3)
                <a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-user"></i> Login</a>
            @elseif(Auth::user()->role_id==3)
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                    <i class="fa fa-user"></i> {{Auth::user()->name}}
                </a>
            </form>
            @endif
        </div>
    </div>
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="{{$setting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="{{$setting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
        {{-- <a href="#"><i class="fa fa-linkedin"></i></a> --}}
        {{-- <a href="#"><i class="fa fa-pinterest-p"></i></a> --}}
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{$setting->email}}</li>
            {{-- <li>Free Shipping for all Order of Rs. 500</li> --}}
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{$setting->email}}</li>
                            {{-- <li>Free Shipping for all Order of Rs. 500</li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{{$setting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="{{$setting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                <a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-user"></i> Login</a>
                            @elseif(Auth::user()->role_id==3)
                                <nav class="header__menu py-0">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                            <ul class="header__menu__dropdown text-center">
                                                <li><a href="#">My Account</a></li>
                                                <li><a href="#">My Profile</a></li>
                                                <li><a href="{{route('cart')}}">My Cart</a></li>
                                                <li><a href="{{route('wishlist')}}">My Wishlist</a></li>
                                                <li><a href="{{route('myreviews')}}">My Reviews</a></li>
                                                <li><form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                                Logout
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('index') }}"><img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="" style="max-width: 150px; max-height: 170px;"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        {{-- <li><a href="./blog.html">Blog</a></li> --}}
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        @if (Auth::guest() || Auth::user()->role_id != 3)
                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart"></i> <span>0</span></a></li>
                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
                        @elseif(Auth::user()->role_id==3)
                            @php
                                $cartproducts = DB::table('carts')->where('user_id', Auth::user()->id)->get();
                                $wishlistproducts = DB::table('wishlists')->where('user_id', Auth::user()->id)->get();
                            @endphp
                            <li><a href="{{route('wishlist')}}"><i class="fa fa-heart"></i> <span>{{count($wishlistproducts)}}</span></a></li>
                            <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{count($cartproducts)}}</span></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        @foreach ($subcategories as $category)
                            <li><a href="{{route('subcategory', $category->slug)}}">{{ $category->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            {{-- <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div> --}}
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{$setting->phone}}</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<div class="container mb-2">
    @if (session()->has('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    @if (session()->has('failure'))
        <div class="alert alert-danger mt-2">{{ session('failure') }}</div>
    @endif
</div>

