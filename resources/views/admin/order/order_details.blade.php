@php
$setting = DB::table('settings')->first();
@endphp
<section class="content-main">
	<div class="content-header">
		<div>
			<h2 class="content-title card-title">Order detail</h2>
			<p>Details for Order ID: {{ $order->order_id }}</p>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th width="40%">Product</th>
									<th width="20%">Product Name</th>
									<th width="20%">Size</th>
									<th width="20%">Color</th>
									<th width="20%">QtyxPrice</th>
									<th width="20%" class="text-end">Subtotal</th>
								</tr>
							</thead>
							<tbody>
								@foreach($order_details as $row)
								<tr>
									<td>
										<a class="itemside" href="#">
											<div class="left">
												<img src="assets/imgs/items/1.jpg" width="40" height="40" class="img-xs" alt="Item">
											</div>
											<div class="info"> T-shirt blue, XXL size </div>
										</a>
									</td>
									<td> {{ $row->product_name }} </td>
									<td> {{ $row->size }} </td>
									<td> {{ $row->color }} </td>
									<td> {{ $row->quantity }} x {{ $row->single_price }} {{ $setting->currency }} </td>
									<td class="text-end"> {{ $row->subtotal_price }} {{ $setting->currency }} </td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<form action="{{ route('update.order.status') }}" method="Post" id="view_edit_form">
			@csrf
			<header class="card-header">
				<div class="row align-items-right">
					<div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
						<dl class="dlist">
							<dt>Subtotal:</dt>
							<dd>{{ $order->subtotal }} {{ $setting->currency }}</dd>
						</dl>
						<dl class="dlist">
							<dt>Shipping cost:</dt>
							<dd> 0</dd>
						</dl>
						<dl class="dlist">
							<dt>Grand total:</dt>
							<dd> <b class="h5">{{ $order->total }} {{ $setting->currency }}</b> </dd>
						</dl>
						<dl class="dlist">
							<dt class="text-muted">Status:</dt>
							<dd>
								<span class="badge rounded-pill alert-success text-success"> {{ $order->payment_type }}</span>
							</dd>
						</dl>
					</div>

					<input type="hidden" name="id" value="{{ $order->id }}">
					<input type="hidden" class="form-control" value="{{ $order->c_name }}" name="c_name">
					<input type="hidden" class="form-control" value="{{ $order->c_phone }}" name="c_phone">
					<input type="hidden" class="form-control" value="{{ $order->c_email }}" name="c_email">
					<input type="hidden" class="form-control" value="{{ $order->c_address }}" name="c_address">
					<div class="col-lg-6 col-md-6 ms-auto text-md-end">
						<select class="form-select d-inline-block mb-lg-0 mb-15 mw-200" name="status">
							<option value="0" @if($order->status==0) selected @endif>Pending</option>
							<option value="1" @if($order->status==1) selected @endif>Recieved</option>
							<option value="2" @if($order->status==2) selected @endif>Shipped</option>
							<option value="3" @if($order->status==3) selected @endif>Completed</option>
							<option value="4" @if($order->status==4) selected @endif>Return</option>
							<option value="5" @if($order->status==5) selected @endif>Canccel</option>
						</select>
						<button type="Submit" class="btn btn-primary">Update</button>

					</div>
				</div>
			</header> <!-- card-header end// -->
		</form>
	</div>
</section>