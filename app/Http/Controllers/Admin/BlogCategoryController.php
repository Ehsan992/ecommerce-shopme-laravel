<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
use Image;
use File;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all category showing method
    public function index()
    {
        $data=DB::table('blog_category')->get();  //query builder
        return view('admin.blog.category',compact('data'));
    }

    //store category
    public function store(Request $request)
    {
        $validated = $request->validate([
           'category_name' => 'required|max:55',
       ]);
        //query builder
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('blog_category')->insert($data);
        toastr()->success('Category Inserted!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        DB::table('blog_category')->where('id',$id)->delete();
        toastr()->success('Category Deleted!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $data=DB::table('blog_category')->where('id',$id)->first();
        return view('admin.blog.category_edit',compact('data'));
    }

    public function update(Request $request)
    {
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=Str::slug($request->category_name, '-');
        DB::table('blog_category')->where('id',$request->id)->update($data);
        toastr()->success('Category Deleted!');
        return redirect()->back();
    }
}
