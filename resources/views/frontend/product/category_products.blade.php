@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<style>
    /* Custom CSS for pagination */
    .pagination_style1 .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination_style1 .page-link {
        color: #007bff;
    }
</style>

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('shopme') }}" rel="nofollow">Home</a>
                <span></span> category
                <span></span> {{ $category2->category_name }}
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-product-fillter">
                        @php
                        $productCount = \App\Models\Product::where('category_id', $category2->id)->count();
                        @endphp
                        <div class="totall-product">
                            <p> We found <strong class="text-brand">{{ $productCount }}</strong> items for you!</p>
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
                        <div id="product-listing" class="row">
                            @php
                            $serial = $products->firstItem(); // Get the first item number
                            @endphp
                            @foreach($products as $row)
                            <div class="col-lg-4 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="shop-product-right.html">
                                                <img class="default-img" src="{{ asset($row->thumbnail) }}" alt="">
                                                <img class="hover-img" src="{{ asset($row->thumbnail) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Quick view" class="quick_view action-btn hover-up" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-search"></i></a>
                                            <a aria-label="Add To Wishlist" class="action-btn wishlist-action-btn hover-up" href="#" data-id="{{ $row->id }}"> <i class="far fa-heart"></i> </a>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $category2->category_name }}</a>
                                        </div>
                                        <h2><a href="{{ route('product.details',$row->id) }}">{{ substr($row->name,0,25) }}...</a></h2>
                                        @php
                                        $sum_rating=App\Models\Review::where('product_id',$row->id)->sum('rating');
                                        $count_rating=App\Models\Review::where('product_id',$row->id)->count('rating');
                                        @endphp

                                        @if($sum_rating != NULL && $count_rating > 0)
                                        @php
                                        $average_rating = $sum_rating / $count_rating;
                                        @endphp
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: {{ $average_rating * 20 }}%"></div>
                                        </div>
                                        @else
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 100%"></div>
                                        </div>
                                        @endif
                                        <div class="product-price">
                                            @if($row->discount_price==NULL)
                                            <span>{{ $setting->currency }}{{ $row->selling_price }}</span>
                                            @else
                                            <span>{{ $setting->currency }}{{ $row->discount_price }}</span>
                                            <span class="old-price">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                            @endif
                                        </div>
                                        <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart_{{ $row->id }}">
                                            <!-- Hidden inputs to send product details -->
                                            <input type="hidden" name="id" value="{{ $row->id }}">
                                            <input type="hidden" name="qty" value="1" id="qty-input">
                                            @if($row->discount_price == NULL)
                                            <input type="hidden" name="price" value="{{$row->selling_price }}">
                                            @else
                                            <input type="hidden" name="price" value="{{ $row->discount_price}}">
                                            @endif
                                            <input type="hidden" name="color" value="{{ $row->color[0] ?? '' }}" id="color-input">
                                            <input type="hidden" name="size" value="{{ $row->size[0] ?? '' }}" id="size-input">

                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up add-to-cart-btn" id="add-to-cart-btn-{{ $row->id }}" href="javascript:void(0);">
                                                    <i class="far fa-shopping-bag"></i>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

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
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <!--Widget categories-->
                        <div class="sidebar-widget widget_categories mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Sub Categories</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="">
                                <ul class="categor-list">
                                    @foreach($subcategory as $row)
                                    @php
                                    $productCount = \App\Models\Product::where('subcategory_id', $row->id)->count();
                                    @endphp
                                    <li class="cat-item text-muted"><a href="{{ route('subcategorywise.product',$row->id) }}">{{ substr($row->subcategory_name,0,25) }}</a>({{ $productCount }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Fillter By Price -->

                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">New products</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach($new_added as $row)

                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="shop-product-detail.html">{{ substr($row->name,0,20) }}</a></h5>
                                    @if($row->discount_price==NULL)
                                    <span class="price mb-0 mt-5">{{ $setting->currency }}{{ $row->selling_price }}</span>
                                    @else
                                    <span class="price mb-0 mt-5">{{ $setting->currency }}{{ $row->discount_price }}</span>
                                    <del>{{ $setting->currency }}{{ $row->selling_price }}</del>
                                    @endif

                                    @php
                                    $sum_rating=App\Models\Review::where('product_id',$row->id)->sum('rating');
                                    $count_rating=App\Models\Review::where('product_id',$row->id)->count('rating');
                                    @endphp

                                    @if($sum_rating != NULL && $count_rating > 0)
                                    @php
                                    $average_rating = $sum_rating / $count_rating;
                                    @endphp
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: {{ $average_rating * 20 }}%"></div>
                                    </div>
                                    @else
                                    <div class="product-rate">
                                        <div class="product-rating" style="width: 100%"></div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <!--Widget categories-->
                        <div class="sidebar-widget widget_categories mb-50 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Manufacturers</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="">
                                <ul class="categor-list">
                                    <li class="cat-item text-muted"><a href="shop-grid-right.html">Adidas</a>(125)</li>
                                    <li class="cat-item text-muted"><a href="shop-grid-right.html">Armani</a>(68)</li>
                                    <li class="cat-item text-muted"><a href="shop-grid-right.html">Burberry</a>(274)</li>
                                    <li class="cat-item text-muted"><a href="shop-grid-right.html">Chanel</a>(152)</li>
                                    <li class="cat-item text-muted"><a href="shop-grid-right.html">Prada</a>(302)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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