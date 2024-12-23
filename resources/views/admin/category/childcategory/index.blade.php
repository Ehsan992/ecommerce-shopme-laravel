@extends('layouts.admin')
@section('admin_content')

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Childcategory List </h2>
        <p>List of childcategory</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addModal">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="" class="table table-hover ytable">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">ChildCategory Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">SubCategory Name</th>
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

{{-- category insert modal --}}

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add New Child Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em;color: white;"></i>
        </button>
      </div>
      <form action="{{ route('childcategory.store') }}" method="Post" id="add-form">
        @csrf

        <div class="modal-body">
          <div class="form-group">
            <label class="form-label">Category/Subcategory</label>
            <select class="form-select" name="subcategory_id">
              @foreach($category as $row)
              @php
              $subcat=DB::table('subcategories')->where('category_id',$row->id)->get();
              @endphp
              <option disabled="" style="color: blue;">{{ $row->category_name }}</option>
              @foreach($subcat as $row)
              <option value="{{ $row->id }}">{{ $row->subcategory_name }}</option>
              @endforeach
              @endforeach
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label">Child Category Name</label>
            <input type="text" placeholder="Type here" class="form-control" name="childcategory_name" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="Submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Childcategory</h4>
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
  $(function childcategory() {
    var table = $('.ytable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('childcategory.index') }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex'
        },
        {
          data: 'childcategory_name',
          name: 'childcategory_name'
        },
        {
          data: 'category_name',
          name: 'category_name'
        },
        {
          data: 'subcategory_name',
          name: 'subcategory_name'
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
    $.get("childcategory/edit/" + id, function(data) {
      $("#modal_body").html(data);
    });
  });
</script>

@endsection