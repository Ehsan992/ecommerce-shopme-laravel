@extends('layouts.admin')

@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="row">
      <div class="col-9">
        <div class="content-header">
          <h2 class="content-title">Add SEO Details</h2>
        </div>
      </div>
      <form role="form" action="{{route('seo.setting.update',$data->id)}}" method="Post">
        @csrf
        <div class="col-lg-6">
          <div class="card mb-4">
            <div class="card-body">
              <div class="mb-4">
                <label for="product_title" class="form-label">Meta Title</label>
                <input type="text" placeholder="Type here" class="form-control" id="product_title" name="meta_title" value="{{$data->meta_title}}">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Meta Author</label>
                <input type="text" placeholder="Type here" class="form-control" id="product_title" name="meta_author" value="{{$data->meta_author}}">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Meta Tags</label>
                <input type="text" placeholder="Type here" class="form-control" id="product_title" name="meta_tag" value="{{$data->meta_tag}}">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Meta Keyword</label>
                <input type="text" placeholder="Type here" class="form-control" id="product_title" name="meta_keyword" value="{{$data->meta_keyword}}">
              </div>
              <div class="mb-4">
                <label class="form-label">Meta Description</label>
                <textarea placeholder="Type here" class="form-control" rows="4" name="meta_description">{{$data->meta_description}}</textarea>
              </div>
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <div class="mb-4">
                <label for="product_title" class="form-label">Google Verification</label>
                <input type="text" placeholder="Type here" class="form-control" name="google_verification" value="{{$data->google_verification}}" id="product_title">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Alexa verification</label>
                <input type="text" placeholder="Type here" class="form-control" name="alexa_verification" value="{{$data->alexa_verification}}" id="product_title">
              </div>
              <div class="mb-4">
                <label class="form-label">Google Analytics</label>
                <textarea placeholder="Type here" class="form-control" rows="4" name="google_analytics">{{$data->google_analytics}}</textarea>
              </div>
              <div class="mb-4">
                <label class="form-label">Google Adsense</label>
                <textarea placeholder="Type here" class="form-control" rows="4" name="google_adsense">{{$data->google_adsense}}</textarea>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Update</button>
        </div>
      </form>
    </div>
  </section>
</main>
@endsection