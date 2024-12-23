<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Models\Product;
use Auth;
use Cart;
use DB;
use Session;
use Mail;
use App\Mail\InvoiceMail;

class CartController extends Controller
{
    // public function AddToCartQV(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'id' => 'required|exists:products,id',
    //         'qty' => 'required|integer|min:1',
    //         'price' => 'required|numeric|min:0',
    //         'color' => 'nullable|string',
    //         'size' => 'nullable|string'
    //     ]);
    
    //     $product = Product::find($request->id);
    
    //     if ($product->discount_price == NULL) {
    //         $price = $product->selling_price;
    //     } else {
    //         $price = $product->discount_price;
    //     }
    
    //     // Add to cart
    //     Cart::add([
    //         'id' => $product->id,
    //         'name' => $product->name,
    //         'qty' => $request->qty,
    //         'price' => $price,
    //         'weight' => 1,
    //         'options' => [
    //             'size' => $request->size,
    //             'color' => $request->color,
    //             'thumbnail' => $product->thumbnail
    //         ],
    //         'tax' => 0
    //     ]);
    
    //     $cartCount = Cart::count();
    //     return response()->json(['cartCount' => $cartCount]);
    // }
    
    public function AddToCartQV(Request $request)
    {
         // Check if user is authenticated
        if (!auth()->check()) {
            return response()->json(['error' => 'Please log in to add items to the cart.'], 401);
        }
        // Validate the request
        $request->validate([
            'id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'color' => 'nullable|string',
            'size' => 'nullable|string'
        ]);
        $product = Product::find($request->id);
        if ($product->discount_price == NULL) {
            $price = $product->selling_price;
        } else {
            $price = $product->discount_price;
        }
    
        // Add to cart with user association
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 1,
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $product->thumbnail,
                'user_id' => Auth::id(), // Associate the user ID with the cart item
            ],
            'tax' => 0
        ]);
    
        $cartCount = Cart::count();
        return response()->json(['cartCount' => $cartCount]);
    }
    



    
    public function getCartCount()
    {
        $cartCount = 0;
        if (Auth::check()) {
            // If the user is authenticated, you might want to count items from the database
            // Example: $cartCount = Cart::where('user_id', Auth::id())->count();
        } else {
            // If the user is not authenticated, count items from the session
            $cart = session()->get('cart');
            if ($cart) {
                // Calculate the cart count based on the number of items in the cart array
                $cartCount = count($cart);
            }
        }

        return response()->json(['count' => $cartCount]);
    }

    //all cart
    public function AllCart()
    {
        $data=array();
        $data['cart_qty']=Cart::count();
        $data['cart_total']=Cart::total();
        return response()->json($data);
    }


    //wishlist
    public function AddWishlist(Request $request, $id)
    {
        if ($request->ajax()) {
            if (Auth::check()) {
                $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();
                if ($check) {
                    return response()->json(['error' => true, 'message' => 'Already in your wishlist!']);
                } else {
                    $data = [
                        'product_id' => $id,
                        'user_id' => Auth::id(),
                        'date' => date('d , F Y')
                    ];
                    DB::table('wishlists')->insert($data);
                    $wishlistCount = DB::table('wishlists')->where('user_id', Auth::id())->count();
                    return response()->json(['success' => true, 'message' => 'Product added to wishlist!', 'wishlistCount' => $wishlistCount]);
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Please log in to add to wishlist!']);
            }
        } else {
            // For non-AJAX requests, you might want to redirect
            return redirect()->back();
        }
    }

    // public function MyCart()
    // {
    //     // Check if user is authenticated
    //     if (!auth()->check()) {
    //         return redirect()->route('login')->with('message', 'Please log in to view your cart.');
    //     }
    
    //     $category = DB::table('categories')->orderBy('category_name', 'ASC')->get();
    //     $setting = DB::table('settings')->first();
    
    //     $content = Cart::content()->map(function ($item) {
    //         $product = DB::table('products')->where('id', $item->id)->first();
    //         $item->available_colors = explode(',', $product->color); // Assuming 'colors' is a comma-separated string
    //         $item->available_sizes = explode(',', $product->size);   // Assuming 'sizes' is a comma-separated string
    //         return $item;
    //     });
    
    //     return view('frontend.cart.cart', compact('content', 'category', 'setting'));
    // }
 
  

    
  
    public function MyCart()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Please log in to view your cart.');
        }
    
        $category = DB::table('categories')->orderBy('category_name', 'ASC')->get();
        $setting = DB::table('settings')->first();
    
        // Fetch cart items associated with the authenticated user
        $content = Cart::content()->filter(function ($item) {
            return $item->options['user_id'] == Auth::id();
        })->map(function ($item) {
            $product = DB::table('products')->where('id', $item->id)->first();
            $item->available_colors = explode(',', $product->color); // Assuming 'colors' is a comma-separated string
            $item->available_sizes = explode(',', $product->size);   // Assuming 'sizes' is a comma-separated string
            return $item;
        });
    
        return view('frontend.cart.cart', compact('content', 'category', 'setting'));
    }


    public function removeProduct($rowId)
    {
        try {
            // Attempt to remove the product from the cart
            Cart::remove($rowId);
            
            // Get the updated cart count
            $cartCount = Cart::count();
            
            // If removal is successful, return a success response with the updated cart count
            return response()->json(['success' => true, 'message' => 'Product removed from cart', 'cartCount' => $cartCount]);
        } catch (\Exception $e) {
            // If an exception occurs, return an error response with the exception message
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    
    public function UpdateQty($rowId,$qty)
    {
        Cart::update($rowId, ['qty' => $qty]);
        return response()->json('Successfully Updated!');
    }

    
    public function UpdateColor($rowId,$color)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $size=$product->options->size;
        Cart::update($rowId, ['options'  => ['color' => $color , 'thumbnail'=>$thumbnail ,'size'=>$size,'user_id' => Auth::id(),]]);
        return response()->json('Successfully Updated!');
    }
    public function UpdateSize($rowId,$size)
    {
        $product=Cart::get($rowId);
        $thumbnail=$product->options->thumbnail;
        $color=$product->options->color;
        Cart::update($rowId, ['options'  => ['size' => $size , 'thumbnail'=>$thumbnail ,'color'=>$color,'user_id' => Auth::id(),]]);
        return response()->json('Successfully Updated!');
    }

    public function clearCart()
    {
        Cart::destroy(); // Clear the cart
        return response()->json('Cart cleared successfully!');
    }

    public function updateCart(Request $request)
    {
        $cartData = $request->all();

        foreach ($cartData as $item) {
            Cart::update($item['rowId'], [
                'qty' => $item['qty'],
                'options' => ['color' => $item['color'], 'user_id' => Auth::id(),]
            ]);
        }

        $updatedCart = Cart::content()->map(function ($row) {
            return [
                'rowId' => $row->rowId,
                'qty' => $row->qty,
                'subtotal' => $row->subtotal
            ];
        });

        return response()->json(['success' => true, 'cart' => $updatedCart]);
    }

    public function wishlist()
    {
        if (Auth::check()) {
            $category=DB::table('categories')->orderBy('category_name','ASC')->get();
            $wishlist=DB::table('wishlists')->leftJoin('products','wishlists.product_id','products.id')->select('products.name','products.thumbnail','products.slug','wishlists.*')->where('wishlists.user_id',Auth::id())->get();
            $content=Cart::content();
            return view('frontend.cart.wishlist',compact('wishlist','content','category'));
        }
        toastr()->error('At first login your account');

        return redirect()->back();
    }

    public function Clearwishlist()
    {
        DB::table('wishlists')->where('user_id',Auth::id())->delete();
        toastr()->success('Wishlist Clear');
        return redirect()->back();
    }

    public function WishlistProductdelete(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('wishlists')->where('id', $id)->delete();
            $wishlistCount = DB::table('wishlists')->where('user_id', Auth::id())->count();
            return response()->json(['success' => true, 'message' => 'Successfully Deleted!', 'wishlistCount' => $wishlistCount]);
        } else {
            // For non-AJAX requests, you might want to redirect
            return redirect()->back();
        }
    }

    public function EmptyCart()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            $cartContent = Cart::content();

            // Filter cart items by user_id and remove each item
            foreach ($cartContent as $item) {
                if (isset($item->options['user_id']) && $item->options['user_id'] == $userId) {
                    Cart::remove($item->rowId);
                }
            }
            toastr()->success('Cart items cleared.');
            return redirect()->to('/');
        }

        toastr()->info('Please log in to clear your cart.');
        return redirect()->route('login');
    }

    public function ApplyCoupon(Request $request)
    {

        $check=DB::table('coupons')->where('coupon_code',$request->coupon)->first();
        if ($check) {
            //__coupon exist
            if (date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($check->valid_date))) {
                 session::put('coupon',[
                    'name'=>$check->coupon_code,
                    'discount'=>$check->coupon_amount,
                    'after_discount'=>Cart::subtotal()-$check->coupon_amount
                 ]);
                 toastr()->success('Coupon Applied!');
                 return redirect()->back();
            }else{
                toastr()->error('Expired Coupon Code!');
               return redirect()->back();
            }
        }else{
            toastr()->error('Invalid Coupon Code! Try again.');
            return redirect()->back();
        }

    }
    //__remove coupon__
    public function RemoveCoupon()
    {
        Session::forget('coupon');
        toastr()->success('Coupon removed!');
        return redirect()->back();
    }
}
