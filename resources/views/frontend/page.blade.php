@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> {{ $page->page_title }}
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-page">
                        <div class="single-header style-2">
                            <h2>{{ $page->page_title }}</h2>
                            <!-- <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                    <span class="post-by">By <a href="#">Jonh</a></span>
                                    <span class="post-on has-dot">9 April 2020</span>
                                    <span class="time-reading has-dot">8 mins read</span>
                                    <span class="hit-count has-dot">69k Views</span>
                                </div> -->
                        </div>
                        <div class="single-content">
                            <p>{!! $page->page_description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 primary-sidebar sticky-sidebar">
                    <div class="widget-area pl-30">
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
                                        <a href="blog-details.html">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection