@extends('layouts.admin')

@section('admin_content')

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Pages List </h2>
        <p>Website pages</p>
      </div>
      <div>
        <a href="{{route('create.page')}}" class="btn btn-primary btn-sm rounded">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-hover">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Page Name</th>
                <th scope="col">Page Title</th>
                <th scope="col" > Action </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($page as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $row->page_name }}</td>
                <td>{{ $row->page_title }}</td>
                <td>
                  <a href="{{route('page.edit',$row->id)}}" class="btn btn-sm font-sm rounded btn-brand  hover-up edit"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                  <a href="{{route('page.delete',$row->id)}}" class="btn btn-sm font-sm btn-danger rounded hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> </a>
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

@endsection