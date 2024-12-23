@extends('layouts.admin')

@section('admin_content')
@php
$customers=DB::table('users')->where('is_admin','0')->orWhere('is_admin',NULL)->orderBy('id','DESC')->limit(8)->get();
$latest_order=DB::table('orders')->orderBy('id','DESC')->limit(8)->get();
$most_views=DB::table('products')->orderBy('product_views','DESC')->where('status',1)->limit(8)->get();

$product=DB::table('products')->count();
$active_product=DB::table('products')->where('status',1)->count();
$inactive_product=DB::table('products')->where('status',0)->count();
$allcustomers=DB::table('users')->where('is_admin','0')->orWhere('is_admin',NULL)->count();
$category=DB::table('categories')->count();
$brands=DB::table('brands')->count();
$reviews=DB::table('reviews')->count();
$coupon=DB::table('coupons')->count();
$subscribers=DB::table('newsletters')->count();
$pending_order=DB::table('orders')->where('status',0)->count();
$success_order=DB::table('orders')->where('status',3)->count();
$setting=DB::table('settings')->first();
@endphp

<main class="main-wrap">

  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Dashboard </h2>
        <p>Whole data about your business here</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary material-icons md-qr_code"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Category</h6>
              <span>{{ $category }}</span>
              <span class="text-sm">
                Shipping fees are not included
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success  fa fa-certificate"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Brand</h6> <span>{{ $brands }}</span>
              <span class="text-sm">
                Excluding orders in transit
              </span>
            </div>
          </article>
        </div>
      </div>
     
     
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info fa fa-pie-chart"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Coupon</h6> <span>{{ $coupon }}</span>
              <span class="text-sm">
                Based in your local time.
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary fa fa-street-view"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Reviews</h6>
              <span>{{ $reviews }}</span>
              <span class="text-sm">
                Shipping fees are not included
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success fa fa-bullseye"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Subscribers</h6> <span>{{ $subscribers }}</span>
              <span class="text-sm">
                Excluding orders in transit
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-qr_code"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Pending Order</h6> <span>{{ $pending_order }}</span>
              <span class="text-sm">
                In 19 Categories
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Success Order</h6> <span>{{ $success_order }}</span>
              <span class="text-sm">
                Based in your local time.
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-primary fa fa-shopping-cart"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Total Product</h6>
              <span>{{ $product }}</span>
              <span class="text-sm">
                Shipping fees are not included
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-success fa fa-cart-plus"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Active Product</h6> <span>{{ $active_product }}</span>
              <span class="text-sm">
                Excluding orders in transit
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning fa fa-cart-arrow-down"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Inactive Product</h6> <span>{{ $inactive_product }}</span>
              <span class="text-sm">
                In 19 Categories
              </span>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card card-body mb-4">
          <article class="icontext">
            <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info fa fa-users"></i></span>
            <div class="text">
              <h6 class="mb-1 card-title">Customers</h6> <span>{{ $allcustomers }}</span>
              <span class="text-sm">
                Based in your local time.
              </span>
            </div>
          </article>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
          <article class="card-body">
            <h5 class="card-title">New Members</h5>
            <div class="new-member-list">
              <div class="row">
                @foreach($customers as $index => $cus)
                <div class="col-12 col-md-6 col-lg-3 mb-3">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      @if($cus->avatar == NULL)
                      <img src="{{ asset($cus->user_photo) }}" alt="user1" class="avatar" style="border-radius: 50%; width: 70px; height: 70px;" />
                      @else
                      <i class="fa fa-user-circle" aria-hidden="true"></i>

                      @endif
                    </div>
                    <div>
                      <h6>{{ $cus->name }}</h6>
                      <p class="text-muted font-xs">{{ date('d F Y', strtotime($cus->created_at)) }}</p>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>

    <div class="card mb-4">
      <header class="card-header">
        <h4 class="card-title">Latest orders</h4>
        <div class="row align-items-center">
          <div class="col-md-3 col-12 me-auto mb-md-0 mb-3">
            <div class="custom_select">
              <select class="form-select select-nice">
                <option selected>All Categories</option>
                <option>Women's Clothing</option>
                <option>Men's Clothing</option>
                <option>Cellphones</option>
                <option>Computer & Office</option>
                <option>Consumer Electronics</option>
                <option>Jewelry & Accessories</option>
                <option>Home & Garden</option>
                <option>Luggage & Bags</option>
                <option>Shoes</option>
                <option>Mother & Kids</option>
              </select>
            </div>
          </div>
          <div class="col-md-2 col-6">
            <input type="date" value="02.05.2021" class="form-control">
          </div>
          <div class="col-md-2 col-6">
            <div class="custom_select">
              <select class="form-select select-nice">
                <option selected>Status</option>
                <option>All</option>
                <option>Paid</option>
                <option>Chargeback</option>
                <option>Refund</option>
              </select>
            </div>
          </div>
        </div>
      </header>
      <div class="card-body">
        <div class="table-responsive">
          <div class="table-responsive">
            <table class="table align-middle table-nowrap mb-0">
              <thead class="table-light">
                <tr>
                  <th scope="col" class="text-center">
                    <div class="form-check align-middle">
                      <input class="form-check-input" type="checkbox" id="transactionCheck01">
                      <label class="form-check-label" for="transactionCheck01"></label>
                    </div>
                  </th>
                  <th class="align-middle" scope="col">Order ID</th>
                  <th class="align-middle" scope="col">Billing Name</th>
                  <th class="align-middle" scope="col">Date</th>
                  <th class="align-middle" scope="col">Total</th>
                  <th class="align-middle" scope="col">Payment Status</th>
                  <th class="align-middle" scope="col">Payment Method</th>
                  <th class="align-middle" scope="col">View Details</th>
                </tr>
              </thead>
              <tbody>
                @foreach($latest_order as $order)
                <tr>
                <td class="text-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="transactionCheck02">
                      <label class="form-check-label" for="transactionCheck02"></label>
                    </div>
                  </td>
                  <td><a href="#" class="fw-bold">#{{ $order->order_id }}</a></td>
                  <td>{{ $order->c_name }}</td>
                  
                  <td>{{ $order->date }}</td>
                  <td>{{ $setting->currency }}{{ $order->total }} </td>
                  <td>
                    @if($order->status==0)
                    <span class="badge badge-pill badge-soft-danger">Order Pending</span>
                    @elseif($order->status==1)
                    <span class="badge badge-pill badge-soft-info">Order Recieved</span>
                    @elseif($order->status==2)
                    <span class="badge badge-pill badge-soft-primary">Order Shipped</span>
                    @elseif($order->status==3)
                    <span class="badge badge-pill badge-soft-success">Order Done</span>
                    @elseif($order->status==4)
                    <span class="badge badge-warning">Order Return</span>
                    @elseif($order->status==5)
                    <span class="badge badge-pill badge-soft-danger">Order Cancel</span>
                    @endif
                  </td>
                  <td><i class="material-icons md-payment font-xxl text-muted mr-5"></i>{{ $order->payment_type }}</td>
                  <td>
                    <a href="#" class="btn btn-xs"> View details</a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div> <!-- table-responsive end// -->
      </div>
    </div>
  </section> <!-- content-main end// -->

  <footer class="main-footer font-xs">
    <div class="row pb-30 pt-15">
      <div class="col-sm-6">
        <script>
          document.write(new Date().getFullYear())
        </script> ©, Shop Me.
      </div>
      <div class="col-sm-6">
        <div class="text-sm-end">
          All rights reserved
        </div>
      </div>
    </div>
  </footer>
</main>
@endsection