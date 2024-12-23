@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<!-- @php
$tags = explode(',', $blog->tag);
@endphp -->
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Blog
                <span></span> Mobile
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-page">
                        <div class="single-header style-2">
                            <h1 class="mb-30">{{ $blog->title }}</h1>
                            <div class="single-header-meta">
                                <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                    <span class="post-by">By <a href="#">Jonh</a></span>
                                    <?php
                                        $dateString = $blog->publish_date;
                                        $timestamp = strtotime($dateString);
                                        $formattedDate = date("j F Y", $timestamp);
                                        ?>
                                    <span class="post-on has-dot"><?php echo $formattedDate; ?></span>
                                    <span class="time-reading has-dot">8 mins read</span>
                                    <span class="hit-count  has-dot">29k Views</span>
                                </div>
                                <div class="social-icons social-icons-colored-hover">
                                    <ul class="text-grey-5 d-inline-block">
                                        <li><strong class="mr-10">Share this:</strong></li>
                                        <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li class="social-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li class="social-linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <figure class="single-thumbnail">
                            <img src="{{ asset($blog->thumbnail) }}" alt="">
                        </figure>
                        <div class="single-content">
                            {!!$blog->description!!}
                        </div>
                        <div class="entry-bottom mt-50 mb-30 wow fadeIn  animated" style="visibility: visible; animation-name: fadeIn;">
                            <div class="tags w-50 w-sm-100">
                                @isset($blog->tag)
                                @foreach($tags as $tag)
                                <a href="blog-category-big.html" rel="tag" class="hover-up btn btn-sm btn-rounded mr-10">{{ $tag }}</a>
                                @endforeach
                                @endisset
                            </div>
                            <div class="social-icons social-icons-colored-hover">
                                <ul class="text-grey-5 d-inline-block">
                                    <li><strong class="mr-10">Share this:</strong></li>
                                    <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li class="social-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li class="social-linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="comments-area">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mb-30">Comments</h4>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="{{asset('frontend')}}/imgs/page/avatar-6.jpg" alt="">
                                                    <h6><a href="#">Jacky Chan</a></h6>
                                                    <p class="font-xxs">Since 2012</p>
                                                </div>
                                                <div class="desc">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                            <a href="#" class="text-brand">Reply <i class="fa fa-arrow-right font-xs"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--single-comment -->
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="{{asset('frontend')}}/imgs/page/avatar-7.jpg" alt="">
                                                    <h6><a href="#">Ana Rosie</a></h6>
                                                    <p class="font-xxs">Since 2008</p>
                                                </div>
                                                <div class="desc">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                            <a href="#" class="text-brand">Reply <i class="fa fa-arrow-right font-xs"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--single-comment -->
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="{{asset('frontend')}}/imgs/page/avatar-8.jpg" alt="">
                                                    <h6><a href="#">Steven Keny</a></h6>
                                                    <p class="font-xxs">Since 2010</p>
                                                </div>
                                                <div class="desc">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <p>Authentic and Beautiful, Love these way more than ever expected They are Great earphones</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                            <a href="#" class="text-brand">Reply <i class="fa fa-arrow-right font-xs"></i> </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--single-comment -->
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
                        <div class="comment-form">
                            <h4 class="mb-15">Leave a Comment</h4>
                            <div class="product-rate d-inline-block mb-30">
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <form class="form-contact comment_form" action="#" id="commentForm">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="button button-contactForm">Post Comment</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area">
                        <div class="sidebar-widget widget_search mb-50">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Search</h5>
                            </div>
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Search…">
                                    <button type="submit"> <i class="far fa-search"></i> </button>
                                </form>
                            </div>
                        </div>
                        <!--Widget categories-->
                        <div class="sidebar-widget widget_categories mb-50">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Blog Categories</h5>
                            </div>
                            <div class="post-block-list post-module-1 post-module-5">
                                <ul>
                                    @foreach($categories as $row)
                                    @php
                                    $blogCount = \App\Models\Blogs::where('blog_category_id', $row->id)->count();
                                    @endphp
                                    <li class="cat-item cat-item-6"><a href="blog-category-list.html">{{ str($row->category_name,0,20) }}</a> ({{ $blogCount }})</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--Widget social-->
                        <div class="sidebar-widget widget-social-network mb-50">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Follow Us</h5>
                            </div>
                            <div class="social-network">
                                <div class="follow-us d-flex align-items-center">
                                    <a class="follow-us-facebook clearfix mr-5 mb-10" href="#" target="_blank">
                                        <div class="social-icon">
                                            <i class="fab fa-facebook mr-5 v-align-space"></i>
                                            <i class="fab fa-facebook mr-5 v-align-space nth-2"></i>
                                        </div>
                                        <span class="social-name">Facebook</span>
                                        <span class="social-count count">65</span><span class="social-count">K</span>
                                    </a>
                                    <a class="follow-us-twitter clearfix ml-5 mb-10" href="#" target="_blank">
                                        <div class="social-icon">
                                            <i class="fab fa-twitter mr-5 v-align-space"></i>
                                            <i class="fab fa-twitter mr-5 v-align-space nth-2"></i>
                                        </div>
                                        <span class="social-name">Twitter</span>
                                        <span class="social-count count">75</span><span class="social-count">K</span>
                                    </a>
                                </div>
                                <div class="follow-us d-flex align-items-center">
                                    <a class="follow-us-instagram clearfix mr-5" href="#" target="_blank">
                                        <div class="social-icon">
                                            <i class="fab fa-instagram mr-5 v-align-space"></i>
                                            <i class="fab fa-instagram mr-5 v-align-space nth-2"></i>
                                        </div>
                                        <span class="social-name">Instagram</span>
                                        <span class="social-count count">32</span><span class="social-count">K</span>
                                    </a>
                                    <a class="follow-us-youtube clearfix ml-5" href="#" target="_blank">
                                        <div class="social-icon">
                                            <i class="fab fa-youtube mr-5 v-align-space"></i>
                                            <i class="fab fa-youtube mr-5 v-align-space nth-2"></i>
                                        </div>
                                        <span class="social-name">Youtube</span>
                                        <span class="social-count count">28</span><span class="social-count">K</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--Widget latest posts style 1-->
                        <div class="sidebar-widget widget_alitheme_lastpost mb-50">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Latest Posts</h5>
                            </div>
                            <div class="row">

                                @foreach($latestblog as $row)
                                <div class="col-md-6 col-sm-6 sm-grid-content mb-30">
                                    <div class="post-thumb d-flex border-radius-5 img-hover-scale mb-15">
                                        <a href="{{route('single.blog.page',$row->id)}}">
                                            <img src="{{ asset($row->thumbnail) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-content media-body">
                                        <h6 class="post-title mb-10 text-limit-2-row">{{ $row->title }}</h6>
                                        <?php
                                        $dateString = $row->publish_date;
                                        $timestamp = strtotime($dateString);
                                        $formattedDate = date("j F", $timestamp);
                                        ?>
                                        <div class="entry-meta meta-1 font-xxs color-grey">
                                            <span class="post-on"><?php echo $formattedDate; ?></span>
                                            <span class="hit-count has-dot">126k Views</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                        <!--Widget Tags-->
                        <div class="sidebar-widget widget_tags mb-50">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title">Popular tags </h5>
                            </div>
                            <div class="tagcloud">
                                <a class="tag-cloud-link" href="blog-category-grid.html">beautiful</a>
                                <a class="tag-cloud-link" href="blog-category-grid.html">New York</a>
                                <a class="tag-cloud-link" href="blog-category-grid.html">droll</a>
                                <a class="tag-cloud-link" href="blog-category-grid.html">intimate</a>
                                <a class="tag-cloud-link" href="blog-category-grid.html">loving</a>
                                <a class="tag-cloud-link" href="blog-category-grid.html">travel</a>
                                <a class="tag-cloud-link" href="blog-category-grid.html">fighting </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection