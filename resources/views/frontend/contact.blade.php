@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Pages
                <span></span> Contact us
            </div>
        </div>
    </div>
    <section class="hero-2">
        <div class="hero-content">
            <div class="container">
                <div class="text-center">
                    <h4 class="text-brand mb-20">Get in touch</h4>
                    <h1 class="mb-30 wow fadeIn animated font-xxl fw-900">
                        Contact Us <br> Asked <span class="text-style-1">Questions</span>
                    </h1>
                    <p class="w-50 m-auto mb-50 wow fadeIn animated">We’re here to help! If you have any questions, concerns, or feedback, please feel free to reach out to us through any of the methods below. Our customer service team is dedicated to providing you with the best possible assistance.</p>
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="{{ route('about.us') }}">About Us</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-50 pt-50 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 m-auto">
                    <div class="contact-from-area  padding-20-row-col wow tmFadeInUp">
                        <h3 class="mb-10 text-center">Contact Form</h3>
                        <p class="text-muted mb-30 text-center font-sm">Please fill out the form below, and we will get back to you as soon as possible.</p>
                        <form class="contact-form-style text-center" action="{{ route('contactme.submite') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                        <input required placeholder="Enter Name *" id="name" name="name" type="text" value="{{ Auth::check() ? Auth::user()->name : '' }}">

                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                    <input required placeholder="Enter Email *" id="email" name="email" type="email" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                    <input required placeholder="Enter Phone No. *" id="phone" name="phone" value="{{ Auth::check() ? Auth::user()->phone : '' }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-style mb-20">
                                    <input placeholder="Enter Subject" id="subject" name="subject">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="textarea-style mb-30">
                                    <textarea required placeholder="Message *" name="message" id="message" rows="4"></textarea>
                                    </div>
                                    <button class="submit submit-auto-width" type="submit">Send message</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection