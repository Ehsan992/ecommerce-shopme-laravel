@extends('layouts.admin')

@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="row">
      <div class="col-9">
        <div class="content-header">
          <h2 class="content-title">Website Setting</h2>
        </div>
      </div>
      <form role="form" action="{{route('website.setting.update',$setting->id)}}" method="Post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-8">
            <div class="card mb-4">
              <div class="card-body">
                <div class="mb-4">
                  <label class="form-label">Currency</label>
                  <select class="form-select" name="currency">
                    <option value="৳" {{ ($setting->currency == '৳') ? 'selected': '' }}>Taka (৳)</option>
                    <option value="$" {{ ($setting->currency == '$') ? 'selected': '' }}>USD ($)</option>
                    <option value="₹" {{ ($setting->currency == '₹') ? 'selected': '' }}>Rupee (₹)</option>
                  </select>
                </div>
                <div class="row gx-2">
                  <div class="col-md-6 mb-3">
                    <label for="product_sku" class="form-label">Phone One</label>
                    <input type="text" class="form-control" name="phone_one" value="{{$setting->phone_one}}" required="">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="product_color" class="form-label">Phone Two</label>
                    <input type="text" class="form-control" name="phone_two" value="{{$setting->phone_two}}" required="">
                  </div>
                </div>
                <div class="row gx-2">
                  <div class="col-md-6 mb-3">
                    <label for="product_sku" class="form-label">Main Email</label>
                    <input type="email" class="form-control" name="main_email" value="{{$setting->main_email}}">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="product_color" class="form-label">Support Email</label>
                    <input type="email" class="form-control" name="support_email" value="{{$setting->support_email}}">
                  </div>
                </div>
                <div class="mb-4">
                  <label for="product_brand" class="form-label">Address</label>
                  <input type="text" class="form-control" name="address" value="{{$setting->address}}">
                </div>
              </div>
              <div class="card-body">
                <div>
                  <label class="form-label">Main Logo</label>
                  <input type="file" class="form-control" name="logo">
                  <input type="hidden" name="old_logo" value="{{$setting->logo}}">
                </div>
              </div>
              <div class="card-body">
                <div>
                  <label class="form-label">Favicon Image</label>
                  <input type="file" class="form-control" name="favicon">
                  <input type="hidden" name="old_favicon" value="{{$setting->favicon}}"> </div>
              </div>
            </div> <!-- card end// -->
          </div>
          <div class="col-lg-4">
            <div class="card mb-4">
              <div class="card-body">
                <div class="col-md-12">
                  <label for="product_sku" class="form-label">Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="{{$setting->facebook}}">
                </div>
                <div class="col-md-12">
                  <label for="product_sku" class="form-label">Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="{{$setting->twitter}}">
                </div>
                <div class="col-md-12">
                  <label for="product_sku" class="form-label">Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="{{$setting->instagram}}">
                </div>
                <div class="col-md-12">
                  <label for="product_sku" class="form-label">Linkedin</label>
                  <input type="text" class="form-control" name="linkedin" value="{{$setting->linkedin}}">
                </div>
                <div class="col-md-12">
                  <label for="product_sku" class="form-label">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="{{$setting->youtube}}">
                </div>
              </div>
            </div>
          </div> <!-- card end// -->
        </div>
        <button type="submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Update</button>
      </form>
    </div>
  </section>

</main>
@endsection