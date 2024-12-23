@extends('layouts.admin')
@section('admin_content')
<main class="main-wrap">
  <section class="content-main">
    <div class="row">
      <div class="col-9">
        <div class="content-header">
          <h2 class="content-title">Payment gateway</h2>
        </div>
      </div>
      <form role="form" action="{{ route('update.aamarpay') }}" method="Post">
        @csrf
        <input type="hidden" name="id" value="{{ $aamarpay->id }}">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body">
              <h3 class="card-title">Aamarpay Payment gateway</h3>
              <div class="mb-4">
                <label for="product_title" class="form-label">StoreID</label>
                <input type="text" class="form-control" name="store_id" value="{{ $aamarpay->store_id }}" required>
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Signature KEY</label>
                <input type="text" class="form-control" name="signature_key" value="{{ $aamarpay->signature_key }}" required>
              </div>
              <div class="form-group">
                <input type="checkbox" name="status" value="1" @if($aamarpay->status==1) checked @endif >
                <label for="exampleInputEmail1">Live Server</label>
                <small>(If checbox are not checked it working for sandbox only)</small>
              </div>
              <button type="submit" class="btn btn-light rounded font-sm mr-5 text-body hover-up">Save to draft</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</main>
@endsection