<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use Illuminate\Support\Str;
use Image;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all category showing method
    public function index()
    {
    	$data=Category::all();	//eloquent ORM
    	return view('admin.category.category.index',compact('data'));
    	
    }

    //store method
    public function store(Request $request)
    {
    	$validated = $request->validate([
           'category_name' => 'required|unique:categories|max:55',
           'icon' => 'required',
       ]);
          if($request->icon){
            $manager = new ImageManager(new Driver());
            $slug=Str::slug($request->category_name, '-');
            $photoname = $slug.'.'.$request->icon->getClientOriginalExtension();
            $img = $manager->read($request->icon);
            $img = $img->resize(152,142);
            $img->save('files/category/'.$photoname);
          }
          Category::insert([
            'category_name'=> $request->category_name,
            'category_slug'=> $slug,
            'home_page'=> $request->home_page,
            'icon'=> 'files/category/'.$photoname,
          ]);

    	$notification=array('messege' => 'Category Inserted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);
    }

    //edit method
    public function edit($id)
    {
    	$data=Category::findorfail($id);
      return view('admin.category.category.edit',compact('data'));
    }

    //update method
    public function update(Request $request)
    {
        $slug=Str::slug($request->category_name, '-');
        $data=array();
        $data['category_name']=$request->category_name;
        $data['category_slug']=$slug;
        $data['home_page']=$request->home_page;
        if ($request->icon) {
              if (File::exists($request->old_icon)) {
                     unlink($request->old_icon);
                }
              if($request->icon){
                $manager = new ImageManager(new Driver());
                $photoname = $slug.'.'.$request->icon->getClientOriginalExtension();
                $img = $manager->read($request->icon);
                $img = $img->resize(152,142);
                $img->save('files/category/'.$photoname);
                $data['icon']='files/category/'.$photoname;
                DB::table('categories')->where('id',$request->id)->update($data); 
              }
              $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
              return redirect()->back()->with($notification);
              
        }else{
          $data['icon']=$request->old_icon;   
          DB::table('categories')->where('id',$request->id)->update($data); 
          $notification=array('messege' => 'Category Update!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
        }
    }


    //delete category method
    public function destroy($id)
    {
    	$category=Category::find($id);
    	$category->delete();

    	$notification=array('messege' => 'Category Deleted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);
    }

    //get child category
    public function GetChildCategory($id)  //subcategory_id
    {
      $data = DB::table('childcategories')->where('subcategory_id', $id)->get();
      return response()->json($data);
    }



}
