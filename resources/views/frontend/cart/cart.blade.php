@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<style>
    .small-file-input {
    width: 70px; /* Adjust width as needed */
}
</style>
<!-- Add this line to check the data being passed -->
<!-- <pre>{{ json_encode($content) }}</pre> -->
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow">Home</a>
                <span></span> Your Cart
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center clean">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($content as $row)
                                @php
                                $product=DB::table('products')->where('id',$row->id)->first();
                                $colors=explode(',',$product->color);
                                $sizes=explode(',',$product->size);
                                @endphp
                                <tr data-rowid="{{ $row->rowId }}">
                                    <td class="image product-thumbnail"><img src="{{ asset($row->options->thumbnail) }}" alt="{{ $row->name }}"></td>
                                    <td class="product-des product-name">
                                        <p class="product-name"><a href="shop-product-right.html">{{ $row->name }}</a></p>
                                    </td>
                                    <td class="product-color" data-title="color">
                                        @if($row->options->color !=NULL)
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_text">
                                                <select class="custom-select form-control-sm color" data-id="{{ $row->rowId }}" name="color" style="min-width: 100px;">
                                                    @foreach($colors as $color)
                                                    <option value="{{ $color }}" @if($color==$row->options->color) selected @endif>{{ $color }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="product-size" data-title="size">
                                        @if($row->options->size !=NULL)
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_text">
                                                <select class="custom-select form-control-sm size" name="size" style="min-width: 100px;" data-id="{{ $row->rowId }}">
                                                    @foreach($sizes as $size)
                                                    <option value="{{ $size }}" @if($size==$row->options->size) selected @endif >{{ $size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                    </td>

                                    <td class="product-subtotal" data-title="price">{{ $setting->currency }}{{ $row->price }} x {{$row->qty }} </td>

                                    <td class="product-quantity" data-title="Quantity">
                                        <input type="number" class="form-control-sm qty small-file-input" name="qty"  data-id="{{ $row->rowId }}" value="{{ $row->qty }}" min="1" required="">
                                    </td>

                                    <td class="product-subtotal" data-title="Total">{{ $setting->currency }} {{ $row->qty*$row->price }}</td>

                                    <td class="action" data-title="Remove">
                                        <a href="#" class="text-muted remove-product" data-id="{{ $row->rowId }}"><i class="fa fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-action text-end">
                        <a class="btn btn-rounded mr-10" href="{{ route('cart.empty') }}"><i class="far fa-retweet mr-5"></i> Clear Cart</a>
                        <a class="btn btn-rounded" href="{{ url('/') }}"><i class="far fa-cart-plus mr-5"></i>Continue Shopping</a>
                    </div>
                    <div class="divider center_icon mt-50 mb-50"><i class="fa fa-gem"></i></div>
                    <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                            @if(!Session::has('coupon'))
                            <form action="{{ route('apply.coupon') }}" method="post">
                                @csrf
                                <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Apply Coupon</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input class="font-medium" name="coupon" placeholder="Enter Your Coupon">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button class="btn btn-rounded btn-sm"><i class="far fa-bookmark mr-5"></i>Apply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            @endif



                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius-10 cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">{{ $setting->currency }}{{ Cart::subtotal()}}</span></td>
                                                </tr>
                                                @if(Session::has('coupon'))
                                                <tr>
                                                    <td>coupon:({{ Session::get('coupon')['name'] }}) <span class="product-qty"><a href="{{ route('coupon.remove') }}" class="text-danger">X</a></span>
                                                    </td>
                                                    <td>{{ Session::get('coupon')['discount'] }} {{ $setting->currency }}</td>
                                                </tr>
                                                @else
                                                @endif
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Free Shipping</td>
                                                </tr>
                                                @if(Session::has('coupon'))
                                                <tr>
                                                    <th>Total: </th>
                                                    <td class="product-subtotal">{{ Session::get('coupon')['after_discount'] }}
                                                        {{ $setting->currency }}</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">{{ $setting->currency }}{{ Cart::total() }}</span></strong></td>
                                                </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('checkout') }}" class="btn btn-rounded"> <i class="fa fa-share-square mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div>













                </div>
            </div>
    </section>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        //color update
         //qty update with ajax
		 $('body').on('blur','.qty', function(){
		    let qty=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updateqty/') }}/'+rowId+'/'+qty,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //color update
		 $('body').on('change','.color', function(){
		    let color=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatecolor/') }}/'+rowId+'/'+color,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });

		 //size update
		 $('body').on('change','.size', function(){
		    let size=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updatesize/') }}/'+rowId+'/'+size,
		      type:'get',
		      async:false,
		      success:function(data){
		        toastr.success(data);
		        location.reload();
		      }
		    });
		  });
        //qty update with ajax
		 $('body').on('blur','.qty', function(){
		    let qty=$(this).val();
		    let rowId=$(this).data('id');
		    $.ajax({
		      url:'{{ url('cartproduct/updateqty/') }}/'+rowId+'/'+qty,
		      type:'get',
		      async:false,
		      success:function(data){
                location.reload();
		        toastr.success(data);
		      }
		    });
		  });
        // Handle remove product
        document.querySelectorAll('.remove-product').forEach(removeLink => {
            removeLink.addEventListener('click', function(event) {
                event.preventDefault();
                const rowId = this.dataset.id;
                const token = "{{ csrf_token() }}";
                fetch(`/removeProduct/${rowId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-Token': token
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.success) {
                            this.closest('tr').remove();
                            toastr.success('Product removed from cart!');
                            // Update cart count dynamically
                            document.getElementById('cart-count').textContent = data.cartCount;
                        } else {
                            console.error('Failed to remove product');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
        

    });
</script>
@endsection