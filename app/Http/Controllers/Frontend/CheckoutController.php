<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Cart;
use DB;
use Session;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //__checkout page
    public function Checkout()
    {
        if (!Auth::check()) {     
            toastr()->info('Login Your Account!');
            return redirect()->back()->with($notification);  
        }
        // Fetch cart items associated with the authenticated user
        $content = Cart::content()->filter(function ($item) {
            return $item->options['user_id'] == Auth::id();
        })->map(function ($item) {
            $product = DB::table('products')->where('id', $item->id)->first();
            $item->available_colors = explode(',', $product->color); 
            $item->available_sizes = explode(',', $product->size);   
            return $item;
        });
        
        $category = DB::table('categories')->orderBy('category_name', 'ASC')->get();
        $setting = DB::table('settings')->first();
        return view('frontend.cart.checkout',compact('content','category','setting'));
    }

    //__orderplace__
    public function OrderPlace(Request $request)
    {

        if ($request->payment_option == "Hand Cash") {
            $order = array();
            $order['user_id'] = Auth::id();
            $order['c_name'] = $request->c_name;
            $order['c_phone'] = $request->c_phone;
            $order['c_country'] = $request->c_country;
            $order['c_address'] = $request->c_address;
            $order['c_email'] = $request->c_email;
            $order['c_zipcode'] = $request->c_zipcode;
            $order['c_city'] = $request->c_city;
        
            // Calculate subtotal for cart items associated with the user
            $subtotal = 0;
            foreach (Cart::content()->where('options.user_id', Auth::id()) as $item) {
                $subtotal += $item->qty * $item->price;
            }
            
            if (Session::has('coupon')) {
                $order['subtotal'] = $subtotal; // Subtotal before discount
                $couponDiscount = Session::get('coupon')['discount'];
                $subtotal -= $couponDiscount; // Apply coupon discount
                $order['coupon_code'] = Session::get('coupon')['name'];
                $order['coupon_discount'] = $couponDiscount;
                $order['after_discount'] = $subtotal;
            } else {
                $order['subtotal'] = $subtotal;
            }
        
            // Calculate total for cart items associated with the user
            $total = $subtotal;
            // Add any additional charges here if applicable
        
            $order['total'] = $total;
            $order['payment_type'] = $request->payment_option;
            $order['tax'] = 0;
            $order['shipping_charge'] = 0;
            $order['order_id'] = rand(10000, 900000);
            $order['status'] = 0;
            $order['date'] = date('d-m-Y');
            $order['month'] = date('F');
            $order['year'] = date('Y');
        
            $order_id = DB::table('orders')->insertGetId($order);
            Mail::to($request->c_email)->send(new InvoiceMail($order));

            // Order details
            foreach (Cart::content()->where('options.user_id', Auth::id()) as $row) {
                $details = [
                    'order_id' => $order_id,
                    'product_id' => $row->id,
                    'product_name' => $row->name,
                    'color' => $row->options->color,
                    'size' => $row->options->size,
                    'quantity' => $row->qty,
                    'single_price' => $row->price,
                    'subtotal_price' => $row->price * $row->qty
                ];
                DB::table('order_details')->insert($details);
            }
        
            Cart::destroy();
            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            toastr()->success('Successfully placed the order!');
            return redirect()->to('/');
        }
        
        elseif ($request->payment_option == "Aamarpay") {
            $aamarpay = DB::table('order_payment_gateway_bd')->first();
            if ($aamarpay->store_id == NULL) {
                $notification = array('messege' => 'Please setting your payment gateway', 'alert-type' => 'error');
                return redirect()->back()->with($notification);
            } else {
                $url = ($aamarpay->status == 1) ? 'https://sandbox.aamarpay.com/jsonpost.php' : 'https://secure.aamarpay.com/jsonpost.php';
                
                $user_id = Auth::id();
                $tran_id = "test" . rand(1111111, 9999999);
                $currency = "BDT";
                $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";
                $curl = curl_init();

                $subtotal = 0;
                foreach (Cart::content()->where('options.user_id', Auth::id()) as $item) {
                    $subtotal += $item->qty * $item->price;
                }
                
                if (Session::has('coupon')) {
                    $order['subtotal'] = $subtotal; // Subtotal before discount
                    $couponDiscount = Session::get('coupon')['discount'];
                    $subtotal -= $couponDiscount; // Apply coupon discount
                    $order['coupon_code'] = Session::get('coupon')['name'];
                    $order['coupon_discount'] = $couponDiscount;
                    $order['after_discount'] = $subtotal;
                } else {
                    $order['subtotal'] = $subtotal;
                }
        
                // Calculate total for cart items associated with the user
                $total = $subtotal;
        
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode([
                        "store_id" => $aamarpay->store_id,
                        "tran_id" => $tran_id,
                        "success_url" => route('success'),
                        "fail_url" => route('fail'),
                        "cancel_url" => route('cancel'),
                        "amount" => $total,
                        "currency" => $currency,
                        "signature_key" => $signature_key,
                        "desc" => "Merchant Registration Payment",
                        "cus_name" => $request->c_name,
                        "cus_phone" => $request->c_phone,
                        "opt_a" => $user_id,
                        "opt_b" => $request->c_address,
                        "cus_email" => $request->c_email,
                        "opt_c" => $request->c_zipcode,
                        "opt_d" => $request->c_city,
                        "type" => "json"
                    ]),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                    ),
                ));
        
                $response = curl_exec($curl);
        
                curl_close($curl);
        
                $responseObj = json_decode($response);
        
                if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {
                    $paymentUrl = $responseObj->payment_url;
                    return redirect()->away($paymentUrl);
                } else {
                    return $response;
                }
            }
        }
        
        
    }









    
    function redirect_to_merchant($url) {

        ?>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <script type="text/javascript">
            function closethisasap() {
                document.forms["redirectpost"].submit();
            }
        </script>
    </head>

    <body onLoad="closethisasap();">

        <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
        <!-- for live url https://secure.aamarpay.com -->
    </body>

    </html>
    <?php   
            exit;
    } 
    











    //__paymentgateway extra method
    public function success(Request $request){
        // Proceed with order creation
        $order = array();
        $order['user_id']=$request->opt_a;
        $order['c_name'] = $request->cus_name;
        $order['c_phone'] = $request->cus_phone;
        $order['c_address'] = $request->opt_b;
        $order['c_email'] = $request->cus_email;
        $order['c_zipcode'] = $request->opt_c;
        $order['c_city'] = $request->opt_d;
        // Calculate subtotal for cart items associated with the user
        $subtotal = 0;
        foreach (Cart::content()->where('options.user_id', $request->opt_a) as $item) {
            $subtotal += $item->qty * $item->price;
        }
        
        if (Session::has('coupon')) {
            $order['subtotal'] = $subtotal; // Subtotal before discount
            $couponDiscount = Session::get('coupon')['discount'];
            $subtotal -= $couponDiscount; // Apply coupon discount
            $order['coupon_code'] = Session::get('coupon')['name'];
            $order['coupon_discount'] = $couponDiscount;
            $order['after_discount'] = $subtotal;
        } else {
            $order['subtotal'] = $subtotal;
        }
    
        // Calculate total for cart items associated with the user
        $total = $request->amount;
        // Add any additional charges here if applicable
    
        $order['total'] = $total;
        $order['payment_type'] = 'Aamarpay';
        $order['tax'] = 0;
        $order['shipping_charge'] = 0;
        $order['order_id'] = rand(10000, 900000);
        $order['status'] = 0;
        $order['date'] = date('d-m-Y');
        $order['month'] = date('F');
        $order['year'] = date('Y');
    
        $order_id = DB::table('orders')->insertGetId($order);
        Mail::to($request->cus_email)->send(new InvoiceMail($order));

        // Order details
        foreach (Cart::content()->where('options.user_id', Auth::id()) as $row) {
            $details = [
                'order_id' => $order_id,
                'product_id' => $row->id,
                'product_name' => $row->name,
                'color' => $row->options->color,
                'size' => $row->options->size,
                'quantity' => $row->qty,
                'single_price' => $row->price,
                'subtotal_price' => $row->price * $row->qty
            ];
            DB::table('order_details')->insert($details);
        }
    
        Cart::destroy();
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $request_id= $request->mer_txnid;

        //verify the transection using Search Transection API 

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";
        
        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

        toastr()->success('Successfully placed the order!');
        return redirect()->to('/');
    }

    public function fail(Request $request){
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }
}