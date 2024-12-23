<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\DeveloperTeam;
use Illuminate\Support\Str;
use Image;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class DeveloperTeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all category showing method
    public function index()
    {
    	$data=DeveloperTeam::all();	//eloquent ORM
    	return view('admin.developer_team.index',compact('data'));
    }
    //delete category method
    public function destroy($id)
    {
    	$team_member=DeveloperTeam::find($id);
    	$team_member->delete();
        toastr()->success('Team Member Deleted!');
    	return redirect()->back();
    }
    //store method
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required',
        'image' => 'required',
    ]);
    $slug=Str::slug($request->name, '-');

        if($request->image){
            $manager = new ImageManager(new Driver());
            $slug=Str::slug($request->image, '-');
            $photoname = $slug.'.'.$request->image->getClientOriginalExtension();
            $img = $manager->read($request->image);
            $img = $img->resize(564,620);
            $img->save('files/developer team/'.$photoname);
        }
        DeveloperTeam::insert([
            'name'=> $request->name,
            'image'=> 'files/developer team/'.$photoname,
            'roles'=> $request->roles,
            'facebook'=> $request->facebook,
            'twitter'=> $request->twitter,
            'instagram'=> $request->instagram,
            'linkedin'=> $request->linkedin,
        ]);
        toastr()->success('Team Member Details Inserted!');
        return redirect()->back();
    }
    //edit method
    public function edit($id)
    {
        $data=DeveloperTeam::findorfail($id);
        return view('admin.developer_team.edit',compact('data'));
    }
    //update method
    public function update(Request $request)
    {
        $slug=Str::slug($request->name, '-');

        $data=array();
        $data['name']=$request->name;
        $data['roles']=$request->roles;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        if ($request->image) {
              if (File::exists($request->old_image)) {
                     unlink($request->old_image);
                }
              if($request->image){
                $manager = new ImageManager(new Driver());
                $photoname = $slug.'.'.$request->image->getClientOriginalExtension();
                $img = $manager->read($request->image);
                $img = $img->resize(564,620);
                $img->save('files/developer team/'.$photoname);
                $data['image']='files/developer team/'.$photoname;
                DB::table('developer_team')->where('id',$request->id)->update($data); 
              }
              toastr()->success('Team Member Details Update!');
              return redirect()->back();
              
        }else{
          $data['image']=$request->old_image;   
          DB::table('developer_team')->where('id',$request->id)->update($data); 
          toastr()->success('Team Member Details Update!');
          return redirect()->back();
        }
    }
}
