@extends('layouts.admin')
@section('admin_content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script type="text/javascript" src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<style type="text/css">
    /* Custom styles for bootstrap-tagsinput */
    .bootstrap-tagsinput {
        width: 100%;
        padding: 0.5rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .bootstrap-tagsinput .tag {
        background: #5897fb;
        border: 1px solid #5897fb;
        padding: 0.2rem 0.6rem;
        margin-right: 2px;
        color: white;
        border-radius: 0.25rem;
    }

    /* Additional styles to prevent override of form-control */
    .bootstrap-tagsinput input {
        margin: 0;
        border: none;
        outline: none;
        box-shadow: none;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
    }
</style>
<main class="main-wrap">
    <section class="content-main">
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="content-header">
                        <h2 class="content-title">Add New Product</h2>
                        <div>
                            <button class="btn btn-light rounded font-sm mr-5 text-body hover-up" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Basic</h4>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="product_name" class="form-label">Product Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="product_name" class="form-label">Product Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('code') }}" name="code" required="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label">Category/Subcategory<span class="text-danger">*</span></label>
                                        <select class="form-select" name="subcategory_id" id="subcategory_id">
                                            <option disabled="" selected="">choose category</option>
                                            @foreach($category as $row)
                                            @php
                                            $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                                            @endphp
                                            <option style="color:blue;" disabled="">{{ $row->category_name }}
                                            </option>
                                            @foreach($subcategory as $row)
                                            <option value="{{ $row->id }}"> -- {{ $row->subcategory_name }}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Child category<span class="text-danger">*</span></label>
                                        <select class="form-select" name="childcategory_id" id="childcategory_id">
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label">Brand<span class="text-danger">*</span></label>
                                        <select class="form-select" name="brand_id">
                                            @foreach($brand as $row)
                                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Pickup Point<span class="text-danger">*</span></label>
                                        <select class="form-select" name="pickup_point_id">
                                            @foreach($pickup_point as $row)
                                            <option value="{{ $row->id }}">{{ $row->pickup_point_name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="form-label">Unit<span class="text-danger">*</span></label>
                                        <input type="text" class=form-control name="unit" value="{{ old('unit') }}" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Purchase Price<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ old('purchase_price') }}" name="purchase_price">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Selling Price</label>
                                        <input type="text" name="selling_price" value="{{ old('selling_price') }}" class="form-control" required="">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Discount Price</label>
                                        <input type="text" name="discount_price" value="{{ old('discount_price') }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Stock</label>
                                        <input type="text" name="stock_quantity" value="{{ old('stock_quantity') }}" class="form-control">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label">Warehouse<span class="text-danger">*</span></label>
                                        <select class="form-select" name="warehouse">
                                            @foreach($warehosue as $row)
                                            <option value="{{ $row->warehouse_name }}">{{ $row->warehouse_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-4">
                                        <label class="form-label">Tags</label>
                                        <input type="text" class=form-control name="tags" value="{{ old('tags') }}" required="" data-role="tagsinput">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="form-control" value="{{ old('color') }}" data-role="tagsinput" name="color" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Size</label>
                                        <input type="text" class="form-control" value="{{ old('size') }}" data-role="tagsinput" name="size" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-4">
                                        <label class="form-label">Product Details</label>
                                        <textarea class="form-control textarea" name="description" rows="10">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-4">
                                        <label class="form-label">Video Embed Code</label>
                                        <input class="form-control" name="video" value="{{ old('video') }}" placeholder="Only code after embed word">
                                        <small class="text-danger">Only code after embed word</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Main Thumbnail <span class="text-danger">*</span></h4>
                        </div>
                        <div class="card-body">
                            <div class="input-upload">
                                <img src="assets/imgs/theme/upload.svg" alt="">
                                <input type="file" name="thumbnail" required="" accept="image/*" class="dropify">
                            </div><br>
                            <div class="">
                                <table class="table table-bordered" id="dynamic_field">
                                    <h6 class="card-title">Add More Images</h6>
                                    <tr>
                                        <td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-sm font-sm rounded btn-brand  hover-up">Add</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div> <!-- card end// -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Permit Product Featured</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" name="featured" value="1" checked type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Featured Product
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="today_deal" value="1" checked type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Today Deal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="new_added" value="1" checked type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    New Added
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="trendy" value="1" checked type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Trendy Product
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status" value="1" checked type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Status
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
<script src="{{ asset('admin') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script type="text/javascript">
    $('.dropify').dropify(); //dropify image
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
    //ajax request send for collect childcategory
    $("#subcategory_id").change(function() {
        var id = $(this).val();
        $.ajax({
            url: "{{ route('get-child-category', ['id' => ':id']) }}".replace(':id', id),
            type: 'get',
            success: function(data) {
                $('select[name="childcategory_id"]').empty();
                $.each(data, function(key, data) {
                    $('select[name="childcategory_id"]').append('<option value="' + data.id +
                        '">' + data.childcategory_name + '</option>');
                });
            }
        });
    });
    $(document).ready(function() {
        var postURL = "<?php echo url('addmore'); ?>";
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i +
                '" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                i + '" class="btn btn-danger btn_remove">Close</button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
</script>
@endsection