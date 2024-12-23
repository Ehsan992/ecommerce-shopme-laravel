@extends('layouts.admin')
@section('admin_content')
<style>
.pagination-area .page-link {
    padding: 0px 0px; /* Adjust the padding as needed */
    border-radius: 10%; /* Makes the links circular */
}

.pagination-area .dot {
    padding: 10px 15px; /* Adjust the padding as needed */
}

.pagination-area .active .page-link {
    background-color: #007bff; /* Change background color of active page */
    color: #fff; /* Change text color of active page */
}

</style>

<main class="main-wrap">
  <section class="content-main">
    <div class="content-header">
      <div>
        <h2 class="content-title card-title">Campaign</h2>
        <p>All Campaign Products List</p>
      </div>
      <div>
        <a class="btn btn-primary btn-sm rounded" href="{{ route('campaign.product.list',$campaign_id) }}">Product List</a>
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
                <th scope="col">Category</th>
                <th scope="col">Brand</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              @php
              $exist=DB::table('campaign_product')->where('campaign_id',$campaign_id)->where('product_id',$product->id)->first();
              @endphp
              <tr>
                <td>{{ $products->firstItem() + $loop->index }}</td>
                <td>{{ $product->name }}</td>
                <td><img src="{{ asset($product->thumbnail) }}" height="32" width="32"></td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->category_name }}</td>
                <td>{{ $product->brand_name }}</td>
                <td>{{ $product->selling_price }}</td>
                <td>
                  @if(!$exist)
                  <a href="{{ route('add.product.to.campaign',[$product->id,$campaign_id]) }}" class="btn btn-sm font-sm btn-success  hover-up"><i class="fa fa-plus-circle" style="font-size: 1.5em;color: white;"></i></a>
                  @endif
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
                        @if ($i == $products->currentPage() || $i == $products->currentPage() - 1 || $i == $products->currentPage() + 1 || $i == 1 || $i == $products->lastPage())
                            <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->appends(request()->query())->url($i) }}">{{ $i }}</a>
                            </li>
                        @elseif ($i == $products->currentPage() - 2 || $i == $products->currentPage() + 2)
                            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        @endif
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
