@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<!-- START MAIN CONTENT -->
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">688</strong> items for you!</p>
                        </div>
                        <div class="sort-by-product-area">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fa fa-th"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span id="selected-show">12<i class="far fa-angle-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown" id="show-dropdown">
                                    <ul>
                                        <li><a href="#" class="show-option" data-limit="12">12</a></li>
                                        <li><a href="#" class="show-option" data-limit="25">25</a></li>
                                        <li><a href="#" class="show-option" data-limit="50">50</a></li>
                                        <li><a href="#" class="show-option" data-limit="100">100</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fa fa-sort-amount-down"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span id="selected-sort">Featured <i class="far fa-angle-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown" id="sort-dropdown">
                                    <ul>
                                        <li><a href="#" class="sort-option" data-sort="featured">Featured</a></li>
                                        <li><a href="#" class="sort-option" data-sort="price-asc">Price: Low to High</a></li>
                                        <li><a href="#" class="sort-option" data-sort="price-desc">Price: High to Low</a></li>
                                        <li><a href="#" class="sort-option" data-sort="date">Release Date</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @php
                        $serial = $products->firstItem(); // Get the first item number
                        @endphp
                        @foreach($products as $row)
                        <div class="col-lg-3 col-md-4">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="shop-product-right.html">
                                            <img class="default-img" src="{{ asset($row->thumbnail) }}" alt="">
                                            <img class="hover-img" src="{{ asset($row->thumbnail) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="quick_view action-btn hover-up" id="{{ $row->product_id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-search"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn wishlist-action-btn hover-up" href="#" data-id="{{ $row->id }}"> <i class="far fa-heart"></i> </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.html">Music</a>
                                    </div>
                                    <h2><a href="{{ route('campaign.product.details',$row->slug) }}">{{ substr($row->name,0,20) }}</a></h2>
                                    <div class="product-price">
                                        <span>{{ $setting->currency }}{{ $row->price }}</span>
                                    </div>
                                    <div class="product-action-1 show">
                                        <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i class="far fa-shopping-bag"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-md-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <!-- Updated: Added justify-content-center -->
                                <li class="page-item {{ $products->currentPage() == 1 ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $products->appends(request()->query())->url(1) }}">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                                @if($products->currentPage() > 3)
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                @endif
                                @for ($i = max($products->currentPage() - 1, 1); $i <= min($products->currentPage() + 1, $products->lastPage()); $i++)
                                    <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $products->appends(request()->query())->url($i) }}">{{ $i }}</a>
                                    </li>
                                    @endfor
                                    @if($products->currentPage() < $products->lastPage() - 2)
                                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                        @endif
                                        <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $products->appends(request()->query())->url($products->lastPage()) }}">{{ $products->lastPage() }}</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products->appends(request()->query())->nextPageUrl() }}">
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
<!-- END MAIN CONTENT -->
<script src="{{ asset('front') }}/js/shop_custom.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    //ajax request send for collect childcategory
    $(document).ready(function() {
        //ajax request send for collect childcategory
        $(document).on('click', '.quick_view', function(e) {
            e.preventDefault();
            var id = $(this).attr("id");
            $.ajax({
                url: "{{ url('/product-quick-view/') }}/" + id,
                type: 'get',
                success: function(data) {
                    $("#quick_view_body").html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sortDropdown = document.getElementById('sort-dropdown');
        var showDropdown = document.getElementById('show-dropdown');
        var selectedSort = document.getElementById('selected-sort');
        var selectedShow = document.getElementById('selected-show');
        sortDropdown.addEventListener('click', function() {
            sortDropdown.classList.toggle('active');
        });
        showDropdown.addEventListener('click', function() {
            showDropdown.classList.toggle('active');
        });
        var sortOptions = document.querySelectorAll('.sort-option');
        sortOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                var sort = this.getAttribute('data-sort');
                selectedSort.textContent = this.textContent + ' ';
                updateProductListing(sort);
            });
        });
        var showOptions = document.querySelectorAll('.show-option');
        showOptions.forEach(function(option) {
            option.addEventListener('click', function() {
                var limit = this.getAttribute('data-limit');
                selectedShow.textContent = limit + ' ';
                updateProductListing(null, limit);
            });
        });

        function updateProductListing(sort, limit) {
            // Get current URL without query parameters
            var url = window.location.href.split('?')[0];
            var params = new URLSearchParams(window.location.search);
            if (sort) params.set('sort', sort);
            if (limit) params.set('limit', limit);
            window.location.href = url + '?' + params.toString();
        }
    });
</script>
@endsection