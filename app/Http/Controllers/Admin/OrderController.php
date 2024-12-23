<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Mail\RecievedMail;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__order list
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               

            $product=$query->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge bg-danger">Pending</span>';
                        }elseif($row->status==1){
                            return '<span class="badge bg-primary">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge bg-info">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge bg-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge bg-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge bg-danger">Cancel</span>';
                        }
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="#" data-id="'.$row->id.'" class="btn btn-sm font-sm rounded btn-success hover-up view" data-toggle="modal" data-target="#viewModal"><i class="fa fa-eye" style="font-size: 1.5em;color: white;"></i></a>
                        <a href="#" data-id="'.$row->id.'" class="btn btn-sm font-sm rounded btn-brand hover-up edit" data-toggle="modal" data-target="#editModal"><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a> 
                        <a href="'.route('order.delete',[$row->id]).'" class="btn btn-sm font-sm btn-danger rounded hover-up" id="delete"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);       
        }
        $setting=DB::table('settings')->first();
        return view('admin.order.index',compact('setting'));
    }


    //__order edit
    public function Editorder($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        return view('admin.order.edit',compact('order'));
    }

    //__update status
    public function updateStatus(Request $request)
    {
        $data=array();
        $data['c_name']=$request->c_name;
        $data['c_email']=$request->c_email;
        $data['c_address']=$request->c_address;
        $data['c_phone']=$request->c_phone;
        $data['status']=$request->status;
        Mail::to('admin@example.com')->send(new RecievedMail($data));

        DB::table('orders')->where('id',$request->id)->update($data);
        toastr()->success('successfully update status!');
        return redirect()->back();
    }


    //__view Order
    public function ViewOrder($id)
    {
        $order=DB::table('orders')->where('id',$id)->first();
        $order_details=DB::table('order_details')->where('order_id',$id)->get();
        return view('admin.order.order_details',compact('order','order_details'));
    }

    //__delete
    public function delete($id)
    {
       $order=DB::table('orders')->where('id',$id)->delete();
       $order_details=DB::table('order_details')->where('order_id',$id)->delete();
       $notification=array('messege' => 'Order deleted!', 'alert-type' => 'success');
       return redirect()->back()->with($notification);
    }

    //__report index__//
    public function Reportindex(Request $request)
    {
         if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }
               

            $product=$query->get();
            return DataTables::of($product)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==0) {
                            return '<span class="badge bg-danger">Pending</span>';
                        }elseif($row->status==1){
                            return '<span class="badge bg-primary">Recieved</span>';
                        }elseif($row->status==2){
                            return '<span class="badge bg-info">Shipped</span>';
                        }elseif($row->status==3){
                            return '<span class="badge bg-success">Completed</span>';
                        }elseif($row->status==4){
                            return '<span class="badge bg-warning">Return</span>';
                        }elseif($row->status==5){
                            return '<span class="badge bg-danger">Cancel</span>';
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);       
        }

        return view('admin.report.index');
    }

    //order print__
    public function ReportOrderPrint(Request $request)
    {
        if ($request->ajax()) {
            $order="";
              $query=DB::table('orders')->orderBy('id','DESC');
                if ($request->payment_type) {
                    $query->where('payment_type',$request->payment_type);
                }

                if ($request->date) {
                    $order_date=date('d-m-Y',strtotime($request->date));
                    $query->where('date',$order_date);
                }

                if ($request->status==0) {
                    $query->where('status',0);
                }
                if ($request->status==1) {
                    $query->where('status',1);
                }
                if ($request->status==2) {
                    $query->where('status',2);
                }
                if ($request->status==3) {
                    $query->where('status',3);
                }
                if ($request->status==4) {
                    $query->where('status',4);
                }
                if ($request->status==5) {
                    $query->where('status',5);
                }     
            $order=$query->get();
       }

       return view('admin.report.print',compact('order'));
    }

    //__product report index__//
    public function ProductReviewReportIndex(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='files/product';

            $product="";
            $query = DB::table('reviews')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->orderBy('reviews.id', 'DESC');
            

            // ->select('reviews.user_id', 'users.name as user_name')

            if ($request->predicted_emotion=='negative') {
                $query->where('predicted_emotion','negative');
            }
            if ($request->predicted_emotion=='neutral') {
                $query->where('predicted_emotion','neutral');
            }
            if ($request->predicted_emotion=='positive') {
                $query->where('predicted_emotion','positive');
            }
            $product = $query->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('predicted_emotion', function ($row) {
                    if ($row->predicted_emotion=='negative') {
                        return '<span class="badge rounded-pill alert-danger">Negative</span>';
                    }elseif ($row->predicted_emotion=='neutral') {
                        return '<span class="badge rounded-pill alert-secondary">Neutral</span>';
                    }elseif ($row->predicted_emotion=='positive') {
                        return '<span class="badge rounded-pill alert-success">Positive</span>';
                    }
                })
                ->rawColumns(['predicted_emotion'])
                ->make(true);     
        }
        return view('admin.report.product_review_index');
    }

    //__product print__
    public function ProductReviewReportPrint(Request $request)
    {
        if ($request->ajax()) {
            $review = "";
            $query = DB::table('reviews')
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->join('products', 'reviews.product_id', '=', 'products.id')
                ->orderBy('reviews.id', 'DESC');

            if ($request->has('predicted_emotion')) {
                $predicted_emotion = $request->predicted_emotion;
                $query->where('predicted_emotion', $predicted_emotion);
            }

            $review = $query->get();
        }

        return view('admin.report.product_review_print', compact('review'));
    }
    
    //__product report index__//
    public function WebReviewReportIndex(Request $request)
    {
        if ($request->ajax()) {
            $imgurl='files/product';
            $product="";
            $query = DB::table('wbreviews')
            ->join('users', 'wbreviews.user_id', '=', 'users.id')
            ->orderBy('wbreviews.id', 'DESC');
            
            if ($request->predicted_emotion=='negative') {
                $query->where('predicted_emotion','negative');
            }
            if ($request->predicted_emotion=='neutral') {
                $query->where('predicted_emotion','neutral');
            }
            if ($request->predicted_emotion=='positive') {
                $query->where('predicted_emotion','positive');
            }

            $product = $query->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->editColumn('predicted_emotion', function ($row) {
                    if ($row->predicted_emotion=='negative') {
                        return '<span class="badge rounded-pill alert-danger">Negative</span>';
                    }elseif ($row->predicted_emotion=='neutral') {
                        return '<span class="badge rounded-pill alert-secondary">Neutral</span>';
                    }elseif ($row->predicted_emotion=='positive') {
                        return '<span class="badge rounded-pill alert-success">Positive</span>';
                    }
                })
                ->rawColumns(['predicted_emotion'])
                ->make(true);     
        }
        return view('admin.report.web_review_index');
    }

    //__product print__
    public function WebReviewReportPrint(Request $request)
    {
        if ($request->ajax()) {
            $webreviews = "";
            $query = DB::table('wbreviews')
                ->join('users', 'wbreviews.user_id', '=', 'users.id')
                ->orderBy('wbreviews.id', 'DESC');
            $webreviews = $query->get();
        }

        return view('admin.report.web_review_print', compact('webreviews'));
    }
}
