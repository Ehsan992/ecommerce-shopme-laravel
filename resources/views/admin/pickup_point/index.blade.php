@extends('layouts.admin')

@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Pickup Point List </h2>
        <p>All The List of Pickup Point.</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addModal">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover ytable">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Pickup Point</th>
                <th scope="col">Adress</th>
                <th scope="col">Phone</th>
                <th scope="col">Another Phone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
          <form id="deleted_form" action="" method="post">
            @method('DELETE')
            @csrf
          </form>
        </div> <!-- table-responsive //end -->
      </div> <!-- card-body end// -->
    </div>
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
{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Pickup Point</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
        </button>
      </div>
      <div id="modal_body">

      </div>
    </div>
  </div>
</div>

{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add Pickup Point</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
        </button>
      </div>
      <form action="{{ route('store.pickup.point') }}" method="Post" id="add_form">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="coupon_code">Pickup Point Name <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="pickup_point_name" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Address <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_address" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Phone <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pickup_point_phone" required="">
          </div>
          <div class="form-group">
            <label for="coupon_amount">Another Phone </label>
            <input type="text" class="form-control" name="pickup_point_phone_two">
          </div>
          <div class="modal-footer">
            <button type="Submit" class="btn btn-primary"> <span class="loading d-none"> Loading....</span> Submit</button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $(function childcategory() {
    table = $('.ytable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('pickuppoint.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'pickup_point_name',
          name: 'pickup_point_name'
        },
        {
          data: 'pickup_point_address',
          name: 'pickup_point_address'
        },
        {
          data: 'pickup_point_phone',
          name: 'pickup_point_phone'
        },
        {
          data: 'pickup_point_phone_two',
          name: 'pickup_point_phone_two'
        },
        {
          data: 'action',
          name: 'action',
          orderable: true,
          searchable: true
        },
      ]
    });
  });
  $('body').on('click', '.edit', function() {
    let id = $(this).data('id');
    $.get("pickup-point/edit/" + id, function(data) {
      $("#modal_body").html(data);
    });
  });
  $(document).ready(function() {
    $(document).on('click', '#delete_coupon', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $("#deleted_form").attr('action', url);
      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $("#deleted_form").submit();
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });
    //data passed through here
    $('#deleted_form').submit(function(e) {
      e.preventDefault();
      var url = $(this).attr('action');
      var request = $(this).serialize();
      $.ajax({
        url: url,
        type: 'post',
        async: false,
        data: request,
        success: function(data) {
          toastr.success(data);
          $('#deleted_form')[0].reset();
          table.ajax.reload();
        }
      });
    });
  });
</script>

@endsection