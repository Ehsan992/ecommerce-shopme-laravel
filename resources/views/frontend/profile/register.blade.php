@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Register
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Create an Account</h3>
                                    </div>
                                    <form method="post">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="" placeholder="Enter Your Name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" placeholder="Enter Your Email">

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror </div>
                                        <div class="form-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required="" placeholder="Password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required="">
                                        </div>
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">{{ __('Submit') }}</button>
                                        </div>
                                    </form>
                                    <div class="divider-text-center mt-15 mb-15">
                                        <span> or</span>
                                    </div>
                                    <ul class="btn-login list_none text-center mb-15">
                                        <li><a href="#" class="btn btn-facebook hover-up"><i class="fab fa-facebook-f mr-10"></i>Facebook</a></li>
                                        <li><a href="#" class="btn btn-google hover-up"><i class="fab fa-google mr-10"></i>Google</a></li>
                                    </ul>
                                    <div class="text-muted text-center">Already have an account? <a href="#">Sign in now</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection