@extends('layouts.app')
@section('content')
@include('layouts.frontend_partition.navbar')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('shopme') }}" rel="nofollow">Home</a>
                <span></span> Wishlist
            </div>
        </div>
    </div>
    <section class="mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlist as $row)

                                <tr>
                                    <td class="image product-thumbnail"><img src="{{ asset($row->thumbnail) }}" alt="#"></td>
                                    <td class="product-des product-name">
                                        <p class="product-name"><a href="shop-product-right.html">{{ substr($row->name,0,15) }}..</a></p>
                                        <p class="font-xs">{{ $row->date }} </p>
                                    </td>
                                    <td class="text-center" data-title="Stock">
                                        <span class="color3 font-weight-bold">In Stock</span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <button class="btn btn-rounded btn-sm"><a href="{{ route('product.details',$row->product_id ) }}" style="color: white;"><i class="far fa-shopping-bag mr-5"></i>Add to cart</a></button>
                                    </td>
                                    <td class="action" data-title="Remove"> <a href="#" class="remove-wishlist" data-id="{{ $row->id }}"><i class="fa fa-trash-alt"></i></a></td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('.remove-wishlist').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            var url = "{{ route('wishlistproduct.delete.ajax', ':id') }}";
            url = url.replace(':id', productId);
            // Store reference to $(this)
            var $this = $(this);
            // Retrieve CSRF token value from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "DELETE",
                url: url,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Update wishlist count in the view
                        var newCount = response.wishlistCount;
                        $('.pro-count').text(newCount);
                        toastr.success(response.message);
                        // Remove the row from the UI
                        $this.closest('tr').remove();
                    } else {
                        toastr.error('Error deleting product from wishlist: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('Error deleting product from wishlist: ' + error);
                }
            });
        });
    });
</script>
@endsection