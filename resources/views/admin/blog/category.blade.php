@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Blog Category</h2>
        <p>All blog categories list here</p>
      </div>
      <div>
        <a href="#" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#categoryModal">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-hover ytable">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Category Name</th>
                <th scope="col">Category Slug</th>
                <th scope="col"> Action </th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $row->category_name }}</td>
                <td>{{ $row->category_slug }}</td>
                <td>
                  <a href="#" class="btn btn-sm font-sm rounded btn-brand  hover-up edit" data-id="{{ $row->id }}" data-toggle="modal" data-target="#editModal"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></a>
                  <a href="{{ route('blog.category.delete',$row->id) }}" class="btn btn-sm font-sm btn-danger rounded hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</main>

{{-- category insert modal --}}
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title modal-title-custom" id="exampleModalLabel">Add New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
          <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
        </button>
      </div>
      <form action="{{ route('blog.category.store') }}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required="">
            <small id="emailHelp" class="form-text text-muted">This is your main blog category</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="Submit" class="btn btn-primary">Submit</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
  $('.dropify').dropify();
</script>

<script type="text/javascript">
  $('body').on('click', '.edit', function() {
    let cat_id = $(this).data('id');
    $.get("blog-category/edit/" + cat_id, function(data) {
      $("#modal_body").html(data);
    });
  });
</script>

@endsection