<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;
use Image;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BrandController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data=DB::table('brands')->get();
    		return DataTables::of($data)
    				->addIndexColumn()
                    ->editColumn('front_page',function($row){
                        if ($row->front_page==1) {
                            return ' <td><span  class="badge rounded-pill alert-success">Active</span></td>';
                        }
						else{
							return ' <td><span  class="badge rounded-pill alert-danger">Diactive</span></td>';
						}
                    })
    				->addColumn('action', function($row){
    					$actionbtn='<a href="#" class="btn btn-sm font-sm rounded btn-brand  hover-up edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                      	<a href="'.route('brand.delete',[$row->id]).'" class="btn btn-sm font-sm btn-danger rounded hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;">
                      	</a>';
                       return $actionbtn;
    				})
    				->rawColumns(['action','front_page'])
    				->make(true);
    	}

    	return view('admin.category.brand.index');
    }

    //store method
    public function store(Request $request)
    {
    	$validated = $request->validate([
           'brand_name' => 'required|unique:brands|max:55',
        ]);

    	$slug=Str::slug($request->brand_name, '-');

    	$data=array();
    	$data['brand_name']=$request->brand_name;
    	$data['brand_slug']=Str::slug($request->brand_name, '-');
        $data['front_page']=$request->front_page;
    	if($request->brand_logo){
			$manager = new ImageManager(new Driver());
			$photoname = hexdec(uniqid()).'.'.$request->brand_logo->getClientOriginalExtension();
			$img = $manager->read($request->brand_logo);
			$img = $img->resize(200,60);
			$img->save('files/brand/'.$photoname);
			$data['brand_logo']='files/brand/'.$photoname;   // files/brand/plus-point.jpg
    		DB::table('brands')->insert($data);
		} 
		
    	$notification=array('messege' => 'Brand Inserted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
    	$data=DB::table('brands')->where('id',$id)->first();
    	$image=$data->brand_logo;

    	if (File::exists($image)) {
    		 unlink($image);
    	}
    	DB::table('brands')->where('id',$id)->delete();
    	$notification=array('messege' => 'Brand Deleted!', 'alert-type' => 'success');
    	return redirect()->back()->with($notification);

    }

    public function edit($id)
    {
    	$data=DB::table('brands')->where('id',$id)->first();
    	return view('admin.category.brand.edit',compact('data'));
    }

    public function update(Request $request)
    {
    	$slug=Str::slug($request->brand_name, '-');
    	$data=array();
    	$data['brand_name']=$request->brand_name;
    	$data['brand_slug']=Str::slug($request->brand_name, '-');
        $data['front_page']=$request->front_page;
    	if ($request->brand_logo) {
    		if (File::exists($request->old_logo)) {
    		    unlink($request->old_logo);
    	    }
			if($request->brand_logo){
				$manager = new ImageManager(new Driver());
				$photoname = hexdec(uniqid()).'.'.$request->brand_logo->getClientOriginalExtension();
				$img = $manager->read($request->brand_logo);
				$img = $img->resize(200,60);
				$img->save('files/brand/'.$photoname);
				$data['brand_logo']='files/brand/'.$photoname;   // public/files/brand/plus-point.jpg
				DB::table('brands')->where('id',$request->id)->update($data);
	
			} 
    	    $notification=array('messege' => 'Brand Update!', 'alert-type' => 'success');
    	    return redirect()->back()->with($notification);
    	}else{
		  $data['brand_logo']=$request->old_logo;
	      DB::table('brands')->where('id',$request->id)->update($data);
	      $notification=array('messege' => 'Brand Update!', 'alert-type' => 'success');
	      return redirect()->back()->with($notification);
    	}
    }
}
