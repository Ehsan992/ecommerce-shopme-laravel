@php 
  $setting=DB::table('settings')->first();
@endphp
<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{ route('home') }}" class="brand-wrap">
            <img src="{{ url($setting->favicon) }}" class="logo" alt="Wowy Dashboard">
        </a>
        <!-- {{asset('admin')}}/imgs/theme/logo.png -->
        <div>
            <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item active">
                <a class="menu-link" href="{{ route('home') }}"> <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            @if(Auth::user()->blog==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-form-product-1.html"> <i class="icon fa fa-file-text" style="font-size: 1.5em;"></i>
                    <span class="text">Blogs</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('admin.blog.category') }}">Blog Category</a>
                    <a href="{{ route('blog.page.index') }}">Blog</a>
                </div>
            </li>
            @endif
            @if(Auth::user()->category==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon fa fa-cubes" style="font-size: 1.5em;"></i>
                    <span class="text">Category</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('category.index') }}">Category</a>
                    <a href="{{ route('subcategory.index') }}">Sub Category</a>
                    <a href="{{route('childcategory.index')}}">Child Category</a>
                </div>
            </li>
            @endif
            @if(Auth::user()->offer==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-form-product-1.html"> <i class="icon fa fa-gift" style="font-size: 1.5em;"></i>
                    <span class="text">Offer</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('coupon.index') }}">Coupon</a>
                    <a href="{{ route('campaign.index') }}">Campaign Offer</a>
                </div>
            </li>
            @endif
            @if(Auth::user()->report==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-form-product-1.html"> <i class="icon material-icons md-pie_chart"></i>
                    <span class="text">Report</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('report.order.index') }}">Order report</a>
                    <a href="{{ route('product.review.report.index') }}">Product review report</a>
                    <a href="{{ route('web.review.report.index') }}">Web review report</a>
                </div>
            </li>
            @endif
            @if(Auth::user()->add_product==1)
            <li class="menu-item">
                <a class="menu-link" href="{{ route('product.create') }}"> <i class="icon material-icons md-add_box"></i>
                    <span class="text">Add product</span> </a>
            </li>
            @endif
            @if(Auth::user()->product_list==1)
            <li class="menu-item">
                <a class="menu-link" href="{{ route('product.index') }}"> <i class="icon material-icons md-shopping_bag"></i>
                    <span class="text">Product List</span> </a>
            </li>
            @endif
            @if(Auth::user()->brands==1)
            <li class="menu-item">
                <a class="menu-link" href="{{ route('brand.index') }}"> <i class="icon material-icons md-stars"></i>
                    <span class="text">Brands</span> </a>
            </li>
            @endif
            @if(Auth::user()->developer_team==1)
            <li class="menu-item">
                <a class="menu-link" href="{{ route('developer.team.index') }}"> <i class="icon fa fa-users" style="font-size: 1.5em;"></i>
                    <span class="text">Developer Team</span> </a>
            </li>
            @endif
            @if(Auth::user()->order==1)
            <li class="menu-item">
                <a class="menu-link" href="{{ route('admin.order.index') }}"> <i class="icon material-icons md-shopping_cart"></i>
                    <span class="text">Orders</span> </a>
            </li>
            @endif
            @if(Auth::user()->pickup==1)
            <li class="menu-item">
                <a class="menu-link" href="{{ route('pickuppoint.index') }}"> <i class="icon fa fa-cube" style="font-size: 1.5em;"></i>
                    <span class="text">Pickup Point</span> </a>
            </li>
            @endif
            @if(Auth::user()->warehouse==1)
            <li class="menu-item">
                <a class="menu-link menu-link-with-icon" href="{{ route('warehouse.index') }}">
                    <i class="icon fa fa-archive" aria-hidden="true" style="font-size: 1.5em;"></i>
                    <span class="text">Warehouse</span>
                </a>
            </li>
            @endif

        </ul>
        <hr>
        <ul class="menu-aside">
            @if(Auth::user()->setting==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-settings"></i>
                    <span class="text">Settings</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('seo.setting') }}">SEO Setting</a>
                    <a href="{{ route('website.setting') }}">Website Setting</a>
                    <a href="{{ route('page.index') }}">Page Create</a>
                    <a href="{{ route('smtp.setting') }}">SMTP Setting</a>
                    <a href="{{ route('payment.gateway') }}">Payment Gateway</a>
                </div>
            </li>
            @endif
            @if(Auth::user()->userrole==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="page-form-product-1.html"> <i class="icon fa fa-user-plus" style="font-size: 1.5em;"></i>
                    <span class="text">Assign User Role</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('create.role') }}">Create New Role</a>
                    <a href="{{ route('manage.role') }}">Manage Role</a>
                </div>
            </li>
            @endif
            @if(Auth::user()->account==1)
            <li class="menu-item has-submenu">
                <a class="menu-link" href="#"> <i class="icon material-icons md-person"></i>
                    <span class="text">Account</span>
                </a>
                <div class="submenu">
                    <a href="{{ route('profile.setting') }}">Profile</a>

                </div>
            </li>
            @endif

        </ul>
        <br>
        <br>
    </nav>
</aside>