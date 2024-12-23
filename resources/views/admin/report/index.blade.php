@php
$setting = DB::table('settings')->first();
@endphp
@extends('layouts.admin')
@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">List of Order Reports </h2>
        <p>Catalog of Order Reports.</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded print" style="float:right;">Print</a>
      </div>
    </div>
    <div class="card mb-4">
      <header class="card-header">
        <div class="row gx-3">
          <div class="col-lg-2 col-6 col-md-3 text-center">
            <label class="d-block bold-label">Payment Type</label>
            <select class="form-select submitable" name="payment_type" id="payment_type">
              <option value="">All</option>
              <option value="Hand Cash">Hand Cash</option>
              <option value="Aamarpay">Aamarpay</option>
              <option value="Paypal">Paypal</option>
            </select>
          </div>
          <div class="col-lg-2 col-6 col-md-3 text-center">
            <label class="d-block bold-label">Date</label>
            <input type="date" name="date" id="date" class="form-control submitable_input">
          </div>
          <div class="col-lg-2 col-6 col-md-3 text-center">
            <label class="d-block bold-label">Status</label>
            <select class="form-select submitable" name="status" id="status">
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
        <div class="table-responsive">
          <table class="table table-hover ytable">
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
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div> <!-- table-responsive //end -->
      </div> <!-- card-body end// -->
    </div> <!-- card end// -->

  </section> <!-- content-main end// -->
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
	$(function products(){
		table=$('.ytable').DataTable({
			"processing":true,
		      "serverSide":true,
		      "searching":true,
		      "ajax":{
		        "url": "{{ route('report.order.index') }}", 
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
			]
		});
	});


//submitable class call for every change
  $(document).on('change','.submitable', function(){
      $('.ytable').DataTable().ajax.reload();
  });

  $(document).on('blur','.submitable_input', function(){
      $('.ytable').DataTable().ajax.reload();
  });

$('.print').on('click', function (e) {
    e.preventDefault();
    $('.loader').removeClass('d-none');
    $.ajax({
        url:"{{ route('report.order.print') }}",
        type:'get',
        data: {status : $('#status').val(), date: $('#date').val() , payment_type: $('#payment_type').val()},
        success:function(data){
            $('.loader').addClass('d-none');
            $(data).printThis({
                debug: false,                   
                importCSS: true,                
                importStyle: true,                               
                removeInline: false, 
                printDelay: 500,
                header : null,   
                footer : null,
            });
        }
    });
});

</script>
@endsection