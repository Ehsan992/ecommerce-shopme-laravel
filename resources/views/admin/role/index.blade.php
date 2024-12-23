@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">User Role</h2>
        <p>All user role</p>
      </div>
      <div>
        <a href="{{ route('create.role') }}" class="btn btn-primary btn-sm rounded">Create new</a>
      </div>
    </div>
    <div class="card mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover ytable">
            <thead>
              <tr>
                <th>#SL</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              @foreach($data as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>
                  @if($row->blog==1) <span class="badge bg-success">Blogs</span>@endif
                  @if($row->category==1) <span class="badge bg-success">Category</span>@endif
                  @if($row->offer==1) <span class="badge bg-success">Offer</span>@endif
                  @if($row->report==1) <span class="badge bg-success">Report</span>@endif
                  @if($row->add_product==1) <span class="badge bg-success">Add Product</span>@endif
                  @if($row->product_list==1) <span class="badge bg-success">Product List</span>@endif
                  @if($row->brands==1) <span class="badge bg-success">Brands</span>@endif
                  @if($row->developer_team==1) <span class="badge bg-success">Developer Team</span>@endif
                  @if($row->order==1) <span class="badge bg-success">Orders</span>@endif
                  @if($row->pickup==1) <span class="badge bg-success">Pickup Point</span>@endif
                  @if($row->warehouse==1) <span class="badge bg-success">Warehouse</span>@endif
                  @if($row->setting==1) <span class="badge bg-success">Settings</span>@endif
                  @if($row->userrole==1) <span class="badge bg-success">Assign User Role</span>@endif
                  @if($row->account==1) <span class="badge bg-success">Account</span>@endif
                </td>
                <td>
                  <a href="{{ route('role.edit',$row->id) }}" class="btn btn-sm font-sm rounded btn-brand  hover-up edit"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                  <a href="{{ route('role.delete',$row->id) }}" class="btn btn-sm font-sm btn-danger rounded hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> </a>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

@endsection