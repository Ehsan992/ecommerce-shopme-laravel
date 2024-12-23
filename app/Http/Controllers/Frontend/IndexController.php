<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\View;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function login()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        return view('frontend.profile.login',compact('category'));
    }
    public function register()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        return view('frontend.profile.register',compact('category'));
    }
    public function aboutUs()
    {
        $review = DB::table('wbreviews')
                    ->join('users', 'wbreviews.user_id', '=', 'users.id')
                    ->select('wbreviews.*', 'users.user_photo')
                    ->get();     
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $team=DB::table('developer_team')->limit(4)->get();
        return view('frontend.about-us',compact('category','team','review'));
    }
    public function index()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $brand=DB::table('brands')->where('front_page',1)->limit(24)->get();
        $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(8)->get();
        $featured=Product::where('status',1)->where('featured',1)->orderBy('id','ASC')->limit(8)->get();
        $todaydeal=Product::where('status',1)->where('today_deal',1)->orderBy('id','DESC')->limit(6)->get();
        $popular_product=Product::where('status',1)->orderBy('product_views','DESC')->limit(8)->get();
        $trendy_product=Product::where('status',1)->where('trendy',1)->orderBy('id','DESC')->limit(8)->get();
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $review = DB::table('wbreviews')
                    ->join('users', 'wbreviews.user_id', '=', 'users.id')
                    ->select('wbreviews.*', 'users.user_photo')
                    ->get();        
        $blog = DB::table('blogs')
                    ->join('blog_category', 'blogs.blog_category_id', '=', 'blog_category.id')
                    ->select('blogs.*', 'blog_category.category_name')
                    ->orderBy('publish_date','ASC')
                    ->limit(4)
                    ->get();                    
        $home_category=DB::table('categories')->where('home_page',1)->orderBy('category_name','ASC')->get();
        $content=Cart::content();
        $setting=DB::table('settings')->first();
        $campaign=DB::table('campaigns')->where('status',1)->limit(3)->get();

        return view('frontend.index',compact('category','new_added','featured','popular_product','trendy_product','home_category','brand','random_product','todaydeal','campaign','review','content','setting','blog'));
    }

    //store newsletter
    public function storeNewsletter(Request $request)
    {
        $email=$request->email;
        $check=DB::table('newsletters')->where('email',$email)->first();
        if ($check) {
            return response()->json('Email Already Exist!');
        }else{
              $data=array();
              $data['email']=$request->email;
              DB::table('newsletters')->insert($data);
              toastr()->success('Thanks for subscribe us!');
              return back();
        } 
    }

    //singleproduct page calling method
    public function ProductDetails($id)
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $categories=DB::table('categories')->get();
        $product=Product::where('id',$id)->first();
        Product::where('id',$id)->increment('product_views');
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)
                    ->join('users', 'reviews.user_id', '=', 'users.id')
                    ->select('reviews.*', 'users.user_photo')
                    ->get();
        $totalReviews = $review->count();  // Get the total number of reviews
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(4)->get();
        $brand=DB::table('brands')->get();
        $content=Cart::content();
        $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(8)->get();
        $campaign=DB::table('campaigns')->where('status',1)->limit(1)->get();
        $setting=DB::table('settings')->first();
        return view('frontend.product.single_page_product',compact('product','setting','related_product','review','brand','content','totalReviews','categories','new_added','campaign','category'));
    }

     //categorywise product page
     public function categoryWiseProduct($id, Request $request)
     {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $category2=DB::table('categories')->where('id',$id)->first();
        $subcategory=DB::table('subcategories')->where('category_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('category_id',$id)->paginate(12);
        $random_product=Product::where('status',1)->inRandomOrder()->limit(16)->get();
        $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(3)->get();
        $content=Cart::content();
        $setting=DB::table('settings')->first();


        
        $limit = $request->get('limit', 12); // Default to 12 if no limit is set
        $sort = $request->get('sort', 'featured'); // Default to 'featured' if no sort is set
        $priceFilter = $request->get('price-filter');
        $query = DB::table('products')->where('category_id', $id);
    
        // Handling price filter
        if ($priceFilter) {
            $priceRange = explode('-', $priceFilter);
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
        }
    
        // Handling sorting logic
        if ($sort == 'price-asc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'asc');
        } elseif ($sort == 'price-desc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'desc');
        } elseif ($sort == 'date') {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($limit == 'all') {
            $products = $query->get();
        } else {
            $products = $query->paginate($limit);
        }


        return view('frontend.product.category_products',compact('subcategory','new_added','category','brand','products','category2','content','setting'));
     }
 
     //subcategorywise product
     public function SubcategoryWiseProduct($id, Request $request)
     {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $parent_category = DB::table('subcategories')
        ->join('categories', 'subcategories.category_id', '=', 'categories.id')
        ->where('subcategories.id', $id)
        ->select('subcategories.*', 'categories.category_name as parent_category_name', 'categories.id as parent_category_id')
        ->first();

        $subcategory=DB::table('subcategories')->where('id',$id)->first();
        $childcategories=DB::table('childcategories')->where('subcategory_id',$id)->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('subcategory_id',$id)->paginate(12);
        $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(3)->get();
        $content=Cart::content();
        $setting=DB::table('settings')->first();


        
        $limit = $request->get('limit', 12); // Default to 12 if no limit is set
        $sort = $request->get('sort', 'featured'); // Default to 'featured' if no sort is set
        $priceFilter = $request->get('price-filter');
        $query = DB::table('products')->where('category_id', $id);
    
        // Handling price filter
        if ($priceFilter) {
            $priceRange = explode('-', $priceFilter);
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
        }
    
        // Handling sorting logic
        if ($sort == 'price-asc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'asc');
        } elseif ($sort == 'price-desc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'desc');
        } elseif ($sort == 'date') {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($limit == 'all') {
            $products = $query->get();
        } else {
            $products = $query->paginate($limit);
        }
        return view('frontend.product.subcategory_product',compact('childcategories','parent_category','new_added','category','brand','products','subcategory','content','setting'));
     }
 
     //childcategory product
     public function ChildcategoryWiseProduct($id, Request $request)
     {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $parent_category = DB::table('childcategories')
        ->join('categories', 'childcategories.category_id', '=', 'categories.id')
        ->where('childcategories.id', $id)
        ->select('childcategories.*', 'categories.category_name as parent_category_name', 'categories.id as parent_category_id')
        ->first();
        $parent_category2 = DB::table('childcategories')
        ->join('subcategories', 'childcategories.subcategory_id', '=', 'subcategories.id')
        ->where('childcategories.id', $id)
        ->select('childcategories.*', 'subcategories.subcategory_name as parent_subcategory_name', 'subcategories.id as parent_subcategory_id')
        ->first();
        $childcategory=DB::table('childcategories')->where('id',$id)->first();
        $categories=DB::table('categories')->get();
        $brand=DB::table('brands')->get();
        $products=DB::table('products')->where('childcategory_id',$id)->paginate(12);
        $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(3)->get();
        $content=Cart::content();
        $setting=DB::table('settings')->first();

        
        $limit = $request->get('limit', 12); // Default to 12 if no limit is set
        $sort = $request->get('sort', 'featured'); // Default to 'featured' if no sort is set
        $priceFilter = $request->get('price-filter');
        $query = DB::table('products')->where('category_id', $id);
    
        // Handling price filter
        if ($priceFilter) {
            $priceRange = explode('-', $priceFilter);
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
        }
    
        // Handling sorting logic
        if ($sort == 'price-asc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'asc');
        } elseif ($sort == 'price-desc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'desc');
        } elseif ($sort == 'date') {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($limit == 'all') {
            $products = $query->get();
        } else {
            $products = $query->paginate($limit);
        }
        return view('frontend.product.childcategory_product',compact('categories','parent_category','parent_category2','new_added','category','brand','products','childcategory','content','setting'));
    }

    //brandwise product
    public function BrandWiseProduct($id, Request $request)
    {
        $category = DB::table('categories')->orderBy('category_name', 'ASC')->get();
        $brand = DB::table('brands')->where('id', $id)->first();
        $allbrand = DB::table('brands')->where('front_page', 1)->limit(24)->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $random_product = Product::where('status', 1)->inRandomOrder()->limit(16)->get();
        $content = Cart::content();
        $setting = DB::table('settings')->first();
        $new_added = Product::where('status', 1)->where('new_added', 1)->orderBy('id', 'DESC')->limit(3)->get();
    
        $limit = $request->get('limit', 12); // Default to 12 if no limit is set
        $sort = $request->get('sort', 'featured'); // Default to 'featured' if no sort is set
        $priceFilter = $request->get('price-filter');
        $query = DB::table('products')->where('brand_id', $id);
    
        // Handling price filter
        if ($priceFilter) {
            $priceRange = explode('-', $priceFilter);
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
        }
    
        // Handling sorting logic
        if ($sort == 'price-asc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'asc');
        } elseif ($sort == 'price-desc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'desc');
        } elseif ($sort == 'date') {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($limit == 'all') {
            $products = $query->get();
        } else {
            $products = $query->paginate($limit);
        }
    
        
        return view('frontend.product.brandwise_product', compact('categories', 'new_added', 'category', 'allbrand', 'brands', 'products', 'random_product', 'brand', 'content', 'setting'));
    }

    //product quick view
    public function ProductQuickView($id)
    {
        $product = Product::where('id', $id)->first();
        $setting=DB::table('settings')->first();
        return view('frontend.product.quick_view', compact('product','setting'));
    }
    //__campaign products__//
    public function CampaignProduct($id, Request $request)
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $products=DB::table('campaign_product')->leftJoin('products','campaign_product.product_id','products.id')
                    ->select('products.name','products.code','products.thumbnail','products.slug','campaign_product.*')
                    ->where('campaign_product.campaign_id',$id)
                    ->paginate(12);        
        $content=Cart::content();
        $setting=DB::table('settings')->first();
        
        $limit = $request->get('limit', 12); // Default to 12 if no limit is set
        $sort = $request->get('sort', 'featured'); // Default to 'featured' if no sort is set
        $priceFilter = $request->get('price-filter');
        $query = DB::table('campaign_product')
                ->leftJoin('products', 'campaign_product.product_id', '=', 'products.id')
                ->select('products.name', 'products.code', 'products.thumbnail', 'products.slug', 'campaign_product.*')
                ->where('campaign_product.campaign_id', $id);    
        // Handling price filter
        if ($priceFilter) {
            $priceRange = explode('-', $priceFilter);
            $minPrice = (int)$priceRange[0];
            $maxPrice = (int)$priceRange[1];
            $query->whereBetween('selling_price', [$minPrice, $maxPrice]);
        }
    
        // Handling sorting logic
        if ($sort == 'price-asc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'asc');
        } elseif ($sort == 'price-desc') {
            $query->orderBy(DB::raw('IFNULL(discount_price, selling_price)'), 'desc');
        } elseif ($sort == 'date') {
            $query->orderBy('created_at', 'desc');
        }
    
        if ($limit == 'all') {
            $products = $query->get();
        } else {
            $products = $query->paginate($limit);
        }
    
        return view('frontend.campaign.product_list',compact('products','content','category','setting'));
    }

    //__campaign product details__//
    public function CampaignProductDetails($slug)
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $categories=DB::table('categories')->get();
        $product=Product::where('slug',$slug)->first();
                 Product::where('slug',$slug)->increment('product_views');
        $product_price=DB::table('campaign_product')->where('product_id',$product->id)->first();      
        $related_product=DB::table('products')->where('subcategory_id',$product->subcategory_id)->orderBy('id','DESC')->take(4)->get();
        $review=Review::where('product_id',$product->id)->orderBy('id','DESC')->take(6)->get();
        $setting=DB::table('settings')->first();
        $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.campaign.product_details',compact('product','related_product','review','product_price','category','setting','categories','new_added'));
    }
    //page view method
    public function ViewPage($page_slug)
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $categories = DB::table('blog_category')->get();
        $page=DB::table('pages')->where('page_slug',$page_slug)->first();
        $latestblog=DB::table('blogs')->latest()->get();
        return view('frontend.page',compact('page','category','categories','latestblog'));
    }

    //constact page
    public function Contact()
    {
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $content=Cart::content();

        return view('frontend.contact',compact('category','content'));
    }

    public function submitContactForm(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
    
        // Send email
        Mail::to('admin@example.com')->send(new ContactMail($data));
    
        // Redirect back with success message
        toastr()->success('Your message has been sent successfully!');
        return redirect()->back();
    }
}