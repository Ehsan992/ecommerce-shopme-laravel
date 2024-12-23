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
        border-radius: 10px;
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
                    <div class="tab-pane" id="account-detail" aria-labelledby="account-detail-tab">
                        <div class="tab-pane">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Dashboard</h3>
                                </div>
                                <div class="card-body">

                                    <div class="card  p-2">
                                        <div class="row">
                                            <div class="col-md-9">
                                                Name: {{ $order->c_name }} <br>
                                                Phone: {{ $order->c_phone }} <br>
                                                OrderID: {{ $order->order_id }} <br>
                                                Status: @if($order->status==0)
                                                <span class="badge rounded-pill text-bg-danger">Order Pending</span>
                                                @elseif($order->status==1)
                                                <span class="badge rounded-pill text-bg-info">Order Recieved</span>
                                                @elseif($order->status==2)
                                                <span class="badge rounded-pill text-bg-primary">Order Shipped</span>
                                                @elseif($order->status==3)
                                                <span class="badge rounded-pill text-bg-success">Order Completed</span>
                                                @elseif($order->status==4)
                                                <span class="badge rounded-pill text-bg-warning">Order Return</span>
                                                @elseif($order->status==5)
                                                <span class="badge rounded-pill text-bg-danger">Order Cancel</span>
                                                @endif <br>
                                                Date: {{ date('d F Y'),strtotime($order->c_name)}} <br>
                                                Subtotal: {{ $order->subtotal }} {{ $setting->currency }}<br>
                                                Total: {{ $order->total }} {{ $setting->currency }}<br>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h4>My Order</h4>
                                    <div>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Color</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order_details as $key=>$row)
                                                <tr>
                                                    <th scope="row">{{ ++$key }}</th>
                                                    <td>{{ $row->product_name  }}</td>
                                                    <td>{{ $row->color }} </td>
                                                    <td>{{ $row->size }}</td>
                                                    <td>{{ $row->quantity }}</td>
                                                    <td>{{ $row->single_price }} {{ $setting->currency }}</td>
                                                    <td>{{ $row->subtotal_price }} {{ $setting->currency }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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