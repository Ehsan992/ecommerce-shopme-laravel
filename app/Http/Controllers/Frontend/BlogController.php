<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use File;
use Image;
use App\Models\Blogs;
use Illuminate\Support\Str;
use App\Models\Blog_category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    //all page show method
    public function index()
    {
        $setting = DB::table('settings')->first();
        $category = DB::table('categories')->orderBy('category_name', 'ASC')->get();
        $blog = DB::table('blogs')
            ->join('blog_category', 'blogs.blog_category_id', '=', 'blog_category.id')
            ->select('blogs.*', 'blog_category.category_name')
            ->latest()
            ->paginate(6);  // Call paginate here before get
        $categories = DB::table('blog_category')->get();
        return view('frontend.blogs.index', compact('blog', 'setting', 'category', 'categories'));
    }
    
    //singleproduct page calling method
    public function singleBlogPage($id)
    {
        $setting=DB::table('settings')->first();
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();
        $blog=Blogs::where('id',$id)->first();
        $categories=DB::table('blog_category')->get();
        $latestblog=DB::table('blogs')->latest()->get();
        return view('frontend.blogs.single_page_block',compact('setting','category','blog','categories','latestblog'));
    }
    public function categoryIndex($id)
    {
        $setting = DB::table('settings')->first();
        $category = DB::table('categories')->orderBy('category_name', 'ASC')->get();
        $blog = DB::table('blogs')
            ->join('blog_category', 'blogs.blog_category_id', '=', 'blog_category.id')
            ->select('blogs.*', 'blog_category.category_name')
            ->where('blog_category_id',$id)
            ->latest()
            ->paginate(6);  // Call paginate here before get
        $categories = DB::table('blog_category')->get();
        return view('frontend.blogs.category_blog', compact('blog', 'setting', 'category', 'categories'));
    }
}
