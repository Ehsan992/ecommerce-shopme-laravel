@extends('layouts.admin')
@section('admin_content')

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Subcategory List</h2>
        <p>Showing All Subcategory List.</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#categoryModal">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <header class="card-header">
        <div class="row gx-3">
          <div class="col-lg-4 col-md-6 me-auto">
            <input type="text" placeholder="Search..." class="form-control">
          </div>
          <div class="col-lg-2 col-6 col-md-3">
            <select class="form-select">
              <option>Status</option>
              <option>Active</option>
              <option>Disabled</option>
              <option>Show all</option>
            </select>
          </div>
          <div class="col-lg-2 col-6 col-md-3">
            <select class="form-select">
              <option>Show 20</option>
              <option>Show 30</option>
              <option>Show 40</option>
            </select>
          </div>
        </div>
      </header> <!-- card-header end// -->
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Sub Category Name</th>
                <th scope="col">Sub Category Slug</th>
                <th scope="col">Category Name</th>
                <th scope="col" class="text-end"> Action </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($data as $key=>$row)
                <td>{{ $key+1 }}</td>
                <td><b>{{ $row->subcategory_name }}</b></td>
                <td><b>{{ $row->subcat_slug }}</b></td>
                <td><b>{{ $row->category->category_name }}</b></td>
                <td class="text-end">
                  <a href="#" class="btn btn-sm font-sm rounded btn-brand  hover-up edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i>Edit</a>
                  <a href="{{ route('category.delete',$row->id) }}" class="btn btn-sm font-sm btn-danger rounded hover-up"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> Delete</a>
                </td>
              </tr>
              @endforeach

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
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

{{-- category insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em;color: white;"></i>
        </button>
      </div>
      <form action="{{ route('subcategory.store') }}" method="Post">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label class="form-label">Category Name</label>
            <select class="form-select" name="category_id">
              @foreach($category as $row)
              <option value="{{ $row->id }}">{{ $row->category_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-4">
            <label class="form-label">SubCategory Name</label>
            <input type="text" placeholder="Type here" class="form-control" name="category_name" id="product_name" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger rounded font-sm hover-up" data-dismiss="modal">Close</button>
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
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Subcategory</h4>
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

{{-- edit modal --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Edit Category</h4>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>

<script type="text/javascript">
	$('body').on('click','.edit', function(){
		let subcat_id=$(this).data('id');
		$.get("subcategory/edit/"+subcat_id, function(data){
			$("#modal_body").html(data);
		});
	});
</script>

@endsection