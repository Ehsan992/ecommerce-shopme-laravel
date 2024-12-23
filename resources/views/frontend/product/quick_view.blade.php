<style>
    .rounded-image {
        border-radius: 5%;
        border: 2px solid #000;
        width: 100%;
        height: 100%;
    }
</style>
@php
$color=explode(',',$product->color);
$sizes=explode(',',$product->size);
@endphp
{{-- preloader for product quick view --}}

<div class="modal-body product_view d-none">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5">
                <div class="">
                    <img src="{{ asset($product->thumbnail) }}" class="rounded-image">
                </div>
            </div>
            <div class="col-lg-7 ">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
                <p style="color: #000000; font-weight: bold;">Brand: <p>{{ $product->brand->brand_name }}</p></p>
                <p style="color: #000000;">Stock: @if($product->stock_quantity < 1) <span style="color: red; font-weight: bold;">Stock Out</span> @else <span style="color: green; font-weight: bold;">Stock Available</span> @endif </p>
                <div class="product-price">
                    @if($product->discount_price==NULL)
                    <span style="color: #2196f3;font-weight: bold;">{{ $setting->currency }}{{ $product->selling_price }}</span>
                    @else
                    <span style="color: #2196f3;font-weight: bold;">{{ $setting->currency }}{{ $product->discount_price }}</span>
                    <del class="old-price" style="opacity: 0.6;">{{ $setting->currency }}{{ $product->selling_price }}</del>
                    @endif
                </div>
                <br>
                <div class="order_info d-flex flex-row">
                    <form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_cart_form">
                        @csrf
                        {{-- cart add details --}}
                        <input type="hidden" name="id" value="{{$product->id}}">
                        @if($product->discount_price==NULL)
                        <input type="hidden" name="price" value="{{$product->selling_price}}">
                        @else
                        <input type="hidden" name="price" value="{{$product->discount_price}}">
                        @endif
                        <div class="form-group">
                            <div class="row">
                                @isset($product->size)
                                <div class="col-lg-4">
                                    <label style="color: #000000; font-weight: bold;">Size: </label>
                                    <select class="custom-select form-control-sm" name="size" style="min-width: 120px; margin-left: -2px; border: 2px solid #2196f3;">
                                        @foreach($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endisset
                                @isset($product->color)
                                <div class="col-lg-4">
                                    <label style="color: #000000; font-weight: bold;">Color: </label>
                                    <select class="custom-select form-control-sm" name="color" style="min-width: 120px; border: 2px solid #2196f3;">
                                        @foreach($color as $row)
                                        <option value="{{ $row }}">{{ $row }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endisset
                            </div>
                            <div class="col-lg-4" style="margin-left: -2px;">
                                <label style="color: #000000; font-weight: bold;">Quantity: </label>
                                <input type="number" min="1" max="100" name="qty" class="form-control-sm" value="1" style="min-width: 120px; margin-left: 0px; border: 2px solid #2196f3;">
                            </div>
                        </div>
                        <div class="button_container">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    @if($product->stock_quantity< 1) <span class="text-danger">Stock Out</span>
                                        @elseif(Auth::check())
                                        <button class="btn btn-fill-out btn-addtocart" type="submit" style="float: right; margin-left: -5px;margin-top: 10px;">
                                            <span class="loading d-none">....</span> Add to cart</button>
                                        @else
                                        <p>Please at first login to your account for Add to cart.</p>
                                        @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.loader').ready(function() {
        setTimeout(function() {
            $('.product_view').removeClass("d-none");
            $('.loader').css("display", "none");
        }, 500);
    });
</script>

<script type="text/javascript">
    //store coupon ajax call
    $('#add_cart_form').submit(function(e) {
        e.preventDefault();
        $('.loading').removeClass('d-none');
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            async: false,
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#add_cart_form')[0].reset();
                $('.loading').addClass('d-none');
                cart();
            }
        });
    });
</script>