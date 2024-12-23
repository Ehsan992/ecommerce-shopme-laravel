<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Auth;
use Cart;
use DB;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::user()->is_admin == 1){
            $user = Auth::user(); // Retrieve authenticated user details
            $category=DB::table('categories')->orderBy('category_name','ASC')->get();
            $brand=DB::table('brands')->where('front_page',1)->limit(24)->get();
            $new_added=Product::where('status',1)->where('new_added',1)->orderBy('id','DESC')->limit(8)->get();
            $featured=Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(8)->get();
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
        elseif(Auth::user()->is_admin == 1){
            return view('admin.index');

        }
        
        
        else {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        toastr()->success('You have successfully logged out!');
        return redirect()->back();
    }
}
