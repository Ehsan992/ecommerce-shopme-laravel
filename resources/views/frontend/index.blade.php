@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')

<main class="main">
    <section class="home-slider bg-grey-9 position-relative">
        <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">

            @foreach($campaign as $row)

            <div class="single-hero-slider single-animation-wrap">
                <div class="container">
                    <div class="row align-items-center slider-animated-1">
                        <div class="col-lg-5 col-md-6">
                            <div class="hero-slider-content-2">
                                <h4 class="animated">Trade-In Offer</h4>
                                <h2 class="animated fw-900">Supper Value Deals</h2>
                                <h1 class="animated fw-900 text-brand">On All Products</h1>
                                <p class="animated">{{ $row->title }}</p>
                                <a class="animated btn btn-default btn-rounded" href="{{ route('frontend.campaign.product',$row->id) }}"> SHOP NOW <i class="fa fa-arrow-right"></i> </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-6">
                            <div class="single-slider-img single-slider-img-1">
                                <img class="animated" src="{{ asset($row->image) }}" width="699" height="620" alt="{{ $row->title }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="slider-arrow hero-slider-1-arrow"></div>
    </section>

    <section class="featured pb-30 pt-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-md-3 mb-lg-0">
                    <div class="banner-left-icon style-2 d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-truck.svg" alt="">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free Shipping</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
                    <div class="banner-left-icon style-2 d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-purchase.svg" alt="">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free Returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="banner-left-icon style-2 d-flex align-items-center wow fadeIn animated">
                        <div class="banner-icon">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-bag.svg" alt="">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Get 20% Off 1 Item</h3>
                            <p>When you sign up</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="banner-left-icon style-2 d-flex align-items-center wow fadeIn animated mb-sm-0">
                        <div class="banner-icon">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-operator.svg" alt="">
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Support Center</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-tabs pb-30 wow fadeIn animated">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Featured</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">Popular</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false">New added</button>
                </li>
            </ul>
            <!--End nav-tabs-->
            <div class="tab-content wow fadeIn animated" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">

                        @foreach($featured as $row)

                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="#">
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

                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab one (Featured)-->
                <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                    <div class="row product-grid-4">

                        @foreach($popular_product as $row)

                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
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

                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab two (Popular)-->
                <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                    <div class="row product-grid-4">

                        @foreach($new_added as $row)

                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
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

                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab three (New added)-->
            </div>
            <!--End tab-content-->
        </div>
    </section>

    <!--Popular Categories -->
    <section class="popular-categories bg-grey-9 pt-30 pb-30">
        <div class="container wow fadeIn animated">
            <h3 class="section-title mb-30"><span>Popular</span> Categories</h3>
            <div class="carausel-6-columns-cover position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                <div class="carausel-6-columns" id="carausel-6-columns">
                    @foreach($category as $row)
                    <div class="card-1 border-radius-10 hover-up p-30">
                        <figure class="mb-30 img-hover-scale overflow-hidden">
                            <img src="{{ asset($row->icon) }}" alt="{{ $row->category_name }}">
                        </figure>
                        <h5><a href="{{ route('categorywise.product',$row->id) }}">{{ substr($row->category_name,0,10) }}</a></h5>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!--Popular Categories -->

    <section class="pt-30 pb-30">
        <div class="container wow fadeIn animated">
            <h3 class="section-title style-1 mb-30">Trendy Product</h3>
            <div class="carausel-6-columns-cover arrow-center position-relative">
                <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows"></div>
                <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">

                    @foreach($trendy_product as $row)

                    <div class="product-cart-wrap small hover-up">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="#">
                                    <img class="default-img" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                    <img class="hover-img" src="{{ asset($row->thumbnail) }}" alt="{{$row->name}}">
                                </a>
                            </div>
                            <div class="product-action-1">
                                <a aria-label="Quick view" class="quick_view action-btn small hover-up"id="{{ $row->id }}" data-toggle="modal" data-target="#exampleModalCenter" tabindex="0"><i class="far fa-search"></i></a>
                                <a aria-label="Add To Wishlist" class="action-btn wishlist-action-btn small hover-up" href="#" tabindex="0" data-id="{{ $row->id }}"><i class="far fa-heart"></i></a>

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
                        </div>
                    </div>
                    <!--End product-cart-wrap-2-->
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    
    <section class="pt-30 pb-30">
        <div class="container">
            <h3 class="section-title style-1 mb-30 wow fadeIn animated">Featured Brands</h3>
            <div class="carausel-6-columns-cover arrow-center position-relative wow fadeIn animated">
                <div class="slider-arrow slider-arrow-3 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">

                    @foreach($brand as $row)
                    <div class="brand-logo">
                        <a href="{{ route('brandwise.product',$row->id) }}" title="{{ $row->brand_name }}"><img class="img-grey-hover" title="{{ $row->brand_name }}" src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}"></a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    
    <section class="pt-30 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-title style-1 mb-30 wow fadeIn animated">News & Trending</h3>
                    <div class="row post-list ">
                        @foreach($blog as $row)
                        <div class="col-lg-6 mb-4">
                        <article class="wow fadeIn animated">
                            <div class="d-md-flex d-block">
                                <div class="post-thumb d-flex mr-15 border-radius-10">
                                    <a class="color-white" href="single.html">
                                        <img class="border-radius-10" src="{{ asset($row->thumbnail) }}" alt="">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="entry-meta mb-5 mt-10">
                                        <a class="entry-meta meta-2" href="category.html"><span class="post-in text-danger font-x-small text-uppercase">{{ $row->category_name }}</span></a>
                                    </div>
                                    <h4 class="post-title mb-25 text-limit-2-row">
                                        <a href="{{route('single.blog.page',$row->id)}}">{{ $row->title }}</a>
                                    </h4>
                                    <?php
                                    $dateString = $row->publish_date;
                                    $timestamp = strtotime($dateString);
                                    $formattedDate = date("j F Y", $timestamp);
                                    ?>
                                    <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                        <div>
                                            <span class="post-on"> <i class="far fa-clock"></i> <?php echo $formattedDate; ?></span>
                                            <span class="hit-count has-dot">12M Views</span>
                                        </div>
                                        <a href="{{route('single.blog.page',$row->id)}}">Read more <i class="fa fa-arrow-right font-xxs ml-5"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="newsletter bg-brand p-30 text-white wow fadeIn animated">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col flex-horizontal-center">
                            <img class="icon-email" src="{{asset('frontend')}}/imgs/theme/icons/icon-email.svg" alt="">
                            <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                        </div>
                        <div class="col my-4 my-md-0">
                            <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$25 coupon for first shopping.</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form class="form-subcriber d-flex wow fadeIn animated" action="{{ route('store.newsletter') }}" method="post">
                        @csrf
                        <input type="email" name="email" class="form-control bg-white font-small" placeholder="Enter your email">
                        <button class="btn bg-dark text-white" type="submit" name="submit" value="Submit">Subscribe</button>
                    </form>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </section>
</main>
@endsection