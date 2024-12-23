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
        <a href="{{route('blog.create.page')}}" class="btn btn-primary btn-sm rounded">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-hover">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Blog Category Name</th>
                <th scope="col">Blog Title</th>
                <th scope="col">Blog Slug</th>
                <th scope="col">Blog Publish Date</th>
                <th scope="col">Description</th>
                <th scope="col">Blog Image</th>
                <th scope="col">Blog status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach($page as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $row->category_name}}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->slug }}</td>
                <td>{{ $row->publish_date }}</td>



                <?php
                                    $limitedDescription = implode(' ', array_slice(explode(' ', strip_tags($row->description)), 0, 20));
                                ?>
                <td>{{ $limitedDescription }}</td>
                <td><img src="{{ asset($row->thumbnail) }}" alt="{{ $row->title }}" style="height: 50px; width: 50px;"></td>
                <td>{{ $row->status }}</td>
                <td>
                  <a href="{{route('blog.page.edit',$row->id)}}" class="btn btn-sm font-sm btn-brand  hover-up edit"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                  <a href="{{route('blog.page.delete',$row->id)}}" class="btn btn-sm font-sm btn-danger hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> </a>
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