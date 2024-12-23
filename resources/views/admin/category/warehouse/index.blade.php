@extends('layouts.admin')

@section('admin_content')

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Warehouse List </h2>
        <p>List of Warehouse</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addModal">Add new Warehouse</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="" class="table table-hover ytable">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Warehouse Name</th>
                <th scope="col">Warehouse Address</th>
                <th scope="col">Warehouse Phone</th>
                <th scope="col" class="text-end"> Action </th>
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
{{-- Warehouse insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add New Warehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em;color: white;"></i>
        </button>
      </div>
      <form action="{{ route('warehouse.store') }}"  method="Post" id="add-form">
        @csrf
        <div class="modal-body">
          <div class="mb-4">
            <label for="product_name" class="form-label">Warehouse Name</label>
            <input type="text" placeholder="Type here" class="form-control" name="warehouse_name" />
          </div>
          <div class="mb-4">
            <label for="product_name" class="form-label">Warehouse Address</label>
            <input type="text" placeholder="Type here" class="form-control" name="warehouse_address" />
          </div>
          <div class="mb-4">
            <label for="product_name" class="form-label">Warehouse Phone</label>
            <input type="text" placeholder="Type here" class="form-control" name="warehouse_phone" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


{{-- edit Warehouse modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Warehouse</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
        </button>
      </div>
      <div class="modal-body" id="modal_body">

      </div>
    </div>
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">
	$(function childcategory(){
		var table=$('.ytable').DataTable({
			processing:true,
			serverSide:true,
			ajax:"{{ route('warehouse.index') }}",
			columns:[
				{data:'DT_RowIndex',name:'DT_RowIndex'},
				{data:'warehouse_name'  ,name:'warehouse_name'},
				{data:'warehouse_address',name:'warehouse_address'},
				{data:'warehouse_phone',name:'warehouse_phone'},
				{data:'action',name:'action',orderable:true, searchable:true},

			]
		});
	});




  $('body').on('click','.edit', function(){
    let id=$(this).data('id');
    $.get("warehouse/edit/"+id, function(data){
        $("#modal_body").html(data);
    });
  });

  //form submit
  $('#add-form').on('submit',function(){
      $('.loader').removeClass('d-none');
      $('.submit_btn').addClass('d-none');
  });

</script>

@endsection