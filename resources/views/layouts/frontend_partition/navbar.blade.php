<style>
    .inline-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .inline-list li {
        display: inline-block;
        margin-right: 10px;
        /* Adjust spacing between list items */
        text-align: left;
        /* Align the text to the left */
    }

    .submenu-title {
        text-align: left;
    }

    .left-align {
        text-align: left;
    }

    .dropdown-menu ul.inline-list {
        text-align: left;
    }
</style>

<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="#">{{ $setting->phone_one }}</a></li>
                            <li><i class="fa fa-map-marker-alt mr-5"></i><a target="_blank" href="page-location.html">Our location</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li><i class="fa fa-angle-double-right mr-5"></i> Get great devices up to 50% off <a class="active" href="shop-grid-right.html">View details</a></li>
                                <li><i class="fa fa-asterisk mr-5"></i><b class="text-danger">Supper Value Deals</b> - Save more with coupons</li>
                                <li><i class="fa fa-bell mr-5"></i> <b class="text-success"> Trendy 25</b> silver jewelry, save up 35% off today <a href="shop-grid-right.html">Shop now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>
                                <a class="language-dropdown-active" href="#"> <i class="fa fa-globe-americas"></i> English <i class="fa fa-chevron-down"></i></a>
                                <ul class="language-dropdown">
                                    <li><a href="#">Français</a></li>
                                    <li><a href="#">Deutsch</a></li>
                                    <li><a href="#">РУССКИЙ</a></li>
                                </ul>
                            </li>
                            @guest
                            @if (Route::has('login'))
                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                            @else
                            @if(Auth::user()->is_admin==1)
                            <li class="nav-item dropdown">
                                <a href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                            </li>
                            @endif
                            @if(Auth::user()->is_admin==0)
                            <li class="nav-item dropdown">
                                <a href="{{ route('user.dashboard') }}">{{ Auth::user()->name }}</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{ route('customer.logout') }}">
                                    {{ __('Logout') }}
                                </a>
                                </a>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap header-space-between">
                <div class="logo logo-width-1">
                    <a href="{{ route('shopme') }}"><img src="{{ url($setting->favicon) }}" alt="logo"></a>
                </div>
                <div class="search-style-2">
                    <form id="search-form" action="{{ route('search.index') }}" method="GET">
                        <select id="category" class="select-active" name="category">
                            <option value="">All Categories</option>
                            <option value="Women's Clothing">Women's Clothing</option>
                            <option value="Men's Clothing">Men's Clothing</option>
                            <option value="Cellphones">Cellphones</option>
                            <option value="Computer & Office">Computer & Office</option>
                            <option value="Consumer Electronics">Consumer Electronics</option>
                            <option value="Jewelry & Accessories">Jewelry & Accessories</option>
                            <option value="Home & Garden">Home & Garden</option>
                            <option value="Luggage & Bags">Luggage & Bags</option>
                            <option value="Shoes">Shoes</option>
                            <option value="Mother & Kids">Mother & Kids</option>
                        </select>
                        <input id="search-input" type="text" name="query" placeholder="Search for items…" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                        <button type="submit"> <i class="far fa-search"></i> </button>
                    </form>
                </div>
                <div id="search-popup" style="display: none;"></div>

                <div class="header-action-right">
                    <div class="header-action-2">
                        @php
                        $wishlist=DB::table('wishlists')->where('user_id',Auth::id())->count();
                        @endphp

                        <!-- @php
                        $cartCount = 0;
                        if (Auth::check()) {
                        $userId = Auth::id();
                        $cartContent = Cart::content()->filter(function ($item) use ($userId) {
                        return isset($item->options['user_id']) && $item->options['user_id'] == $userId;
                        });
                        $cartCount = $cartContent->count();
                        }
                        @endphp

                        <div class="cart-count">
                            Cart: <span>{{ $cartCount }}</span>
                        </div> -->

                        @php
                        $totalQuantity = 0;
                        if (Auth::check()) {
                        $userId = Auth::id();
                        $cartContent = Cart::content()->filter(function ($item) use ($userId) {
                        return isset($item->options['user_id']) && $item->options['user_id'] == $userId;
                        });
                        // Sum up the quantities of all items
                        $totalQuantity = $cartContent->sum('qty');
                        }
                        @endphp
                        <!-- 
                        <div class="cart-count">
                            Total Quantity in Cart: <span>{{ $totalQuantity }}</span>
                        </div> -->

                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img class="svgInject" alt="wowy" src="{{asset('frontend')}}/imgs/theme/icons/icon-heart.svg">
                                <span class="pro-count pro-count-wishlist blue">{{ $wishlist }}</span>
                            </a>
                        </div>

                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('cart') }}">
                                <img alt="wowy" src="{{ asset('frontend') }}/imgs/theme/icons/icon-cart.svg">
                                <span class="pro-count pro-count-cart blue" id="cart-count">
                                    {{ Auth::check() ? Cart::count() : 0 }}
                                    <!-- {{ Auth::check() ? $totalQuantity : 0 }} -->

                                </span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            @if(Auth::check())
                            @if(Auth::user()->is_admin == 1)
                            <a href="{{ route('home') }}">
                                <img alt="wowy" src="{{ asset('frontend') }}/imgs/theme/icons/icon-user.svg">
                            </a>
                            @else
                            <a href="{{ route('user.dashboard') }}">
                                <img alt="wowy" src="{{ asset('frontend') }}/imgs/theme/icons/icon-user.svg">
                            </a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom header-bottom-bg-color sticky-bar gray-bg sticky-blue-bg">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="index.html"><img src="{{asset('frontend')}}/imgs/theme/logo-white.png" alt="logo"></a>
                </div>
                <div class="main-categori-wrap d-none d-lg-block">
                    <a class="categori-button-active" href="#">
                        <span class="fa fa-list"></span> Browse Categories <i class="down far fa-chevron-down"></i> <i class="up far fa-chevron-up"></i>
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-large">
                        <ul>
                            @foreach($category as $row)
                            @php
                            $subcategory = DB::table('subcategories')->where('category_id', $row->id)->get();
                            @endphp
                            <li class="has-children">
                                <a href="{{ route('categorywise.product', $row->id) }}">
                                    <img src="{{ asset($row->icon) }}" height="32" width="32">
                                    {{ substr($row->category_name, 0, 20) }}
                                </a>
                                <div class="dropdown-menu">
                                    <ul class="mega-menu d-lg-flex">
                                        <li class="mega-menu-col col-lg-7">
                                            <ul class="d-lg-flex">
                                                <li class="mega-menu-col col-lg-12">
                                                    <ul style="text-align: left;">
                                                        <!-- Inline style for left alignment -->
                                                        @foreach($subcategory as $sub_row)
                                                        @php
                                                        $childcategory = DB::table('childcategories')->where('subcategory_id', $sub_row->id)->get();
                                                        @endphp
                                                        <li>
                                                            <span class="submenu-title">
                                                                <a href="{{ route('subcategorywise.product', $sub_row->id) }}">{{ $sub_row->subcategory_name }}</a>
                                                            </span>
                                                        </li>
                                                        @foreach($childcategory as $child)
                                                        <li>
                                                            <a class="dropdown-item nav-link nav_item" href="{{ route('childcategorywise.product', $child->id) }}" style="padding-left: 100px;">
                                                                >{{ $child->childcategory_name }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block main-menu-light-white hover-boder hover-boder-white">
                    <nav>
                        <ul>
                            <li>
                                <a class="active" href="{{ route('shopme') }}">Home</a>
                            </li>
                            <li>
                                <a href="{{ route('front.blog') }}">Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('about.us') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p><i class="fa fa-phone-alt"></i><span>Hotline</span> {{ $setting->phone_two }}</p>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="shop-wishlist.html">
                                <img alt="wowy" src="{{asset('frontend')}}/imgs/theme/icons/icon-heart-white.svg">
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="shop-cart.html">
                                <img alt="wowy" src="{{asset('frontend')}}/imgs/theme/icons/icon-cart-white.svg">
                                <span class="pro-count white">02</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a href="page-login-register.html">
                                <img alt="wowy" src="{{asset('frontend')}}/imgs/theme/icons/icon-user-white.svg">
                            </a>
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="{{asset('frontend')}}/imgs/theme/logo-default.png" alt="logo"></a>
            </div>
            <!-- {{asset('frontend')}}/imgs/theme/logo-default.png -->
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search…">
                    <button type="submit"> <i class="far fa-search"></i> </button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="far fa-bars"></span> Browse Categories <i class="down far fa-chevron-down"></i>
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            <li><a href="shop-grid-right.html"><i class="wowy-font-dress"></i>Women's Clothing</a></li>
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="index.html">Home</a>
                            <ul class="dropdown">
                                <li><a href="index.html">Home 1</a></li>
                                <li><a href="index-2.html">Home 2</a></li>
                                <li><a href="index-3.html">Home 3</a></li>
                                <li><a href="index-4.html">Home 4</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="shop-grid-right.html">shop</a>
                            <ul class="dropdown">
                                <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Single Product</a>
                                    <ul class="dropdown">
                                        <li><a href="shop-product-right.html">Product – Right Sidebar</a></li>
                                        <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                        <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop-filter.html">Shop – Filter</a></li>
                                <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                <li><a href="shop-cart.html">Shop – Cart</a></li>
                                <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                <li><a href="shop-compare.html">Shop – Compare</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Mega menu</a>
                            <ul class="dropdown">
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Women's Fashion</a>
                                    <ul class="dropdown">
                                        <li><a href="shop-product-right.html">Dresses</a></li>
                                        <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                        <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                        <li><a href="shop-product-right.html">Women's Sets</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Men's Fashion</a>
                                    <ul class="dropdown">
                                        <li><a href="shop-product-right.html">Jackets</a></li>
                                        <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                        <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Technology</a>
                                    <ul class="dropdown">
                                        <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                        <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                        <li><a href="shop-product-right.html">Tablets</a></li>
                                        <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                        <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="blog-category-fullwidth.html">Blog</a>
                            <ul class="dropdown">
                                <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                <li><a href="blog-category-list.html">Blog Category List</a></li>
                                <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Single Product Layout</a>
                                    <ul class="dropdown">
                                        <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                        <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                        <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('about.us') }}">About Us</a></li>
                                <li><a href="page-contact.html">Contact</a></li>
                                <li><a href="page-account.html">My Account</a></li>
                                <li><a href="page-login-register.html">login/register</a></li>
                                <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                <li><a href="page-terms.html">Terms of Service</a></li>
                                <li><a href="page-404.html">404 Page</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info">
                    <a class="mobile-language-active" href="#">Language <span><i class="far fa-angle-down"></i></span></a>
                    <div class="lang-curr-dropdown lang-dropdown-active">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">German</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div>
                </div>
                <div class="single-mobile-header-info mt-30">
                    <a target="_blank" href="page-location.html"> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="page-login-register.html">Log In</a>
                    <a href="page-login-register.html">Sign Up</a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#">(+01) - 2345 - 6789 </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="twitter" href="#"><i class="fab fa-twitter"></i></a>
                <a class="tumblr" href="#"><i class="fab fa-tumblr"></i></a>
                <a class="instagram" href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $('#search-input').on('keyup', function() {
            var query = $(this).val().trim();
            var category = $('#category').val();
            if (query.length > 0) {
                $.ajax({
                    url: '/search/ajax',
                    type: 'GET',
                    data: {
                        query: query,
                        category: category
                    },
                    success: function(data) {
                        displayPopup(data);
                    }
                });
            } else {
                hidePopup();
            }
        });
        $('#search-input').on('focusin', function() {
            var query = $(this).val().trim();
            if (query.length > 0) {
                $('#search-popup').show();
            }
        });
        // Function to display the popup
        function displayPopup(products) {
            var popupContent = '';
            products.forEach(function(product) {
                popupContent += '<div>';
                popupContent += '<img src="' + product.thumbnail + '" alt="' + product.name + '" style="width: 50px; height: 50px; float: left; margin-right: 10px;">'; // Set image size
                popupContent += '<a href="/product-details/' + product.id + '">' + product.name + '</a><br>';
                popupContent += '</div>';
            });
            $('#search-popup').html(popupContent).show();
            $('#search-popup').on('click', function(event) {
                event.stopPropagation();
            });
        }

        function hidePopup() {
            $('#search-popup').hide(); // Hide the popup
        }
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#search-popup, #search-input').length) {
                hidePopup();
            }
        });
    });
</script>

<style>
    #search-popup {
        display: none;
        position: fixed;
        top: 25%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 38%;
        max-height: 25%;
        background-color: #292A2D;
        z-index: 9999;
        overflow: auto;
        color: #fff;
        padding: 20px;
    }

    #search-popup div {
        margin-bottom: 10px;
        clear: both;
    }
</style>