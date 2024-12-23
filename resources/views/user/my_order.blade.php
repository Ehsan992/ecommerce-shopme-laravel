@extends('layouts.app')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: 2px solid #FF324D;
        /* Added border color */
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #FF324D;
        /* Added color to thead background */
        color: white;
        /* Added color to thead text */
    }

    tr:first-child {
        border-top: none;
    }

    tr:last-child td {
        border-bottom: none;
    }

    table {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Add border between rows */
    tr:not(:first-child) {
        border-top: 2px solid #FF324D;
    }

    /* Add left and right borders */
    td {
        border-left: 2px solid #FF324D;
        border-right: 2px solid #FF324D;
    }

    /* Adjust the borders for the first and last cells */
    td:first-child {
        border-left: none;
    }

    td:last-child {
        border-right: none;
    }
</style>

@section('content')

<!-- START SECTION BREADCRUMB -->
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container">
        <!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>My Account</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active">My Account</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- START MAIN CONTENT -->
<div class="main_content">

    <!-- START SECTION SHOP -->
    <div class="section">
        <div class="container">
            <div class="row">

            @include('user.sidebar')

                <div class="col-lg-9 col-md-8">
                    <div class="tab-content dashboard_content">
                        <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                            aria-labelledby="dashboard-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="card-body">
                                    <h4>My All Order</h4>
                                    <div>
                                        <table>
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
                                                            <span class="badge rounded-pill text-bg-danger">Order Pending</span>
                                                        @elseif($row->status==1)
                                                            <span class="badge rounded-pill text-bg-info">Order Recieved</span>
                                                        @elseif($row->status==2)
                                                            <span class="badge rounded-pill text-bg-primary">Order Shipped</span>
                                                        @elseif($row->status==3)
                                                            <span class="badge rounded-pill text-bg-success">Order Done</span> 
                                                        @elseif($row->status==4)
                                                            <span class="badge rounded-pill text-bg-warning">Order Return</span>   
                                                        @elseif($row->status==5)  
                                                            <span class="badge rounded-pill text-bg-danger">Order Cancel</span>
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
                        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Orders</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>#1234</td>
                                                    <td>March 15, 2020</td>
                                                    <td>Processing</td>
                                                    <td>$78.00 for 1 item</td>
                                                    <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>#2366</td>
                                                    <td>June 20, 2020</td>
                                                    <td>Completed</td>
                                                    <td>$81.00 for 1 item</td>
                                                    <td><a href="#" class="btn btn-fill-out btn-sm">View</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mb-3 mb-lg-0">
                                        <div class="card-header">
                                            <h3>Billing Address</h3>
                                        </div>
                                        <div class="card-body">
                                            <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212
                                            </address>
                                            <p>New York</p>
                                            <a href="#" class="btn btn-fill-out">Edit</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Shipping Address</h3>
                                        </div>
                                        <div class="card-body">
                                            <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212
                                            </address>
                                            <p>New York</p>
                                            <a href="#" class="btn btn-fill-out">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-detail" role="tabpanel"
                            aria-labelledby="account-detail-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Account Details</h3>
                                </div>
                                <div class="card-body">
                                    <p>Already have an account? <a href="#">Log in instead!</a></p>
                                    <form method="post" name="enq">
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label>First Name <span class="required">*</span></label>
                                                <input required="" class="form-control" name="name" type="text">
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input required="" class="form-control" name="phone">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Display Name <span class="required">*</span></label>
                                                <input required="" class="form-control" name="dname" type="text">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Email Address <span class="required">*</span></label>
                                                <input required="" class="form-control" name="email" type="email">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Current Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="password" type="password">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>New Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="npassword"
                                                    type="password">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Confirm Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="cpassword"
                                                    type="password">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit"
                                                    value="Submit">Save</button>
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
    <!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->

@endsection