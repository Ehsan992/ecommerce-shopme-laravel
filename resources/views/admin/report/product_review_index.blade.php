@extends('layouts.admin')
@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">List of Review Reports</h2>
        <p>Catalog of Review Reports.</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded print" style="float:right;">Print</a>
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">
        <div class="form-group col-3">
          <label>Customer Emotion on Product</label>
          <select class="form-control submitable" name="predicted_emotion" id="predicted_emotion">
            <option>All</option>
            <option value="negative">Negative</option>
            <option value="neutral">Neutral</option>
            <option value="positive">Positive</option>
          </select>
        </div>
        <div class="table-responsive">
          <table id="" class="table table-hover ytable">
            <thead>
              <tr>
                <th scope="col">User photo</th>
                <th scope="col">user</th>
                <th scope="col">Product Name</th>
                <th scope="col">review</th>
                <th scope="col">rating</th>
                <th scope="col">Predicted Emotion</th>
                <th scope="col">Review Date</th>
                <th scope="col">Review Month</th>
                <th scope="col">Review Year</th>
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
		        "url": "{{ route('product.review.report.index') }}", 
		        "data":function(e) { 
                    e.predicted_emotion =$("#predicted_emotion").val();

		        }
		      },
            columns:[{
          data: 'user_photo',
          name: 'user_photo',
          render: function(data, type, full, meta) {
            // Transform and prepend the base URL to the user_photo URL
            var imageUrl = data.replace('', '/');
            var fullImageUrl = imageUrl;
            console.log("Full Image URL:", imageUrl); // Log the full image URL
            return '<img src="' + fullImageUrl + '"  width="50px" />';
          }
        },
                {data:'email', name:'email'},
                {data:'name', name:'name'},
                {data:'review', name:'review'},
                {data:'rating', name:'rating'},
                {data:'predicted_emotion', name:'predicted_emotion'},
                {data:'review_date', name:'review_date'},
                {data:'review_month', name:'review_month'},
                {data:'review_year', name:'review_year'},
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
        url:"{{ route('product.review.report.print') }}",
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