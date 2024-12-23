@extends('layouts.admin')

@section('admin_content')
<style type="text/css">
  /* Custom styles for bootstrap-tagsinput */
  .bootstrap-tagsinput {
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }

  .bootstrap-tagsinput .tag {
    background: #5897fb;
    border: 1px solid #5897fb;
    padding: 0.2rem 0.6rem;
    margin-right: 2px;
    color: white;
    border-radius: 0.25rem;
  }

  /* Additional styles to prevent override of form-control */
  .bootstrap-tagsinput input {
    margin: 0;
    border: none;
    outline: none;
    box-shadow: none;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
  }
</style>

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Create Blog</h2>
        <p>Website Blog</p>
      </div>
      <div>
        <a href="{{route('create.page')}}" class="btn btn-primary btn-sm rounded">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
      <form role="form" action="{{route('blog.page.store')}}" method="Post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">

            <div class="col-lg-12">
              <label class="form-label">Blog Category Name<span class="text-danger">*</span></label>
              <select class="form-select" name="category">
                @foreach($category as $row)
                <option value="{{ $row->id }}">{{ $row->category_name  }}
                </option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Blog Title</label>
              <input type="text" class="form-control" name="blog_title" id="exampleInputEmail1" placeholder="Page Name">
            </div>
            <div class="form-group">
              <label class="form-label">Blog Image</label>
              <input class="form-control" type="file" name="thumbnail" required="">

            </div>
            <div class="mb-4">
              <label class="form-label">Tags</label>
              <input type="text" class=form-control name="tags" value="{{ old('tags') }}" required="" data-role="tagsinput">
            </div>
            <div class="form-group">

              <label class="form-label">Blog Pgae Show</label>
              <select class="form-select" name="status">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword3">Blog Page Desciption</label>
              <textarea class="form-control textarea" rows="4" name="blog_description"></textarea>
              <small>This data will show on your webpage blog page.</small>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create Page</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</main>
@endsection