@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div> --}}
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row form-group">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="firstname" class="form-control" placeholder="Your First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastname" class="form-control" placeholder="Your Last Name">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address / Tole (Ex: Swoyambhu-15)" class="form-control" name="street">
                                {{-- <input type="text" placeholder="Apartment, suite, unite ect (optinal)"> --}}
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" placeholder="Ex: Kathmandu" name="town" class="form-control">
                            </div>
                            <div class="checkout__input">
                                <p>District<span>*</span></p>
                                <input type="text" class="form-control" placeholder="District you live in" name="district">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="postcode" class="form-control" placeholder="Ex: 44600">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" class="form-control" placeholder="Your phone no.">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" class="form-control" placeholder="Your email address">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Ship to a different address?
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text" placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div> --}}
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($cartproducts as $product)
                                        @php
                                            $real_product = DB::table('products')->where('id', $product->product_id)->first();
                                        @endphp
                                        <li>{{$real_product->title}} ({{$product->quantity}} * Rs. {{$product->price}}) <span>Rs. {{$product->quantity * $product->price}}</span></li>
                                    @endforeach
                                    {{-- <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li> --}}
                                </ul>
                                @php
                                    $grandtotal = 0;
                                    foreach ($cartproducts as $product) {
                                        $grandtotal = $grandtotal + ($product->price * $product->quantity);
                                    }
                                @endphp
                                <div class="checkout__order__subtotal">Subtotal <span>Rs. {{$grandtotal}}</span></div>
                                <div class="checkout__order__total">Total <span>Rs. {{$grandtotal}}</span></div>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p> --}}
                                    {{-- <input type="radio" name="payment" class="form-control" style="width: 7%;">Cash on Delievery
                                    <input type="radio" name="payment" class="form-control" style="width: 7%;">Esewa --}}
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
