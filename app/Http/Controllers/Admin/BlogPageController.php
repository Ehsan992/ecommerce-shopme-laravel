<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use Illuminate\Support\Str;
use App\Models\Blogs;
use App\Models\Blog_category;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all page show method
    public function index()
    {
        $page = DB::table('blogs')
        ->join('blog_category', 'blogs.blog_category_id', '=', 'blog_category.id')
        ->select('blogs.*', 'blog_category.category_name')
        ->latest()
        ->get();        
        return view('admin.blog.page.index',compact('page'));
    }

    //page create form
    public function create()
    {
        $page=DB::table('blogs')->latest()->get();

        $category=DB::table('blog_category')->get();          // Brand::all();

        return view('admin.blog.page.create',compact('page','category'));
    }

    //page store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required',
            'blog_title' => 'required',
            'blog_description' => 'required',
        ]);
        $slug=Str::slug($request->blog_title, '-');


        $data=array();
        $data['blog_category_id']=$request->category;
        $data['title']=$request->blog_title;
        $data['slug']=Str::slug($request->blog_title, '-');
        $data['tag']=$request->tags;
        $data['publish_date']=date('d-m-Y');
        $data['description'] = $request->blog_description;
        $data['status']=$request->status;

        if ($request->thumbnail) {
            $manager = new ImageManager(new Driver());
            $photoname=$slug.'.'.$request->thumbnail->getClientOriginalExtension();
            $img = $manager->read($request->thumbnail);
            $img = $img->cover(3445,2296,'top');
            $img->save('files/blog/'.$photoname);
            $data['thumbnail']='files/blog/'.$photoname; 
        }
        DB::table('blogs')->insert($data);
        toastr()->success('Blog Page Created!');
        return redirect()->back();
    }

    //page delete
    public function destroy($id)
    {
        DB::table('blogs')->where('id',$id)->delete();
        toastr()->success('Blog Page Deleted!');
        return redirect()->back();
    }

    //page edit
    public function edit($id)
    {
        $category=DB::table('blog_category')->get(); 
        $blog=DB::table('blogs')->where('id',$id)->first();
        return view('admin.blog.page.edit',compact('blog','category'));
    }


    //page update
    public function update(Request $request,$id)
    {
        $slug=Str::slug($request->blog_title, '-');
        $data=array();
        $data['blog_category_id']=$request->category;
        $data['title']=$request->blog_title;
        $data['slug']=Str::slug($request->blog_title, '-');
        $data['tag']=$request->tags;
        $data['publish_date']=date('d-m-Y');
        $data['description'] = $request->blog_description;
        $data['status']=$request->status;

        if ($request->thumbnail) {
            $manager = new ImageManager(new Driver());
            $photoname=$slug.'.'.$request->thumbnail->getClientOriginalExtension();
            $img = $manager->read($request->thumbnail);
            $img = $img->cover(3445,2296,'top');
            $img->save('files/blog/'.$photoname);
            $data['thumbnail']='files/blog/'.$photoname; 
        }
        DB::table('blogs')->where('id',$id)->update($data);
        toastr()->success('Blog Page Updated!');
        return redirect()->route('blog.page.index');
    }
}
