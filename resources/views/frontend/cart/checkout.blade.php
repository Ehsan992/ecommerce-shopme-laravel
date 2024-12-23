@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="toggle_info">
                        <span><i class="far fa-gem mr-5"></i><span class="text-muted">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                    </div>
                    <div class="panel-collapse collapse coupon_form " id="coupon">
                        <div class="panel-body">
                            <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                            <form method="post">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Coupon Code...">
                                </div>
                                <div class="form-group">
                                    <button class="btn  btn-rounded btn-md" name="login">Apply Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50"></div>
                </div>
            </div>
            <form action="{{ route('order.place') }}" method="post" id="order-place">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_name" placeholder="Company Name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_phone" placeholder="Customer Phone *" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_country" placeholder="Country *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_address" placeholder="Shipping Address *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_email" placeholder="Email Address *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_zipcode" placeholder="Postcode / ZIP *">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" name="c_city" placeholder="City Name *">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($content as $row)
                                        @php
                                        $product=DB::table('products')->where('id',$row->id)->first();
                                        $colors=explode(',',$product->color);
                                        $sizes=explode(',',$product->size);
                                        @endphp
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{ asset($row->options->thumbnail) }}" alt="{{ $row->name }}"></td>
                                            <td><a href="shop-product-full.html">{{ $row->name }}</a> <span class="product-qty">x {{$row->qty }}</span></td>
                                            <td>{{ $setting->currency }}{{ $row->price }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">{{ $setting->currency }}{{ Cart::subtotal()}}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{ $setting->currency }}{{ Cart::total() }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="" value="Aamarpay">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                                        <div class="form-group collapse in" id="bankTranfer">
                                            <p class="text-muted mt-5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </p>
                                        </div>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="" value="Hand Cash">
                                        <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Hand Cash</label>
                                        <div class="form-group collapse in" id="paypal">
                                            <p class="text-muted mt-5">Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-fill-out btn-block mt-30" name="submit" value="Submit">Place Order</button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

@endsection