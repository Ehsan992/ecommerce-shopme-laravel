@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<main class="main single-page">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> About us
            </div>
        </div>
    </div>
    <section id="home" class="hero-2 position-relative paralax-area">
        <div class="parallax-wrapper d-lg-block d-none">
            <div class="container">
                <div class="parallax-img-area h-500">
                    <div class="parallax-img img-5 wow animate__animated animate__fadeIn">
                        <img class="paralax-5" src="{{asset('frontend')}}/imgs/theme/icons/pattern-1.svg" alt="wowy">
                    </div>
                    <div class="parallax-img img-6 wow animate__animated animate__fadeIn">
                        <img class="paralax-6" src="{{asset('frontend')}}/imgs/theme/icons/pattern-2.svg" alt="wowy">
                    </div>
                    <div class="parallax-img img-7 wow animate__animated animate__fade">
                        <img class="paralax-7" src="{{asset('frontend')}}/imgs/theme/icons/pattern-3.svg" alt="wowy">
                    </div>
                    <div class="parallax-img img-8 wow animate__animated animate__fade">
                        <img class="paralax-8" src="{{asset('frontend')}}/imgs/theme/icons/pattern-4.svg" alt="wowy">
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-content">
            <div class="container">
                <div class="text-center">
                    <h4 class="text-brand mb-20">About Us</h4>
                    <h1 class="mb-30 wow fadeIn animated font-xxl fw-900">
                        Welcome to Shop Me <br> Where Your Shopping Dreams Come<span class="text-style-1">True!</span>.
                    </h1>
                    <p class="w-50 m-auto mb-50 wow fadeIn animated">At Shop Me, we believe that shopping should be an experience, not a chore. Our mission is to bring you the best in quality, style, and value, all from the comfort of your home. Founded in 2024, we have grown from a small startup to a leading online retailer, thanks to our loyal customers and dedicated team.</p>
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="{{ route('contact') }}">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div class="about-count d-md-block d-none">
        <div class="container">
            <div class="about-count-wrap box-shadow-outer-3 border-radius-10 border-1 border-solid border-muted p-40 position-relative z-index-100 bg-white">
                <div class="w-layout-grid achievements-grid">
                    <div class="achievement-wrapper">
                        <div class="achievement-number"><span class="count">5</span><span class="text-primary">M+</span></div>
                        <div class="achievement-text"> Happy Customers</div>
                    </div>
                    <div class="achievement-wrapper">
                        <div class="achievement-number"><span class="count">10,000</span><span class="text-brand">+</span></div>
                        <div class="achievement-text">5-Star Reviews</div>
                    </div>
                    <div class="achievement-wrapper">
                        <div class="achievement-number"><span class="count">1</span><span class="text-brand">M+</span></div>
                        <div class="achievement-text">Products Sold</div>
                    </div>
                    <div class="achievement-wrapper">
                        <div class="achievement-number"><span class="count">15</span>k<span class="text-warning">+</span></div>
                        <div class="achievement-text">Social <br>Follower</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="services" class="pt-150 pb-50 mb-30 bg-grey-9">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-12 col-md-12 text-center">
                    <h6 class="mt-0 mb-5 text-uppercase  text-brand font-sm wow fadeIn animated">Our Values</h6>
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated">Your satisfaction is <br><span class="text-style-1">our</span> top priority</h2>
                    <p class="w-50 m-auto text-grey-3 wow fadeIn animated">At Shop Me, our values are the foundation of everything we do. They guide our decisions, shape our culture, and define how we interact with our customers, partners, and community. </p>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 d-flex">
                        <div class="hero-card-icon icon-left hover-up ">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-8.svg" alt="">
                        </div>
                        <div class="pl-30">
                            <h4 class="mb-15 fw-500">
                                Quality Assurance
                            </h4>
                            <p class="text-grey-3">We are committed to offering only the best. From product selection to customer service, quality is ingrained in every aspect of our business. We meticulously curate our inventory to ensure that every item meets our high standards.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 d-flex">
                        <div class="hero-card-icon icon-left hover-up ">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-7.svg" alt="">
                        </div>
                        <div class="pl-30">
                            <h4 class="mb-15 fw-500">
                                Integrity and Transparency
                            </h4>
                            <p class="text-grey-3">We believe in conducting business with honesty and integrity. Transparency is key, and we are committed to clear communication with our customers, from product descriptions to company policies.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 d-flex">
                        <div class="hero-card-icon icon-left hover-up ">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-6.svg" alt="">
                        </div>
                        <div class="pl-30">
                            <h4 class="mb-15 fw-500">
                                Community Engagement
                            </h4>
                            <p class="text-grey-3">We are more than just a business; we are part of a community. We believe in giving back and supporting initiatives that make a positive difference in the lives of others.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 d-flex">
                        <div class="hero-card-icon icon-left hover-up ">
                            <img src="{{asset('frontend')}}/imgs/theme/icons/icon-5.svg" alt="">
                        </div>
                        <div class="pl-30">
                            <h4 class="mb-15 fw-500">
                                Continuous Improvement
                            </h4>
                            <p class="text-grey-3">We are always striving to improve. Feedback from our customers and team helps us to grow and enhance our services. We are committed to learning and adapting to serve you better.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-30">
                <div class="col-12 text-center">
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="{{ route('contact') }}">Contact Us</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="team" class="pt-50 wow fadeIn animated">
        <div class="container">
            <div class="row mb-50 align-items-center">
                <div class="col-md-6">
                    <h6 class="mt-0 mb-5 text-uppercase font-sm text-brand wow fadeIn animated">Our Team</h6>
                    <h2 class="mb-15 wow fadeIn animated">Top team of experts</h2>
                    <p class="text-grey-3 wow fadeIn animated">At Shop Me, we are proud to have a dedicated team of experts who bring their passion, experience, and expertise to deliver the best for our customers. Meet the leaders who make it all happen:</p>
                </div>
                <div class="col-md-6 text-md-end mt-30">
                </div>
            </div>
            <div class="position-relative">
                <div class="row wow fadeIn animated">
                    @foreach($team as $row)
                    <div class="col-lg-3 col-md-6">
                        <div class="blog-card border-radius-10 overflow-hidden text-center">
                            <img src="{{ asset($row->image) }}" alt="" class="border-radius-10 mb-30 hover-up">
                            <h4 class="fw-500 mb-0">{{ $row->name }}</h4>
                            <p class="fw-400 text-brand mb-10">{{ $row->roles }}</p>
                            <div class="social-icons social-icons-colored-hover">
                                <ul class="text-grey-5 d-inline-block">
                                    <li class="social-facebook"><a href="{{ $row->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="social-twitter"><a href="{{ $row->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                    <li class="social-instagram"><a href="{{ $row->instagram }}"><i class="fab fa-instagram"></i></a></li>
                                    <li class="social-linkedin"><a href="{{ $row->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--col-->
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <section id="work" class="mt-50 pt-50 pb-50 section-border">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-12 col-md-12 text-center">
                    <h6 class="mt-0 mb-5 text-uppercase  text-brand font-sm wow fadeIn animated">Wowy Coporation</h6>
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated">Our main branches<br> around the world</h2>
                    <p class="w-50 m-auto text-grey-3 wow fadeIn animated">At vero eos et accusamus et iusto odio dignissimos ducimus quiblanditiis praesentium. ebitis nesciunt voluptatum dicta reprehenderit accusamus</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img class="btn-shadow-brand hover-up border-radius-10 bg-brand-muted wow fadeIn animated" src="{{asset('frontend')}}/imgs/page/company-1.jpg" alt="">
                    <h4 class="mt-30 mb-15 wow fadeIn animated">New York, USA</h4>
                    <p class="text-grey-3 wow fadeIn animated">27 Division St, New York<br>NY 10002, USA</p>
                </div>
                <div class="col-md-4 text-center">
                    <img class="btn-shadow-brand hover-up border-radius-10 bg-brand-muted wow fadeIn animated" src="{{asset('frontend')}}/imgs/page/company-2.jpg" alt="">
                    <h4 class="mt-30 mb-15 wow fadeIn animated">Paris, France</h4>
                    <p class="text-grey-3 wow fadeIn animated">22 Rue des Carmes<br> 75005 Paris</p>
                </div>
                <div class="col-md-4 text-center">
                    <img class="btn-shadow-brand hover-up border-radius-10 bg-brand-muted wow fadeIn animated" src="{{asset('frontend')}}/imgs/page/company-3.jpg" alt="">
                    <h4 class="mt-30 mb-15 wow fadeIn animated">Jakarta, Indonesia</h4>
                    <p class="text-grey-3 wow fadeIn animated">2476 Raya Yogyakarta,<br>89090 Indonesia</p>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonials" class="pt-50 pb-50 mb-30">
        <div class="container">
            <div class="row mb-50">
                <div class="col-lg-12 col-md-12 text-center">
                    <h6 class="mt-0 mb-5 text-uppercase  text-brand font-sm wow fadeIn animated">some facts</h6>
                    <h2 class="mb-15 text-grey-1 wow fadeIn animated">Take a look what<br> our clients say about us</h2>
                    <p class="w-50 m-auto text-grey-3 wow fadeIn animated">At Shop Me, our customers' satisfaction is our greatest achievement. Here’s what some of our clients have to say:</p>
                </div>
            </div>
            <!--Popular Categories -->
            <section class="popular-categories bg-grey-9 pt-30 pb-30">
                <div class="container wow fadeIn animated">
                    <div class="carausel-6-columns-cover position-relative">
                        <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                        <div class="carausel-6-columns" id="carausel-6-columns">
                            @foreach($review as $row)
                            <div class="card-1 border-radius-10 hover-up p-30">
                                <figure class="mb-30 img-hover-scale overflow-hidden">
                                    <img src="{{ asset($row->user_photo) }}" alt="">
                                </figure>
                                <h5><a href="#">{{ $row->name }}</a></h5>
                                <p class="font-sm text-grey-5">{{ $row->review_date }}</p>
                                <p class="text-grey-3">{{$row->review}}</p>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
            <!--Popular Categories -->
        </div>
    </section>
    <section id="clients" class="pt-50 pb-50 bg-brand-muted bg-grey-9">
        <div class="row mb-30">
            <div class="col-lg-12 col-md-12 text-center">
                <h6 class="mt-0 mb-5 text-uppercase font-sm text-brand wow fadeIn animated">Trusted by 50.000+ user</h6>
                <h2 class="mb-5 text-grey-1 wow fadeIn animated">Our Partners</h2>
                <p class="w-50 m-auto font-sm text-grey-3 wow fadeIn animated">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="container">
            <div class="carausel-6-columns-cover arrow-center position-relative wow fadeIn animated">
                <div class="slider-arrow slider-arrow-3 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
                <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-1.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-2.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-3.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-4.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-5.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-6.png" alt="">
                    </div>
                    <div class="brand-logo">
                        <img class="img-grey-hover" src="{{asset('frontend')}}/imgs/banner/brand-3.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection