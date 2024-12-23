@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
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
                                        <span> 50 <i class="far fa-angle-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">50</a></li>
                                        <li><a href="#">100</a></li>
                                        <li><a href="#">150</a></li>
                                        <li><a href="#">200</a></li>
                                        <li><a href="#">All</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fa fa-sort-amount-down"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="far fa-angle-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">Featured</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Release Date</a></li>
                                        <li><a href="#">Avg. Rating</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row product-grid-3">
                        @if($products->count() > 0)

                        @foreach($products as $row)

                        <div class="col-lg-3 col-md-4">
                        <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="#">
                                            <img class="default-img" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                            <img class="hover-img" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="quick_view action-btn hover-up" id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-search"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn wishlist-action-btn hover-up" href="#" data-id="{{ $row->id }}"> <i class="far fa-heart"></i> </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    
                                    <h2><a href="{{ route('product.details',$row->id) }}">{{ substr($row->name,0,20) }}</a></h2>
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
                        @else
                        <p>No products found</p>
                        @endif

                    </div>
                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-md-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i> </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection