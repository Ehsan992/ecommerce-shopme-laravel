@extends('layouts.admin')

@section('admin_content')
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
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Campaign List </h2>
        <p>List off Campaign</p>
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
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Discount(%)</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div> <!-- table-responsive //end -->
      </div> <!-- card-body end// -->
    </div>
  </section> <!-- content-main end// -->
</main>
{{-- category insert modal --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add New Campaign</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
        </button>
      </div>
      <form action="{{ route('campaign.store') }}" method="Post" enctype="multipart/form-data" id="add-form">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="brand-name">Campaign Title <span class="text-danger">*</span> </label>
            <input type="text" class="form-control" name="title" required="">
            <small id="emailHelp" class="form-text text-muted">This is campaign title/name </small>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="start-date">Start Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="start_date" required="">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="End-date">End Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="end_date" required="">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="start-date">Status<span class="text-danger">*</span></label>
                <select class="form-control" name="status">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="End-date">Discount (%) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="discount" required="">
                <small id="emailHelp" class="form-text text-danger">Discount percentage are apply for all prodcut selling price</small>

              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="brand-name">Brand Logo <span class="text-danger">*</span></label>
            <input type="file" class="dropify" data-height="140" id="input-file-now" name="image" required="">
            <small id="emailHelp" class="form-text text-muted">This is your campaign banner </small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="Submit" class="btn btn-primary"> <span class="d-none"> loading..... </span> Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Campaign</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
        </button>
      </div>
      <div id="modal_body">

      </div>
    </div>
  </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
  $('.dropify').dropify();
</script>
<script type="text/javascript">
  $(function childcategory() {
    var table = $('.ytable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('campaign.index') }}",
      columns: [{
          data: 'start_date',
          name: 'start_date'
        },
        {
          data: 'end_date',
          name: 'end_date'
        },
        {
          data: 'title',
          name: 'title'
        },
        {
          data: 'image',
          name: 'image',
          render: function(data, type, full, meta) {
            console.log(full); // Log the src value to the console
            return "<img src=\"" + data + "\"  height=\"30\" />";
          }
        },
        {
          data: 'discount',
          name: 'discount'
        },
        {
          data: 'status',
          name: 'status'
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
    $.get("campaign/edit/" + id, function(data) {
      $("#modal_body").html(data);
    });
  });
</script>

@endsection