@extends('layouts.admin')
@section('admin_content')
<style>
    .modal-header {
        background-color: #5897fb;
        /* Change this to your desired background color */
        color: #333;
        /* Change this to your desired text color */
    }

    .modal-title-custom {
        font-weight: none;
        color: white;
    }
</style>

<main class="main-wrap">
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Product List </h2>
                <p>List of Product</p>
            </div>
            <div>
                <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm rounded">Create new</a>
            </div>
        </div>
        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">
                    <div class="col-lg-2 col-6 col-md-3 text-center">
                        <!-- Added Bootstrap class "text-center" -->
                        <label class="d-block bold-label">Category</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
                        <select class="form-select submitable" name="category_id" id="category_id">
                            <option value="">All</option>
                            @foreach($category as $row)
                            <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-6 col-md-3 text-center">
                        <!-- Added Bootstrap class "text-center" -->
                        <label class="d-block bold-label">Brand</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
                        <select class="form-select submitable" name="brand_id" id="brand_id">
                            <option value="">All</option>
                            @foreach($brand as $row)
                            <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-6 col-md-3 text-center">
                        <!-- Added Bootstrap class "text-center" -->
                        <label class="d-block bold-label">warehouses</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
                        <select class="form-select submitable" name="warehouse" id="warehouse">
                            <option value="">All</option>
                            @foreach($warehouses as $row)
                            <option value="{{ $row->warehouse_name }}">{{ $row->warehouse_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-6 col-md-3 text-center">
                        <!-- Added Bootstrap class "text-center" -->
                        <label class="d-block bold-label">Status</label> <!-- Added Bootstrap class "d-block" to make the label a block-level element -->
                        <select class="form-select submitable" name="status" id="status" s>
                            <option value="1">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-6 col-md-3 text-center">

                        <label class="d-block bold-label">New Added</label>
                        <select class="form-select submitable" name="new_added" id="new_added">
                            <option value="0">All</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
            </header>

            <div class="card-body">
                <table id="" class="table table-hover ytable static-table">
                    <thead>
                        <tr>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Subcategory</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Featured</th>
                            <th scope="col">Today Deal</th>
                            <th scope="col">Status</th>
                            <th scope="col">New Added</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

{{-- edit modal --}}
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog  modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title modal-title-custom" id="exampleModalLongTitle">Product details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border: none; background: none;">
                    <i class="fa-solid fa-square-xmark" aria-hidden="true" style="font-size: 2em; color: white;"></i>
                </button>
            </div>
            <div class="modal-body" id="quick_view_body">

            </div>
        </div>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //ajax request send for collect childcategory
        $(document).on('click', '.quick_view', function(e) {
            e.preventDefault();
            var id = $(this).attr("id");
            $.ajax({
                url: "{{ url('/product/product-show/') }}/" + id,
                type: 'get',
                success: function(data) {
                    $("#quick_view_body").html(data);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    $(function products() {
        table = $('.ytable').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": {
                "url": "{{ route('product.index') }}",
                "data": function(e) {
                    e.category_id = $("#category_id").val();
                    e.brand_id = $("#brand_id").val();
                    e.status = $("#status").val();
                    e.new_added = $("#new_added").val();
                    e.warehouse = $("#warehouse").val();
                }
            },
            columns: [{
                    data: 'thumbnail',
                    name: 'thumbnail'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'subcategory_name',
                    name: 'subcategory_name'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                {
                    data: 'featured',
                    name: 'featured'
                },
                {
                    data: 'today_deal',
                    name: 'today_deal'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'new_added',
                    name: 'new_added'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    });
    //deactive featured
    $('body').on('click', '.deactive_featurd', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/not-featured') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //Active featured
    $('body').on('click', '.active_featurd', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/active-featured') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //deactive today deal
    $('body').on('click', '.deactive_deal', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/not-deal') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //Active today deal
    $('body').on('click', '.active_deal', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/active-deal') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //deactive status
    $('body').on('click', '.deactive_status', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/not-status') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //Active status
    $('body').on('click', '.active_status', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/active-status') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //deactive new_added
    $('body').on('click', '.deactive_new_added', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/not-new-added') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //Active new_added
    $('body').on('click', '.active_new_added', function() {
        var id = $(this).data('id');
        var url = "{{ url('product/active-new-added') }}/" + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                table.ajax.reload();
            }
        });
    });
    //submitable class call for every change
    $(document).on('change', '.submitable', function() {
        $('.ytable').DataTable().ajax.reload();
    });
</script>
@endsection