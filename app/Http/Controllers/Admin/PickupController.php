<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data=DB::table('pickup_point')->latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $actionbtn='<a href="#" class="btn btn-sm font-sm  btn-brand  hover-up edit" data-id="'.$row->id.'" data-toggle="modal" data-target="#editModal" ><i class="material-icons md-edit" style="font-size: 1.5em;color: white;"></i></a>
                        <a href="'.route('pickup.point.delete',[$row->id]).'"  class="btn btn-sm font-sm btn-danger  hover-up" id="delete_coupon"><i class="material-icons md-delete_forever" style="font-size: 1.5em;color: white;"></i> 
                        </a>';
                        
                       return $actionbtn;   
                    })
                    ->rawColumns(['action'])
                    ->make(true);       
        }

        return view('admin.pickup_point.index');
    }

    //store method
    public function store(Request $request)
    {
       $data = array(
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        );
       DB::table('pickup_point')->insert($data);
       toastr()->success('successfully Insert!');
       return redirect()->back();
    }

    //edit method
    public function edit($id)
    {
         $data=DB::table('pickup_point')->where('id',$id)->first();
         return view('admin.pickup_point.edit',compact('data'));
    }

    //update method
    public function update(Request $request)
    {
         $data = array(
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
        );
       DB::table('pickup_point')->where('id',$request->id)->update($data);
       toastr()->success('successfully Updated!');
       return redirect()->back();
    }

    //delete method
    public function destroy($id)
    {
        DB::table('pickup_point')->where('id',$id)->delete();
        toastr()->success('successfully delete!');
        return redirect()->back();
    }

}
