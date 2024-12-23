@extends('layouts.admin')
@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <form action="{{ route('update.role') }}" method="post">
      @csrf
      <input type="hidden" name="id" value="{{ $data->id }}">
      <div class="row">
        <div class="col-9">
          <div class="content-header">
            <h2 class="content-title">Update Role</h2>
            <div>
              <button class="btn btn-light rounded font-sm mr-5 text-body hover-up" type="submit">Submit</button>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-4">
            <div class="card-header">
              <h4>Add New Role</h4>
            </div>
            <div class="card-body">
              <div class="col-lg-12">
                <label for="product_name" class="form-label">Employee Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ $data->name }}" required="">
              </div>
              <div class="col-lg-12">
                <label for="product_name" class="form-label">Employee Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control" value="{{ $data->email }}" name="email" required="">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card mb-4">
            <div class="card-header">
              <h4>Permit User Featured</h4>
            </div>
            <div class="card-body">
              <div class="form-check">
                <input class="form-check-input" name="blog" value="1" @if($data->blog==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Blogs
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="category" value="1" @if($data->category==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Category
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="offer" value="1" @if($data->offer==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Offer
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="report" value="1" @if($data->report==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Report
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="add_product" value="1" @if($data->add_product==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Add Product
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="product_list" value="1" @if($data->product_list==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Product List
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="brands" value="1" @if($data->brands==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Brands
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="developer_team" value="1" @if($data->developer_team==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Developer Team
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="order" value="1" @if($data->order==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Orders
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="pickup" value="1" @if($data->pickup==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Pickup Point
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="warehouse" value="1" @if($data->warehouse==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Warehouse
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="setting" value="1" @if($data->setting==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Settings
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="userrole" value="1" @if($data->userrole==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Assign User Role
                </label>
              </div>

              <div class="form-check">
                <input class="form-check-input" name="account" value="1" @if($data->account==1) checked @endif type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Account
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</main>

@endsection