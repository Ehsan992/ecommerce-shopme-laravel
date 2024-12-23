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
					<div class="tab-pane" id="account-detail" aria-labelledby="account-detail-tab">
						<div class="card">
							<div class="card-header">
								<h3>Write a web review</h3>
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
				</div>
			</div>
		</div>
	</div>
	<!-- END SECTION SHOP -->

</div>
<!-- END MAIN CONTENT -->

@endsection