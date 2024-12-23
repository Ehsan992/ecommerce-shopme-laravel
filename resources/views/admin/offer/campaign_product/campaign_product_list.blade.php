@extends('layouts.admin')
@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Campaign: {{ $campaign->title }}</h2>
        <p>All Products For Campaign Exist</p>
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
                <th scope="col">Image</th>
                <th scope="col">Code</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $key=>$row)
              <tr>
                <td>{{ ($products->currentPage()-1)*$products->perPage()+$key+1 }}</td>
                <td>{{ $row->name }}</td>
                <td><img src="{{ asset($row->thumbnail) }}" height="32" width="32"></td>
                <td>{{ $row->code }}</td>
                <td>{{ $row->price }}</td>
                <td>
                  <a href="{{ route('product.remove.campaign',$row->id) }}" id="delete" class="btn btn-sm font-sm btn-danger  hover-up"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!--pagination-->
        <div class="pagination-area mt-15 mb-md-5 mb-lg-0">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() }}">
                  <i class="fa fa-angle-left"></i>
                </a>
              </li>
              @for ($i = 1; $i <= $products->lastPage(); $i++)
              <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
              </li>
              @endfor
              <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}">
                  <i class="fa fa-angle-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
        <!--pagination-->
      </div>
    </div>
  </section>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
