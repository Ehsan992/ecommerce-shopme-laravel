@extends('layouts.admin')

@section('admin_content')

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Create Page</h2>
        <p>Website pages</p>
      </div>
      <div>
        <a href="{{route('create.page')}}" class="btn btn-primary btn-sm rounded">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
      <form role="form" action="{{route('page.store')}}" method="Post">
                @csrf
                <div class="card-body">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Page Position</label>
                   <select class="form-control" name="page_position">
                   	  <option value="1">Line One</option>
                   	  <option value="2">Line Two</option>
                   </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Page Name</label>
                    <input type="text" class="form-control" name="page_name" id="exampleInputEmail1" placeholder="Page Name">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword2">Page Title</label>
                    <input type="text" class="form-control" name="page_title" id="exampleInputPassword2" placeholder="Page Title">
                  </div>
                  

                  <div class="form-group">
                    <label for="exampleInputPassword3">Page Desciption</label>
                    <textarea class="form-control textarea" rows="4" name="page_description"></textarea>
                    <small>This data will show on your webpage.</small>
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
