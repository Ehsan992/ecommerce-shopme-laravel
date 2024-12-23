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

class CampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('campaigns')->orderBy('id','DESC')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                     ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<a href="#"><span class="badge rounded-pill alert-success">Active</span> </a>';
                        }else{
                            return '<a href="#"><span class="badge rounded-pill alert-danger">Inactive</span> </a>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="'.route('campaign.product',[$row->id]).'" class="btn btn-sm font-sm btn-success  hover-up"><i class="fa fa-plus-circle" style="font-size: 1.5em;color: white;"></i>
                        </a>
                        <a href="#" class="btn btn-sm font-sm  btn-brand  hover-up edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                        <a href="'.route('campaign.delete',[$row->id]).'" class="btn btn-sm font-sm btn-danger  hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i></a>
                        ';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }

        return view('admin.offer.campaign.index');
    }

    //store campaign
    public function store(Request $request)
    {
        $validated = $request->validate([
           'title' => 'required|unique:campaigns|max:55',
           'start_date' => 'required',
           'image' => 'required',
           'discount' => 'required',
        ]);

        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;
        $data['month']=date('F');
        $data['year']=date('Y');
         //working with image
        if($request->image){
            $manager = new ImageManager(new Driver());
            $slug=Str::slug($request->title, '-'); //its only for image name
            $photoname = $slug.'.'.$request->image->getClientOriginalExtension();
            $img = $manager->read($request->image);
            $img = $img->resize(725,620);
            $img->save('files/campaign/'.$photoname);
            $data['campaigns']='files/campaign/'.$photoname;   // files/brand/plus-point.jpg
            $data['image']='files/campaign/'.$photoname;   // files/brand/plus-point.jpg
            DB::table('campaigns')->insert($data);
          }
        $notification=array('messege' => 'Campaign Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //delete method
    public function destroy($id)
    {
        $data=DB::table('campaigns')->where('id',$id)->first();
        $image=$data->image;
        if (File::exists($image)) {
             unlink($image);
        }
        DB::table('campaigns')->where('id',$id)->delete();
        $notification=array('messege' => 'Campaign Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //campaign edit method
    public function edit($id)
    {
      $data=DB::table('campaigns')->where('id',$id)->first();
      return view('admin.offer.campaign.edit',compact('data'));
    }

    //update campaign
    public function update(Request $request)
    {
        $slug=Str::slug($request->title, '-');
        $data=array();
        $data['title']=$request->title;
        $data['start_date']=$request->start_date;
        $data['end_date']=$request->end_date;
        $data['status']=$request->status;
        $data['discount']=$request->discount;

        if ($request->image) {
              if (File::exists($request->old_image)) {
                     unlink($request->old_image);
                }
              if($request->image){
                $manager = new ImageManager(new Driver());
                $photoname = $slug.'.'.$request->image->getClientOriginalExtension();
                $img = $manager->read($request->image);
                $img = $img->resize(725,620);
                $img->save('files/campaign/'.$photoname);
                $data['campaigns']='files/campaign/'.$photoname;   // files/brand/plus-point.jpg
                $data['image']='files/campaign/'.$photoname;   // files/brand/plus-point.jpg
                DB::table('campaigns')->where('id',$request->id)->update($data);
              } 
              $notification=array('messege' => 'Campaign Update!', 'alert-type' => 'success');
              return redirect()->back()->with($notification);
        }else{
          $data['image']=$request->old_image;   
          DB::table('campaigns')->where('id',$request->id)->update($data); 
          $notification=array('messege' => 'Campaign Update!', 'alert-type' => 'success');
          return redirect()->back()->with($notification);
        }
    }

    //__campaign products all method__//
    public function campaignProduct($campaign_id)
    {
        $products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->leftJoin('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->leftJoin('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.status', '1')
            ->paginate(30);
    
        return view('admin.offer.campaign_product.index', compact('products', 'campaign_id'));
    }


    //__add product to campaign__//
    public function ProductAddToCampaign($id,$campaign_id)
    {
       $campaign=DB::table('campaigns')->where('id',$campaign_id)->first();
       $product=DB::table('products')->where('id',$id)->first();

       $discount_amount=$product->selling_price/100*$campaign->discount;
       $discount_price=$product->selling_price-$discount_amount;

       $data=array();
       $data['product_id']=$id;
       $data['campaign_id']=$campaign_id;
       $data['price']=$discount_price;
       DB::table('campaign_product')->insert($data);
       $notification=array('messege' => 'Product added to campaign!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    //__product list__//
    public function ProductListCampaign($campaign_id)
    {
        $products = DB::table('campaign_product')
            ->leftJoin('products', 'campaign_product.product_id', 'products.id')
            ->select('products.name', 'products.code', 'products.thumbnail', 'campaign_product.*')
            ->where('campaign_product.campaign_id', $campaign_id)
            ->paginate(10); // Change from ->get() to ->paginate(10)
    
        $campaign = DB::table('campaigns')->where('id', $campaign_id)->first(); 
    
        return view('admin.offer.campaign_product.campaign_product_list', compact('products', 'campaign'));
    }

    //__product rmove from campaign__//
    public function RemoveProduct($id)
    {
        DB::table('campaign_product')->where('id',$id)->delete();
        $notification=array('messege' => 'Product remove from campaign!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
