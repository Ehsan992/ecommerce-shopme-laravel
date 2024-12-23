@extends('layouts.app')
@include('layouts.frontend_partition.navbar')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> Account
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fa fa-atom mr-15"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fa fa-shopping-basket mr-15"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fa fa-paper-plane mr-15"></i>Web Review</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fa fa-map-marked mr-15"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fa fa-user-edit mr-15"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('customer.logout') }}"><i class="fa fa-lock mr-15"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="tab-content dashboard-content">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Hello {{ Auth::user()->name }}! </h5>
                                        </div>
                                        <div class="card-body">
                                            <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Your Orders</h5>
                                        </div>

                                        <div class="card-body">
                                            <h4>My All Order</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">OrderId</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col">Payment Type</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orders as $row)
                                                        <tr>
                                                            <td>{{ $row->order_id }}</td>
                                                            <td>{{ date('d F , Y') ,strtotime($row->order_id)  }}</td>
                                                            <td>{{ $row->total }} {{ $setting->currency }}</td>
                                                            <td>{{ $row->payment_type }}</td>
                                                            <td>@if($row->status==0)
                                                                <span class="badge rounded-pill bg-danger">Order Pending</span>
                                                                @elseif($row->status==1)
                                                                <span class="badge rounded-pill bg-info">Order Recieved</span>
                                                                @elseif($row->status==2)
                                                                <span class="badge rounded-pill bg-primary">Order Shipped</span>
                                                                @elseif($row->status==3)
                                                                <span class="badge rounded-pill bg-success">Order Done</span>
                                                                @elseif($row->status==4)
                                                                <span class="badge rounded-pill bg-warning">Order Return</span>
                                                                @elseif($row->status==5)
                                                                <span class="badge rounded-pill bg-danger">Order Cancel</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('view.order',$row->id) }}" class="btn btn-sm btn-info" title="view order"><i class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="mb-0">Write a web review</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Write your valuable review based on our product quality and services.</p>
                                            <form action="{{ route('store.website.review') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-12 mb-3">
                                                        <label>Display Name <span class="required">*</span></label>
                                                        <input required="" class="form-control" name="name" type="text" value="{{ Auth::user()->name }}">
                                                    </div>
                                                    <div class="form-group col-12 mb-3">
                                                        <label>Write Review<span class="required">*</span></label>
                                                        <textarea required="required" name="input_text" placeholder="Your review" class="form-control" name="input_text" rows="4"></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12 mb-3">
                                                        <label>Rating</label>
                                                        <select class="form-select" name="rating" aria-label="Default select example">
                                                            <option value="1">1 star</option>
                                                            <option value="2">2 star</option>
                                                            <option value="3">3 star</option>
                                                            <option value="4">4 star</option>
                                                            <option value="5" selected>5 star</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('store.website.review') }}" method="post" name="enq">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Shipping Name <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="shipping_name" type="text" value="">

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Shipping Phone<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="shipping_phone" value="" type="text">

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Shipping Address<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="shipping_address" value="" type="text">

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Shipping Email<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="shipping_email" value="" type="email">

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Shipping City <span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="shipping_country" value="" type="text">

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Shipping Zipcode<span class="required">*</span></label>
                                                        <input required="" class="form-control square" name="shipping_zipcode" value="" type="text">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Change Your Profile Picture</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="card-body text-center wrapper">
                                                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                                                <div class="image" style="position: relative;">
                                                                    <img src="{{ asset(str_replace('/write', '', Auth::user()->user_photo)) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;border: 2px solid #5897FB;">
                                                                    <label for="file-path">
                                                                        <span class="material-symbols-rounded" style="position: absolute; top: 10%; left: 65%; transform: translate(-50%, -50%); background-color: #fff; border-radius: 50%; padding: 10px;">
                                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                                        </span>
                                                                    </label>
                                                                    <input type="file" accept="image/jpeg, image/png, image/jpg" id="file-path" class="user-file dropify" name="user_photo" style="display: none;">
                                                                </div>
                                                                <h5 class="my-3">{{ Auth::user()->name }}</h5>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Change User Name</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <form role="form" action="{{route('profile.setting.update')}}" method="Post">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="mb-4">
                                                                    <label for="product_title" class="form-label">Username</label>
                                                                    <input required="" class="form-control square @error('name') is-invalid @enderror" name="name" type="text" value="{{ Auth::user()->name }}" placeholder="Enter new username">
                                                                </div>
                                                                <div class="mb-4">
                                                                    <label for="product_title" class="form-label">Email</label>
                                                                    <input required="" class="form-control square @error('email') is-invalid @enderror" name="email" type="email" value="{{ Auth::user()->email }}" placeholder="Enter new email">
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Change Your Password</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ route('customer.password.change') }}" method="post" name="enq">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <label>Current Password <span class="required">*</span></label>
                                                                <input required="" class="form-control square" name="old_password" type="password" placeholder="Enter current password">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>New Password <span class="required">*</span></label>
                                                                <input required="" class="form-control square @error('password') is-invalid @enderror" name="password" type="password" placeholder="Enter new password">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <label>Confirm Password <span class="required">*</span></label>
                                                                <input required="" class="form-control square" name="password_confirmation" type="password" placeholder="re-type password">
                                                            </div>
                                                            <div class="form-group col-md-12">
                                                                <button type="submit" class="btn btn-fill-out submit" name="submit" value="Submit">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

@endsection