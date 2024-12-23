@extends('layouts.admin')
@section('admin_content')

<main class="main-wrap">
	<section class="content-main">
		<div class="content-header">
			<div>
				<h2 class="content-title card-title">Order List </h2>
				<p>List of Order</p>
			</div>
		</div>
		<div class="card mb-4">
			<header class="card-header">
				<div class="row gx-3">
				{{-- <div class="col-lg-2 col-6 col-md-3 text-center">
						<!-- Added Bootstrap class "text-center" -->
						<label class="d-block bold-label">Category</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
						<select class="form-select submitable" name="category_id" id="category_id">
							<option value="">All</option>
							@foreach($category as $row)
              		 	    <option value="{{ $row->id }}">{{ $row->category_name }}</option>
              		 	  @endforeach 
						</select>
					</div>--}}
					<div class="col-lg-2 col-6 col-md-3 text-center">
						<!-- Added Bootstrap class "text-center" -->
						<label class="d-block bold-label">Payment Type</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
						<select class="form-select submitable" name="payment_type" id="payment_type">
							<option value="">All</option>
							<option value="Hand Cash">Hand Cash</option>
							<option value="Aamarpay">Aamarpay</option>
							<option value="Paypal">Paypal</option>
						</select>
					</div>
					<div class="col-lg-2 col-6 col-md-3 text-center">
						<!-- Added Bootstrap class "text-center" -->
						<label class="d-block bold-label">Date</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
						<input type="date" name="date" id="date" class="form-control submitable_input">
					</div>
					<div class="col-lg-2 col-6 col-md-3 text-center">
						<!-- Added Bootstrap class "text-center" -->
						<label class="d-block bold-label">Status</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
						<select class="form-select submitable" name="status" id="status" s>
							<option>All</option>
							<option value="0">Pending</option>
							<option value="1">Recieved</option>
							<option value="2">Shipped</option>
							<option value="3">Completed</option>
							<option value="4">Return</option>
							<option value="5">Canccel</option>
						</select>
					</div>
				</div>
			</header>

			<div class="card-body">
				<table id="" class="table table-hover ytable static-table">
					<thead>
						<tr>
							<th>#SL</th>
							<th scope="col">Name</th>
							<th scope="col">Phone</th>
							<th scope="col">Email</th>
							<th scope="col">Subtotal ({{ $setting->currency }})</th>
							<th scope="col">Total ({{ $setting->currency }})</th>
							<th scope="col">Payment Type</th>
							<th scope="col">Date</th>
							<th scope="col">Status</th>
							<th scope="col" class="text-end">Action</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</section>
</main>

<style>
  .modal-header {
    background-color: #5897fb;
    /* Change this to your desired background color */
    color: #333;
    /* Change this to your desired text color */
  }

  .modal-title-custom {
    font-weight: none;
    color: white;
  }
</style>




<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Order</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
		<i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em;color: white;"></i>
        </button>
      </div>
     <div id="modal_body">
        
     </div> 
    </div>
  </div>
</div>

<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
		<h4 class="modal-title modal-title-custom" id="exampleModalLabel">Order Details</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
		<i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em;color: white;"></i>
        </button>
      </div>
     <div id="view_modal_body">
        
     </div> 
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('admin.order.index') }}", 
		        "data":function(e) { 
		          e.status =$("#status").val();
		          e.date =$("#date").val();
		          e.payment_type =$("#payment_type").val();
		        }
		      },
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'c_name'  ,name:'c_name'},
				{data:'c_phone'  ,name:'c_phone'},
				{data:'c_email'  ,name:'c_email'},
				{data:'subtotal',name:'subtotal'},
				{data:'total',name:'total'},
				{data:'payment_type',name:'payment_type'},
				{data:'date',name:'date'},
				{data:'status',name:'status'},	
				{data:'action',name:'action',orderable:true, searchable:true},
			]
		});
	});

	
       //order edit
	$('body').on('click','.edit', function(){
	    var id=$(this).data('id');
		var url = "{{ url('order/admin/edit') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	         $("#modal_body").html(data);
	      }
	  });
    });

    //order view
	$('body').on('click','.view', function(){
	    var id=$(this).data('id');
		var url = "{{ url('/order/view/admin') }}/"+id;
		$.ajax({
			url:url,
			type:'get',
			success:function(data){  
	         $("#view_modal_body").html(data);
	      }
	  });
    });


   
  


	//submitable class call for every change
  $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });

  $(document).on('blur','.submitable_input', function(){
      $('.ytable').DataTable().ajax.reload();
  });

</script>
@endsection