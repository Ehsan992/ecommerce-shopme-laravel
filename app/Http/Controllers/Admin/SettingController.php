<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Auth;
use Hash;
use App\Models\User;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //seo page show method
    public function seo()
    {
        $data=DB::table('seos')->first();
        return view('admin.setting.seo',compact('data'));
    }

    //update seo method
    public function seoUpdate(Request $request,$id)
    {
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_author']=$request->meta_author;
        $data['meta_tag']=$request->meta_tag;
        $data['meta_keyword']=$request->meta_keyword;
        $data['meta_description']=$request->meta_description;
        $data['google_verification']=$request->google_verification;
        $data['alexa_verification']=$request->alexa_verification;
        $data['google_analytics']=$request->google_analytics;
        $data['google_adsense']=$request->google_adsense;
        DB::table('seos')->where('id',$id)->update($data);
        $notification=array('messege' => 'SEO Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);

    }

    //smtp setting page
    public function smtp()
    {
        return view('admin.setting.smtp');
    }

    //smtp update
    public function smtpUpdate(Request $request){
        foreach($request->types as $key=>$type){
            $this->updateEnvFile($type, $request[$type]);
        }
        toastr()->success('SMTP Setting Updated!');
        return redirect()->back();
    }

    //profile setting page
    public function profile()
    {
        return view('admin.setting.profile');
    }

    //profile password update
    public function passwordUpdate(Request $request){
           $validated = $request->validate([
               'old_password' => 'required',
               'password' => 'required|min:6|confirmed',
            ]);
    
            $current_password=Auth::user()->password;  //login user password get
    
    
            $oldpass=$request->old_password;  //oldpassword get from input field
            $new_password=$request->password;  // newpassword get for new password
            if (Hash::check($oldpass,$current_password)) {  //checking oldpassword and currentuser password same or not
                   $user=User::findorfail(Auth::id());    //current user data get
                   $user->password=Hash::make($request->password); //current user password hasing
                   $user->save();  //finally save the password
                   Auth::logout();  //logout the admin user anmd redirect admin login panel not user login panel
                   $notification=array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
                   return redirect()->to('/')->with($notification);
            }else{
                $notification=array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            }
    }

    public function profileUpdate(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);
    
        $name = $request->name;  // new name
        $email = $request->email;  // new email
    
        $user = User::findOrFail(Auth::id());  // current user data get
        $user->name = $name; // set new name
        $user->email = $email; // set new email
        $user->save();  // finally save the changes
        $notification=array('messege' => 'Your Profile Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    
    public function updateEnvFile($type, $val)
    {
        $path=base_path('.env');
        if (file_exists($path)) {
            $val='"'.trim($val).'"';
            if (strpos(file_get_contents($path), $type) >= 0) {
                    file_put_contents($path, 
                        str_replace($type.'="'.env($type).'"', $type.'='.$val,
                            file_get_contents($path)
                        )
                    );
            }else{
                file_put_contents($path,file_get_contents($path).$type.'='.$val);
            }
        }
    }




    //website setting
    public function website()
    {
        $setting=DB::table('settings')->first();
        return view('admin.setting.website_setting',compact('setting'));
    }

    //website setting update
    public function WebsiteUpdate(Request $request,$id)
    {
        $data=array();
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;
        if ($request->logo) {
            $manager = new ImageManager(new Driver());
            $logo_name = hexdec(uniqid()).'.'.$request->logo->getClientOriginalExtension();
            $img = $manager->read($request->logo);
            $img = $img->resize(412,438);
			$img->save('files/setting/'.$logo_name);
            $data['logo']='files/setting/'.$logo_name;
        }else{
            $data['logo']=$request->old_logo;
        }

        if ($request->favicon) {
            $manager = new ImageManager(new Driver());  
            $favicon_name = hexdec(uniqid()).'.'.$request->favicon->getClientOriginalExtension();
            $img = $manager->read($request->favicon);
            $img = $img->resize(1293,437);
			$img->save('files/setting/'.$favicon_name);
            $data['favicon']='files/setting/'.$favicon_name;

        }else{   //jodi new logo na dey
            $data['favicon']=$request->old_favicon;
        }

        DB::table('settings')->where('id',$id)->update($data);
        $notification=array('messege' => 'Setting Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__payment gateway
    public function PaymentGateway()
    {
        $aamarpay=DB::table('order_payment_gateway_bd')->first();
        $surjopay=DB::table('order_payment_gateway_bd')->skip(1)->first();
        $ssl=DB::table('order_payment_gateway_bd')->skip(2)->first();
        return view('admin.setting.bdpayment_gateway.edit',compact('aamarpay','surjopay','ssl'));
    }

    //__aamarpay update
    public function AamarpayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('order_payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Payment Gateway Update Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    //__update surjopay
    public function SurjopayUpdate(Request $request)
    {
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('order_payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification=array('messege' => 'Payment Gateway Update Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

}
