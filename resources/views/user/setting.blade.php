@extends('layouts.app')
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
                                    <h3>Account Details</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('store.website.review') }}" method="post" name="enq">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Shipping Name<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_name" type="text" value="">
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Shipping Phone<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_phone" value="" type="text">
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label>Shipping Email<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_email" value="" type="email">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Shipping Address<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_address" value="" type="text">
                                            </div>
                                            <div class="form-group col-md-4 mb-3">
                                                <label>Shipping Country<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_country" value="" type="text">
                                            </div>
                                            <div class="form-group col-md-4 mb-3">
                                                <label>Shipping City<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_city" value="" type="text">
                                            </div>
                                            <div class="form-group col-md-4 mb-3">
                                                <label>Shipping Zipcode<span class="required">*</span></label>
                                                <input required="" class="form-control" name="shipping_zipcode" value="" type="text">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit"
                                                    value="Submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <br><hr>
                                <div class="card-body">
                                    <p><b>Change Your Password</b></p>
                                    <form action="{{ route('customer.password.change') }}" method="post" name="enq">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Current Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="old_password" type="password" placeholder="Enter current password">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>New Password <span class="required">*</span></label>
                                                <input required="" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Enter new password">
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>Confirm Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="password_confirmation" type="password" placeholder="re-type password">
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