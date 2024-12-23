@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('shopme') }}" rel="nofollow">Home</a>
                <span></span> Single Page Product
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fa fa-search-plus"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        <figure class="border-radius-10">
                                            <img src="{{ asset($product->thumbnail) }}" alt="product image">
                                        </figure>
                                    </div>
                                    @php
                                    $images=json_decode($product->images,true);
                                    $color = explode(',', $product->color);
                                    $sizes=explode(',',$product->size);
                                    @endphp
                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails pl-15 pr-15">
                                        @isset($images)
                                        @foreach($images as $key => $image)
                                        <div><img src="{{ asset('files/product/' . $image) }}" alt="product image"></div>
                                        @endforeach
                                        @endisset
                                    </div>
                                </div>
                                <!-- End Gallery -->
                                <div class="single-social-share clearfix mt-50 mb-15">
                                    <p class="mb-15 mt-30 font-sm"> <i class="fa fa-share-alt mr-5"></i> Share this</p>
                                    <div class="mobile-social-icon wow fadeIn  mb-sm-5 mb-md-0 animated">
                                        <a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="tumblr" href="#"><i class="fab fa-tumblr"></i></a>
                                        <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </div>
                                <a class="mail-to-friend font-sm color-grey" href="#"><i class="far fa-envelope"></i> Email to a Friend</a>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info">
                                    <!-- Add to Card Form Start -->
                                    <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_to_cart">
                                        @csrf
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        <div class="product-detail-rating">
                                            <!-- Rating and Brand information -->
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand">{{ $setting->currency }}{{$product_price->price}}</span></ins>
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p>{!! $product->description !!}</p>
                                        </div>
                                        <div class="product_sort_info font-xs mb-30">
                                            <ul>
                                                <!-- Product info -->
                                            </ul>
                                        </div>
                                        @php $first = true; @endphp
                                        @isset($product->color)
                                        <div class="attr-detail attr-color mb-15">
                                            <strong class="mr-10">Color</strong>
                                            <ul class="list-filter color-filter">
                                                @foreach($color as $row)
                                                @php
                                                $col = "product-color-" . strtolower($row);
                                                $co = $row;
                                                @endphp
                                                <li class="{{ $first ? 'active' : '' }}"><a href="#" data-color="{{ $co }}"><span class="{{ $col }}"></span></a></li>
                                                @php $first = false; @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endisset
                                        @php $first = true; @endphp
                                        @isset($product->size)
                                        <div class="attr-detail attr-size">
                                            <strong class="mr-10">Size</strong>
                                            <ul class="list-filter size-filter font-small">
                                                @foreach($sizes as $size)
                                                <li class="{{ $first ? 'active' : '' }}"><a href="#" data-size="{{ $size }}">{{ $size }}</a></li>
                                                @php $first = false; @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endisset
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                <span class="qty-val">1</span>
                                                <a href="#" class="qty-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="product-extra-link2">
                                                <button type="submit" class="button button-add-to-cart">Add to cart</button>
                                                <a aria-label="Add To Wishlist" class="action-btn wishlist-action-btn hover-up" href="#" data-id="{{ $product->id }}"> <i class="far fa-heart"></i> </a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="far fa-exchange-alt"></i></a>
                                            </div>
                                        </div>
                                        <ul class="product-meta font-xs color-grey mt-50">
                                            <li class="mb-5">UPC: <a href="#">FWM15VKT</a></li>
                                            @php
                                            $tagsArray = explode(',', $product->tags);
                                            $tagCount = count($tagsArray);
                                            @endphp
                                            <li class="mb-5">Tags:
                                                @foreach($tagsArray as $index => $tag)
                                                <a href="#" rel="tag">{{ ucfirst(trim($tag)) }}</a>@if($index < $tagCount - 1),@elseif($index==$tagCount - 1) .@endif @endforeach </li> <li>Availability:<span class="in-stock text-success ml-5">{{ $product->stock_quantity }} Items In Stock</span></li>
                                        </ul>

                                        <!-- Hidden inputs to send product details -->
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1" id="qty-input">
                                        <input type="hidden" name="price" value="{{$product_price->price}}">
                                        <input type="hidden" name="color" id="color-input">
                                        <input type="hidden" name="size" id="size-input">
                                    </form>

                                    <!-- Add to Card Form End -->

                                </div>
                                <!-- Detail Info -->
                            </div>
                        </div>

                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews ({{ $review->count() }})</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        <p>{!! $product->description !!}</p>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                            <tr class="stand-up">
                                                <th>Product Name</th>
                                                <td>
                                                    <p>{{ $product->name }}</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-wo-wheels">
                                                <th>Product Color</th>
                                                <td>
                                                    <p>{{ $product->color }}</p>
                                                </td>
                                            </tr>
                                            <tr class="folded-w-wheels">
                                                <th>Product Brand</th>
                                                <td>
                                                    <p>{{ $product->brand->brand_name }}</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h4 class="mb-30">Customer questions & answers</h4>
                                                <div class="comment-list">
                                                    <!--single-comment Start-->
                                                    @foreach($review as $row)
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb text-center">
                                                                <img src="{{ asset($row->user_photo) }}" alt="">
                                                                <h6><a href="#">{{ $row->user->name }}</a></h6>
                                                                <p class="font-xxs">{{ date('d F , Y', strtotime($row->review_date)) }}</p>
                                                            </div>
                                                            <div class="desc">
                                                                @php
                                                                $ratingWidth = match($row->rating) {
                                                                5 => 100,
                                                                4 => 80,
                                                                3 => 60,
                                                                2 => 40,
                                                                1 => 20,
                                                                default => 0,
                                                                };
                                                                @endphp

                                                                @if($ratingWidth > 0)
                                                                <div class="product-rate d-inline-block">
                                                                    <div class="product-rating" style="width:{{ $ratingWidth }}%">
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                <p>{{ $row->review }}</p>
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                                        <a href="#" class="text-brand">Reply <i class="fa fa-arrow-right font-xs"></i> </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    <!--single-comment End -->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">Customer reviews</h4>
                                                <div class="d-flex mb-30">
                                                    <div class="product-rate d-inline-block mr-15">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <h6>4.8 out of 5</h6>
                                                </div>
                                                <div class="progress">
                                                    <span>5 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>4 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>3 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="progress">
                                                    <span>2 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                                </div>
                                                <div class="progress mb-30">
                                                    <span>1 star</span>
                                                    <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                                </div>
                                                <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="{{ route('store.review') }}" method="post" id="commentForm">
                                                    @csrf
                                                    <div class="col-sm-6">
                                                        <div class="form-group ">
                                                            <label for="review">Write Your Review</label>
                                                            <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
                                                                <option disabled="" selected="">Select Your Review</option>
                                                                <option value="1">1 star</option>
                                                                <option value="2">2 star</option>
                                                                <option value="3">3 star</option>
                                                                <option value="5">4 star</option>
                                                                <option value="5">5 star</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        @if(Auth::check())
                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
                                                        @else
                                                        <p class="button button-contactForm">Please at first login to your account for submit a review.</p>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-60">
                            <div class="col-12">
                                <h3 class="section-title style-1 mb-30">Related products</h3>
                            </div>
                            <div class="row">

                                @foreach($related_product as $row)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap small hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details',$row->id) }}" tabindex="0">
                                                    <img class="default-img" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                                    <img class="hover-img" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" tabindex="0"><i class="far fa-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="far fa-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="far fa-exchange-alt"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="{{ route('product.details',$row->id) }}" tabindex="0">{{ substr($row->name,0,20) }}</a></h2>
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
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="banner-img banner-big wow fadeIn f-none animated mt-50">
                            <img class="border-radius-10" src="assets/imgs/banner/banner-4.png" alt="">
                            <div class="banner-text">
                                <h4 class="mb-15 mt-40 text-white">Repair Services</h4>
                                <h2 class="fw-600 mb-20 text-white">We're an Apple <br>Authorised Service Provider</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <!--Widget categories-->
                        <div class="sidebar-widget widget_categories mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Categories</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="">
                                <ul class="categor-list">
                                    @foreach($categories as $row)
                                    @php
                                    $productCount = \App\Models\Product::where('category_id', $row->id)->count();
                                    @endphp
                                    <li class="cat-item text-muted"><a href="{{ route('categorywise.product',$row->id) }}"> {{ substr($row->category_name,0,20) }}</a>({{ $productCount }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

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
                                    <h5><a href="{{ route('product.details',$row->id) }}">{{ substr($row->name,0,20) }}</a></h5>

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
                                    @foreach($categories as $row)
                                    @php
                                    $productCount = \App\Models\Product::where('category_id', $row->id)->count();
                                    @endphp
                                    <li class="cat-item text-muted"><a href="{{ route('categorywise.product',$row->id) }}"> {{ substr($row->category_name,0,20) }}</a>({{ $productCount }})</li>
                                    @endforeach
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
    document.addEventListener('DOMContentLoaded', () => {
        // Handle color selection
        document.querySelectorAll('.list-filter.color-filter li a').forEach(colorElem => {
            colorElem.addEventListener('click', event => {
                event.preventDefault();
                document.querySelectorAll('.list-filter.color-filter li').forEach(li => li.classList.remove('active'));
                // Get the selected color value
                const selectedColor = event.currentTarget.getAttribute('data-color');
                console.log(`Selected color: ${selectedColor}`); // Log the selected color value
                // Update the hidden input value
                document.getElementById('color-input').value = selectedColor;
            });
        });
        // Handle size selection
        document.querySelectorAll('.list-filter.size-filter li a').forEach(sizeElem => {
            sizeElem.addEventListener('click', event => {
                event.preventDefault();
                document.querySelectorAll('.list-filter.size-filter li').forEach(li => li.classList.remove('active'));
                document.getElementById('size-input').value = event.currentTarget.getAttribute('data-size');
            });
        });
        // Handle quantity change
        const qtyInput = document.getElementById('qty-input');
        const qtyValElem = document.querySelector('.qty-val');
        document.querySelector('.qty-up').addEventListener('click', event => {
            event.preventDefault();
            let currentQty = parseInt(qtyValElem.textContent);
            currentQty++;
            console.log(`Quantity increased to: ${currentQty}`);
            qtyValElem.textContent = currentQty;
            qtyInput.value = currentQty;
            console.log(`Hidden input value set to: ${qtyInput.value}`);
        });
        document.querySelector('.qty-down').addEventListener('click', event => {
            event.preventDefault();
            let currentQty = parseInt(qtyValElem.textContent);
            if (currentQty > 1) {
                currentQty--;
                console.log(`Quantity decreased to: ${currentQty}`);
                qtyValElem.textContent = currentQty;
                qtyInput.value = currentQty;
                console.log(`Hidden input value set to: ${qtyInput.value}`);
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('add_to_cart').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Perform form submission via AJAX
            let formData = new FormData(this);
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Assuming you're using Laravel's CSRF protection
                }
            })
            .then(response => response.json().then(data => ({
                status: response.status,
                body: data
            })))
            .then(({ status, body }) => {
                if (status === 401) {
                    toastr.info('Please log in to add items to the cart.');
                } else if (status === 200) {
                    toastr.success('Product added to cart!');
                    // Update cart count dynamically
                    document.getElementById('cart-count').textContent = body.cartCount;
                } else {
                    toastr.warning('Failed to add product to cart!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('Failed to add product to cart!');
            });
        });
    });
</script>

@endsection