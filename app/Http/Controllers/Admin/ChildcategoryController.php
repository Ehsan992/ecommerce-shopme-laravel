<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data=DB::table('childcategories')->leftJoin('categories','childcategories.category_id','categories.id')->leftJoin('subcategories','childcategories.subcategory_id','subcategories.id')
    		->select('categories.category_name','subcategories.subcategory_name','childcategories.*')->get();

    		return DataTables::of($data)
    				->addIndexColumn()
    				->addColumn('action', function($row){

    					$actionbtn='<a href="#" class="btn btn-sm font-sm rounded btn-brand  hover-up edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                      	<a href="'.route('childcategory.delete',[$row->id]).'" class="btn btn-sm font-sm btn-danger rounded hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> 
                      	</a>';
                       return $actionbtn; 	

    				})
    				->rawColumns(['action'])
    				->make(true);		
    	}

        $category=DB::table('categories')->get();
    	return view('admin.category.childcategory.index',compact('category'));
    }


    public function store(Request $request)
    {
       $cat=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

       $data=array();
       $data['category_id']=$cat->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');
       $data['childcategory_name']=$request->childcategory_name;
       DB::table('childcategories')->insert($data);
       $notification=array('messege' => 'Child-Category Inserted!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        DB::table('childcategories')->where('id',$id)->delete();
        $notification=array('messege' => 'Child-Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    public function edit($id)
    {
        $category=DB::table('categories')->get();
        $data=DB::table('childcategories')->where('id',$id)->first();
        return view('admin.category.childcategory.edit',compact('category','data'));
    }

    public function update(Request $request)
    {
       $cat=DB::table('subcategories')->where('id',$request->subcategory_id)->first();

       $data=array();
       $data['category_id']=$cat->category_id;
       $data['subcategory_id']=$request->subcategory_id;
       $data['childcategory_slug']=Str::slug($request->childcategory_name, '-');
       $data['childcategory_name']=$request->childcategory_name;
       DB::table('childcategories')->where('id',$request->id)->update($data);
       $notification=array('messege' => 'Child-Category Updated!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }
}
