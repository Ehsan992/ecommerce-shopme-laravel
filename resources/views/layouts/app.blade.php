<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend')}}/imgs/theme/favico.svg">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/main.css">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- social media login-->
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.1.0/firebase-ui-auth.css" />
    <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/6.1.0/firebase-ui-auth.css" />
    <!-- Scripts -->

</head>

<body>
    @yield('content')
    @php
    $pages_one=DB::table('pages')->where('page_position',1)->get();
    $pages_two=DB::table('pages')->where('page_position',2)->get();
    @endphp
    <footer class="main">
        <section class="section-padding-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="index.html"><img src="{{ url($setting->favicon) }}" alt="logo"></a>
                            </div>
                            <h4 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h4>
                            <p class="wow fadeIn animated">
                                <strong>Address: </strong>{{ $setting->address }}
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>{{ $setting->phone_one }} /{{ $setting->phone_two }}
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Hours: </strong>10:00 - 18:00, Mon - Sat
                            </p>
                            <h4 class="mb-10 mt-20 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h4>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a class="facebook social-button" href="https://www.facebook.com/sharer/sharer.php?u=http://jorenvanhocht.be" id=""><i class="fab fa-facebook-f"></i></a>
                                <a class="twitter" href="https://twitter.com/intent/tweet?text=my share text&amp;url=http://jorenvanhocht.be" class="social-button " id=""><i class="fab fa-twitter"></i></a>
                                <a class="tumblr" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://jorenvanhocht.be&amp;title=my share text&amp;summary=dit is de linkedin summary" class="social-button " id=""><i class="fab fa-tumblr"></i></a>
                                <a class="instagram" href="https://wa.me/?text=http://jorenvanhocht.be"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title mb-30 wow fadeIn animated">About</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="{{ route('about.us') }}">About Us</a></li>
                            @foreach($pages_one as $row)
                            <li><a href="{{ route('view.page',$row->page_slug) }}">{{ $row->page_name }}</a></li>
                            @endforeach
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title mb-30 wow fadeIn animated">My Account</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="{{ route('cart') }}">View Cart</a></li>
                            <li><a href="{{ route('wishlist') }}">My Wishlist</a></li>
                            @if(auth()->check() && auth()->user()->is_admin == 0)
                            <li><a href="{{ route('user.dashboard') }}">Track My Order</a></li>
                            @endif
                            @foreach($pages_two as $row)
                            <li><a href="{{ route('view.page',$row->page_slug) }}">{{ $row->page_name }}</a></li>
                            @endforeach
                            @if(auth()->check() && auth()->user()->is_admin == 0)
                            <li><a href="{{ route('user.dashboard') }}">Order</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="widget-title mb-30 wow fadeIn animated">Download Our App</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">From App Store or Google Play</p>
                                <div class="download-app wow fadeIn animated">
                                    <a href="#" class="hover-up mb-sm-4"><img src="{{asset('frontend')}}/imgs/theme/app-store.jpg" alt=""></a>
                                    <a href="#" class="hover-up"><img src="{{asset('frontend')}}/imgs/theme/google-play.jpg" alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12">
                                <p class="mb-20 wow fadeIn animated mt-md-3">Secured Payment Gateways</p>
                                <img class="wow fadeIn animated" src="{{asset('frontend')}}/imgs/theme/payment-method.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">&copy; 2024, <strong class="text-brand">Shop Me</strong> -  Where Your Shopping Dreams Come True!</p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img class="jump" src="{{ url($setting->logo) }}" alt="">
                    <h5 class="mb-5">Now Loading</h5>
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{asset('frontend')}}/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('frontend')}}/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{asset('frontend')}}/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('frontend')}}/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/slick.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/wow.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/jquery-ui.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/magnific-popup.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/select2.min.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/waypoints.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/counterup.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/images-loaded.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/isotope.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/scrollup.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{asset('frontend')}}/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <!-- Template  JS -->
    <script src="{{asset('frontend')}}/js/main.js"></script>
    <script src="{{asset('frontend')}}/js/shop.js"></script>
    <!-- Share  JS 2 -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/share.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.wishlist-action-btn').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('id');
                var url = "{{ route('add.wishlist', ':id') }}".replace(':id', productId);
                $.ajax({
                    type: "POST",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            // Update wishlist count in the view
                            var newCount = response.wishlistCount;
                            $('.pro-count-wishlist').text(newCount);
                            toastr.success('Product added to wishlist!'); // Show toastr notification
                        } else {
                            toastr.error(response.message);
                            // Handle error response, if needed
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors
                        toastr.error('Error occurred while adding product to wishlist!');
                        // Handle errors
                    }
                });
            });
        });
    </script>
    <style>
        .modal-header {
            background-color: #2196f3;
            /* Change this to your desired background color */
            color: #333;
            /* Change this to your desired text color */
        }
        .modal-title-custom {
        font-weight: bold;
        color: white;
    }
    </style>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-lg  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title modal-title-custom" id="exampleModalLongTitle">Product Quick View</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
                        <i class="fa fa-times-circle" aria-hidden="true" style="font-size: 2em;"></i>
                    </button>
                </div>
                <div class="modal-body" id="quick_view_body">

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        //ajax request send for collect childcategory
        $(document).ready(function() {
            //ajax request send for collect childcategory
            $(document).on('click', '.quick_view', function(e) {
                e.preventDefault();
                var id = $(this).attr("id");
                $.ajax({
                    url: "{{ url('/product-quick-view/') }}/" + id,
                    type: 'get',
                    success: function(data) {
                        $("#quick_view_body").html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                let form = this.closest('form');
                if (form) {
                    let formData = new FormData(form);
                    fetch(form.action, {
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
                        .then(({
                            status,
                            body
                        }) => {
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
                } else {
                    console.error('Parent form element not found.');
                }
            });
        });
    });
</script>
</html>