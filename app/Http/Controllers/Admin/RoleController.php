<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //__role index
    public function index()
    {
        $data=DB::table('users')->where('is_admin',1)->where('role_admin',1)->get();
        return view('admin.role.index',compact('data'));
    }

    //__create roll
    public function create()
    {
        return view('admin.role.create');
    }

    //__store role__//
    public function store(Request $request)
    {
        $validated = $request->validate([
           'email' => 'required|unique:users',
       ]);

        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['password']=Hash::make($request->password);
        $data['blog']=$request->blog;
        $data['category']=$request->category;
        $data['offer']=$request->offer;
        $data['report']=$request->report;
        $data['add_product']=$request->add_product;
        $data['product_list']=$request->product_list;
        $data['brands']=$request->brands;
        $data['developer_team']=$request->developer_team;
        $data['order']=$request->order;
        $data['pickup']=$request->pickup;
        $data['warehouse']=$request->warehouse;
        $data['setting']=$request->setting;
        $data['userrole']=$request->userrole;
        $data['account']=$request->account;
        $data['is_admin']=1;
        $data['role_admin']=1;
        DB::table('users')->insert($data);
        toastr()->success('Role Created!');
        return redirect()->back();
    }

    //__edit method
    public function edit($id)
    {
        $data=DB::table('users')->where('id',$id)->first();
        return view('admin.role.edit',compact('data'));
    }

    //__update method
    public function update(Request $request)
    {
        $id=$request->id;
        $data=array();
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['blog']=$request->blog;
        $data['category']=$request->category;
        $data['offer']=$request->offer;
        $data['report']=$request->report;
        $data['add_product']=$request->add_product;
        $data['product_list']=$request->product_list;
        $data['brands']=$request->brands;
        $data['developer_team']=$request->developer_team;
        $data['order']=$request->order;
        $data['pickup']=$request->pickup;
        $data['warehouse']=$request->warehouse;
        $data['setting']=$request->setting;
        $data['userrole']=$request->userrole;
        $data['account']=$request->account;
        DB::table('users')->where('id',$id)->update($data);
        toastr()->success('Role Updated!');
        return redirect()->route('manage.role');
    }

    //__destroy__
    public function destroy($id)
    {
        DB::table('users')->where('id',$id)->delete();
        toastr()->success('Role Deleted!');
        return redirect()->back();
    }
}
