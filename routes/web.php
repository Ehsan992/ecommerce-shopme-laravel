<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\CsvController;


//Admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\PickupController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\BlogPageController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\DeveloperTeamController;
use App\Http\Controllers\Admin\DataController;



// use App\Http\Middleware\BlockGeolocation;


Route::middleware(['log.payload'])->group(function () {
Route::middleware('blockGeolocation')->group(function () {
Route::middleware('inspectUserAgent')->group(function () {
Route::middleware('blockIP')->group(function () {
Route::middleware('customThrottle')->group(function () {
Auth::routes();

// Frontend routes
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/register', [IndexController::class, 'register'])->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register')->name('register');
Route::get('/customer/logout', [HomeController::class, 'logout'])->name('customer.logout');


Route::post('/save-csv', [DataController::class, 'saveCsv']);


Route::get('/home', [HomeController::class, 'index'])->name('home');

//Blog
Route::get('/blog', [BlogController::class, 'index'])->name('front.blog');
Route::get('/single/blog/page/{id}', [BlogController::class, 'singleBlogPage'])->name('single.blog.page');
Route::get('/category/blog/{id}', [BlogController::class, 'categoryIndex'])->name('category.blog');

Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('about.us');
Route::post('/save-csv-data', [CsvController::class, 'saveCsvData']);




Route::group(['namespace' => 'App\Http\Controllers\Front'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('shopme');
    Route::get('/product-details/{id}', [IndexController::class, 'ProductDetails'])->name('product.details');
    Route::get('/product-quick-view/{id}', [IndexController::class, 'ProductQuickView']);
	
    // Cart
    Route::get('/all-cart', [CartController::class, 'AllCart'])->name('all.cart');
    Route::get('/my-cart', [CartController::class, 'MyCart'])->name('cart');
    Route::get('/cart/empty', [CartController::class, 'EmptyCart'])->name('cart.empty');
    Route::get('/checkout', [CheckoutController::class, 'Checkout'])->name('checkout');
    Route::post('/apply/coupon', [CartController::class, 'ApplyCoupon'])->name('apply.coupon');
    Route::get('/remove/coupon', [CartController::class, 'RemoveCoupon'])->name('coupon.remove');
    Route::post('/clearCart', [CartController::class, 'clearCart'])->name('clear.cart');
    Route::post('/order/place', [CheckoutController::class, 'OrderPlace'])->name('order.place');
    Route::post('/addtocart', [CartController::class, 'AddToCartQV'])->name('add.to.cart.quickview');
    Route::post('/updateCart', [CartController::class, 'updateCart'])->name('update.cart');
    Route::delete('/removeProduct/{rowId}', [CartController::class, 'removeProduct']);

    Route::get('/cartproduct/updateqty/{rowId}/{qty}', [CartController::class, 'UpdateQty']);
    Route::get('/cartproduct/updatecolor/{rowId}/{color}', [CartController::class, 'UpdateColor']);
    Route::get('/cartproduct/updatesize/{rowId}/{size}', [CartController::class, 'UpdateSize']);

    // Wishlist
    Route::get('/wishlist', [CartController::class, 'wishlist'])->name('wishlist');
    Route::get('/clear/wishlist', [CartController::class, 'Clearwishlist'])->name('clear.wishlist');
    Route::get('/add/wishlist/{id}', [CartController::class, 'AddWishlist'])->name('add.wishlist');
    Route::delete('/wishlist/product/delete/{id}', [CartController::class, 'WishlistProductdelete'])->name('wishlistproduct.delete.ajax');
    Route::post('/wishlist/add/{id}', [CartController::class, 'AddWishlist'])->name('add.wishlist');

    // Category-wise product
    Route::get('/category/product/{id}', [IndexController::class, 'categoryWiseProduct'])->name('categorywise.product');
    Route::get('/subcategory/product/{id}', [IndexController::class, 'SubcategoryWiseProduct'])->name('subcategorywise.product');
    Route::get('/childcategory/product/{id}', [IndexController::class, 'ChildcategoryWiseProduct'])->name('childcategorywise.product');
    Route::get('/brandwise/product/{id}', [IndexController::class, 'BrandWiseProduct'])->name('brandwise.product');

    // Profile setting
    Route::get('/user/dashboard', [ProfileController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/home/setting', [ProfileController::class, 'setting'])->name('customer.setting');
    Route::post('/home/password/update', [ProfileController::class, 'PasswordChange'])->name('customer.password.change');
    Route::get('/my/order', [ProfileController::class, 'MyOrder'])->name('my.order');
    Route::get('/view/order/{id}', [ProfileController::class, 'ViewOrder'])->name('view.order');
    // Review
    Route::post('/store/review', [ReviewController::class, 'store'])->name('store.review');
    Route::get('/write/review', [ReviewController::class, 'write'])->name('write.review');
    Route::post('/store/website/review', [ReviewController::class, 'StoreWebsiteReview'])->name('store.website.review');

   //page view
    Route::get('/page/{page_slug}', [IndexController::class, 'ViewPage'])->name('view.page');
    
    //newsletter
    Route::post('/store/newsletter', [IndexController::class, 'storeNewsletter'])->name('store.newsletter');
    
    //support ticket
    Route::get('/open/ticket', [ProfileController::class, 'ticket'])->name('open.ticket');
    Route::get('/new/ticket', [ProfileController::class, 'NewTicket'])->name('new.ticket');
    Route::post('/store/ticket', [ProfileController::class, 'StoreTicket'])->name('store.ticket');
    Route::get('/show/ticket/{id}', [ProfileController::class, 'ticketShow'])->name('show.ticket');
    Route::post('/reply/ticket', [ProfileController::class, 'ReplyTicket'])->name('reply.ticket');

    //order tracking
    Route::get('/order/tracking', [IndexController::class, 'OrderTracking'])->name('order.tracking');
    Route::post('/check/order', [IndexController::class, 'CheckOrder'])->name('check.order');
    
    //__payment gateway
    Route::post('/success', [CheckoutController::class, 'success'])->name('success');
    Route::post('/fail', [CheckoutController::class, 'fail'])->name('fail');
    Route::post('/cancel', [CheckoutController::class, 'fail'])->name('cancel');
    
    //__search
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/ajax', [SearchController::class, 'searchAjax'])->name('search.ajax');
    
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update.profile');

    Route::get('/our-blog', [IndexController::class, 'Blog'])->name('blog');
    
    //__campaign__//
    Route::get('/campain/products/{id}', [IndexController::class, 'CampaignProduct'])->name('frontend.campaign.product');
    Route::get('/camapign-product-details/{slug}', [IndexController::class, 'CampaignProductDetails'])->name('campaign.product.details');
});


Route::get('/contact-us', [IndexController::class, 'Contact'])->name('contact');
Route::post('/contact/submit', [IndexController::class, 'submitContactForm'])->name('contactme.submite');


// Admin Route

Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => 'is_admin'], function () {
    Route::get('/admin/logout', [HomeController::class, 'logout'])->name('admin.logout');

	// Category routes
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/update', [CategoryController::class, 'update'])->name('category.update');
    });

	// Global route
	Route::get('/get-child-category/{id}', [CategoryController::class, 'GetChildCategory'])->name('get-child-category');

	// Subcategory routes
	Route::prefix('subcategory')->group(function () {
		Route::get('/', [SubcategoryController::class, 'index'])->name('subcategory.index');
		Route::post('/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
		Route::get('/delete/{id}', [SubcategoryController::class, 'destroy'])->name('subcategory.delete');
		Route::get('/edit/{id}', [SubcategoryController::class, 'edit']);
		Route::post('/update', [SubcategoryController::class, 'update'])->name('subcategory.update');
	});

	// Warehouse routes
	Route::prefix('warehouse')->group(function () {
		Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
		Route::post('/store', [WarehouseController::class, 'store'])->name('warehouse.store');
		Route::get('/delete/{id}', [WarehouseController::class, 'destroy'])->name('warehouse.delete');
		Route::get('/edit/{id}', [WarehouseController::class, 'edit']);
		Route::post('/update', [WarehouseController::class, 'update'])->name('warehouse.update');
	});

	// Childcategory routes
	Route::prefix('childcategory')->group(function () {
		Route::get('/', [ChildcategoryController::class, 'index'])->name('childcategory.index');
		Route::post('/store', [ChildcategoryController::class, 'store'])->name('childcategory.store');
		Route::get('/delete/{id}', [ChildcategoryController::class, 'destroy'])->name('childcategory.delete');
		Route::get('/edit/{id}', [ChildcategoryController::class, 'edit']);
		Route::post('/update', [ChildcategoryController::class, 'update'])->name('childcategory.update');
	});

	// Brand routes
	Route::prefix('brand')->group(function () {
		Route::get('/', [BrandController::class, 'index'])->name('brand.index');
		Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
		Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
		Route::get('/edit/{id}', [BrandController::class, 'edit']);
		Route::post('/update', [BrandController::class, 'update'])->name('brand.update');
	});

	// Developer Team routes
	Route::prefix('developer-team')->group(function () {
		Route::get('/', [DeveloperTeamController::class, 'index'])->name('developer.team.index');
		Route::post('/store', [DeveloperTeamController::class, 'store'])->name('developer.team.store');
		Route::get('/delete/{id}', [DeveloperTeamController::class, 'destroy'])->name('developer.team.delete');
		Route::get('/edit/{id}', [DeveloperTeamController::class, 'edit']);
		Route::post('/update', [DeveloperTeamController::class, 'update'])->name('developer.team.update');
	});

	// Product routes
	Route::prefix('product')->group(function () {
		Route::get('/', [ProductController::class, 'index'])->name('product.index');
		Route::get('/create', [ProductController::class, 'create'])->name('product.create');
		Route::post('/store', [ProductController::class, 'store'])->name('product.store');
		Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
		Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
		Route::post('/update', [ProductController::class, 'update'])->name('product.update');
		Route::get('/active-featured/{id}', [ProductController::class, 'activefeatured']);
		Route::get('/not-featured/{id}', [ProductController::class, 'notfeatured']);
		Route::get('/active-deal/{id}', [ProductController::class, 'activedeal']);
		Route::get('/not-deal/{id}', [ProductController::class, 'notdeal']);
		Route::get('/active-status/{id}', [ProductController::class, 'activestatus']);
		Route::get('/not-status/{id}', [ProductController::class, 'notstatus']);
		Route::get('/active-new-added/{id}', [ProductController::class, 'active_new_added']);
		Route::get('/not-new-added/{id}', [ProductController::class, 'not_new_added']);
		Route::get('/product-show/{id}', [ProductController::class, 'ProductShow']);
	});
	// Coupon routes
	Route::prefix('coupon')->group(function () {
		Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
		Route::post('/store', [CouponController::class, 'store'])->name('store.coupon');
		Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('coupon.delete');
		Route::get('/edit/{id}', [CouponController::class, 'edit']);
		Route::post('/update', [CouponController::class, 'update'])->name('update.coupon');
	});

	// Campaign routes
	Route::prefix('campaign')->group(function () {
		Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
		Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
		Route::get('/delete/{id}', [CampaignController::class, 'destroy'])->name('campaign.delete');
		Route::get('/edit/{id}', [CampaignController::class, 'edit']);
		Route::post('/update', [CampaignController::class, 'update'])->name('campaign.update');
	});
	

	// Campaign product routes
	Route::prefix('campaign-product')->group(function () {
		Route::get('/{campaign_id}', [CampaignController::class, 'campaignProduct'])->name('campaign.product');
		Route::get('/add/{id}/{campaign_id}', [CampaignController::class, 'ProductAddToCampaign'])->name('add.product.to.campaign');
		Route::get('/list/{campaign_id}', [CampaignController::class, 'ProductListCampaign'])->name('campaign.product.list');
		Route::get('/remove/{id}', [CampaignController::class, 'RemoveProduct'])->name('product.remove.campaign');
	});

	// Order routes
	Route::prefix('order')->group(function () {
		Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
		Route::get('/admin/edit/{id}', [OrderController::class, 'Editorder']);
		Route::post('/update/order/status', [OrderController::class, 'updateStatus'])->name('update.order.status');
		Route::get('/view/admin/{id}', [OrderController::class, 'ViewOrder']);
		Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
	});

	// Setting Routes
	Route::prefix('setting')->group(function () {
		// SEO Setting
		Route::prefix('seo')->group(function () {
			Route::get('/', [SettingController::class, 'seo'])->name('seo.setting');
			Route::post('/update/{id}', [SettingController::class, 'seoUpdate'])->name('seo.setting.update');
		});

		// SMTP Setting
		Route::prefix('smtp')->group(function () {
			Route::get('/', [SettingController::class, 'smtp'])->name('smtp.setting');
			Route::post('update/', [SettingController::class, 'smtpUpdate'])->name('smtp.setting.update');
		});

		// PROFILE Setting
		Route::prefix('profile')->group(function () {
			Route::get('/', [SettingController::class, 'profile'])->name('profile.setting');
			Route::post('/password/update', [SettingController::class, 'passwordUpdate'])->name('password.setting.update');
			Route::post('/profile/update', [SettingController::class, 'profileUpdate'])->name('profile.setting.update');
		});

		// Website Setting
		Route::prefix('website')->group(function () {
			Route::get('/', [SettingController::class, 'website'])->name('website.setting');
			Route::post('/update/{id}', [SettingController::class, 'WebsiteUpdate'])->name('website.setting.update');
		});

		// Payment Gateway Setting
		Route::prefix('payment-gateway')->group(function () {
			Route::get('/', [SettingController::class, 'PaymentGateway'])->name('payment.gateway');
			Route::post('/update-aamarpay', [SettingController::class, 'AamarpayUpdate'])->name('update.aamarpay');
		});

		// Page Setting
		Route::prefix('page')->group(function () {
			Route::get('/', [PageController::class, 'index'])->name('page.index');
			Route::get('/create', [PageController::class, 'create'])->name('create.page');
			Route::post('/store', [PageController::class, 'store'])->name('page.store');
			Route::get('/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
			Route::get('/edit/{id}', [PageController::class, 'edit'])->name('page.edit');
			Route::post('/update/{id}', [PageController::class, 'update'])->name('page.update');
		});

		// Pickup Point
		Route::prefix('pickup-point')->group(function () {
			Route::get('/', [PickupController::class, 'index'])->name('pickuppoint.index');
			Route::post('/store', [PickupController::class, 'store'])->name('store.pickup.point');
			Route::delete('/delete/{id}', [PickupController::class, 'destroy'])->name('pickup.point.delete');
			Route::get('/edit/{id}', [PickupController::class, 'edit']);
			Route::post('/update', [PickupController::class, 'update'])->name('update.pickup.point');
		});
		// Ticket
		Route::prefix('ticket')->group(function () {
			Route::get('/', [TicketController::class, 'index'])->name('ticket.index');
			Route::get('/ticket/show/{id}', [TicketController::class, 'show'])->name('admin.ticket.show');
			Route::post('/ticket/reply', [TicketController::class, 'ReplyTicket'])->name('admin.store.reply');
			Route::get('/ticket/close/{id}', [TicketController::class, 'CloseTicket'])->name('admin.close.ticket');
			Route::delete('/ticket/delete/{id}', [TicketController::class, 'destroy'])->name('admin.ticket.delete');
		});

		// Blog Category
		Route::prefix('blog-category')->group(function () {
			Route::get('/', [BlogCategoryController::class, 'index'])->name('admin.blog.category');
			Route::post('/store', [BlogCategoryController::class, 'store'])->name('blog.category.store');
			Route::get('/delete/{id}', [BlogCategoryController::class, 'destroy'])->name('blog.category.delete');
			Route::get('/edit/{id}', [BlogCategoryController::class, 'edit']);
			Route::post('/update', [BlogCategoryController::class, 'update'])->name('blog.category.update');
		});

		// Blog page
		Route::prefix('blog-page')->group(function () {
			Route::get('/', [BlogPageController::class, 'index'])->name('blog.page.index');
			Route::get('/create', [BlogPageController::class, 'create'])->name('blog.create.page');
			Route::post('/store', [BlogPageController::class, 'store'])->name('blog.page.store');
			Route::get('/delete/{id}', [BlogPageController::class, 'destroy'])->name('blog.page.delete');
			Route::get('/edit/{id}', [BlogPageController::class, 'edit'])->name('blog.page.edit');
			Route::post('/update/{id}', [BlogPageController::class, 'update'])->name('blog.page.update');
		});


		// Role
		Route::prefix('role')->group(function () {
			Route::get('/', [RoleController::class, 'index'])->name('manage.role');
			Route::get('/create', [RoleController::class, 'create'])->name('create.role');
			Route::post('/store', [RoleController::class, 'store'])->name('store.role');
			Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
			Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
			Route::post('/update', [RoleController::class, 'update'])->name('update.role');
		});

		// Report
		Route::prefix('report')->group(function () {
			Route::get('/order', [OrderController::class, 'Reportindex'])->name('report.order.index');
			Route::get('/order/print', [OrderController::class, 'ReportOrderPrint'])->name('report.order.print');
			Route::get('/product/review', [OrderController::class, 'ProductReviewReportIndex'])->name('product.review.report.index');
			Route::get('/product/review/print', [OrderController::class, 'ProductReviewReportPrint'])->name('product.review.report.print');
			Route::get('/web/review', [OrderController::class, 'WebReviewReportIndex'])->name('web.review.report.index');
			Route::get('/web/review/print', [OrderController::class, 'WebReviewReportPrint'])->name('web.review.report.print');
		});
	});


});
});
});
});
});
});