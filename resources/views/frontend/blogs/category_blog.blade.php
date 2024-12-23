@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Blog
                <span></span> Security
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container custom">
            <div class="row">
                <div class="col-lg-9">
                    <div class="single-header mb-80">
                        <h1 class="font-xxl text-brand">Our Blog</h1>
                        <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                            <span class="post-by">32 Sub Categories</span>
                            <span class="post-on has-dot">1020k Article</span>
                            <span class="time-reading has-dot">480 Authors</span>
                            <span class="hit-count  has-dot">29M Views</span>
                        </div>
                    </div>
                    <div class="loop-grid loop-list pr-30">
                        @foreach($blog as $row)

                        <article class="wow fadeIn animated hover-up mb-30">
                            <div class="post-thumb" style="background-image: url({{ asset($row->thumbnail) }});">
                                <div class="entry-meta">
                                    <a class="entry-meta meta-2" href="blog-category-grid.html">{{ $row->category_name }}</a>
                                </div>
                            </div>
                            <div class="entry-content-2">
                                <h3 class="post-title mb-15">
                                    <a href="{{route('single.blog.page',$row->id)}}">{{ $row->title }}</a></h3>
                                <?php
                                    $limitedDescription = implode(' ', array_slice(explode(' ', strip_tags($row->description)), 0, 25));
                                ?>
                                <p class="post-excerpt mb-30">{{ $limitedDescription }}...</p>

                                <?php
                                $dateString = $row->publish_date;
                                $timestamp = strtotime($dateString);
                                $formattedDate = date("j F Y", $timestamp);
                                ?>
                                <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                    <div>
                                        <span class="post-on"> <i class="far fa-clock"></i><?php echo $formattedDate; ?></span>
                                        <span class="hit-count has-dot">126k Views</span>
                                    </div>
                                    <a href="{{route('single.blog.page',$row->id)}}" class="text-brand">Read more <i class="fa fa-arrow-right fw-300 text-brand ml-5"></i></a>
                                </div>
                            </div>
                        </article>
                        @endforeach

                    </div>
                    <!--post-grid-->


                    <!--pagination-->
                    <div class="pagination-area mt-15 mb-md-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <!-- Updated: Added justify-content-center -->
                                <li class="page-item {{ $blog->currentPage() == 1 ? 'active' : '' }}"><a class="page-link" href="{{ $blog->url(1) }}"><i class="fa fa-angle-left"></i></a></li>
                                @if($blog->currentPage() > 3)
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                @endif
                                @for ($i = max($blog->currentPage() - 1, 1); $i <= min($blog->currentPage() + 1, $blog->lastPage()); $i++)
                                    <li class="page-item {{ $i == $blog->currentPage() ? 'active' : '' }}"><a class="page-link" href="{{ $blog->url($i) }}">{{ $i }}</a></li>
                                    @endfor
                                    @if($blog->currentPage() < $blog->lastPage() - 2)
                                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                        @endif
                                        <li class="page-item {{ $blog->currentPage() == $blog->lastPage() ? 'active' : '' }}"><a class="page-link" href="{{ $blog->url($blog->lastPage()) }}">{{ $blog->lastPage() }}</a></li>
                                        <li class="page-item"><a class="page-link" href="{{ $blog->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </nav>
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
                                <h5 class="widget-title">Categories</h5>
                            </div>
                            <div class="post-block-list post-module-1 post-module-5">
                                <ul>
                                    @foreach($categories as $row)
                                    @php
                                    $blogCount = \App\Models\Blogs::where('blog_category_id', $row->id)->count();
                                    @endphp
                                    <li class="cat-item cat-item-6"><a href="{{route('category.blog',$row->id)}}">{{ str($row->category_name,0,20) }}</a> ({{ $blogCount }})</li>
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
                                @foreach($blog as $row)
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