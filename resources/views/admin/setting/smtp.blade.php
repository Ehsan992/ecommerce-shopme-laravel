@php
$setting = DB::table('settings')->first();
@endphp
@extends('layouts.admin')
@section('admin_content')
<script src="{{asset('admin')}}/js/vendors/jquery-3.5.1.min.js"></script>

<main class="main-wrap">
  <section class="content-main">
  <form role="form" action="{{route('smtp.setting.update')}}" method="Post">
      @csrf
      <div class="row">
        <div class="col-9">
          <div class="content-header">
            <h2 class="content-title">Add SMTP Details</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card mb-4">
            <div class="card-body">
              <div class="mb-4">
                <label for="product_title" class="form-label">Mail Mailer</label>
                <input type="hidden" name="types[]" value="MAIL_MAILER">
                <input type="text" class="form-control" name="MAIL_MAILER" value="{{env('MAIL_MAILER')}}" placeholder="Mail Lailer Example: smtp">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Mail Host</label>
                <input type="hidden" name="types[]" value="MAIL_HOST">
                <input type="text" class="form-control" name="MAIL_HOST" value="{{env('MAIL_HOST')}}" placeholder="Mail Host">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Mail Port</label>
                <input type="hidden" name="types[]" value="MAIL_PORT">
                <input type="text" class="form-control" name="MAIL_PORT" value="{{env('MAIL_PORT')}}" placeholder="Mail Port Example: 2525">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Mail Username</label>
                <input type="hidden" name="types[]" value="MAIL_USERNAME">
                <input type="text" class="form-control" name="MAIL_USERNAME" value="{{env('MAIL_USERNAME')}}" placeholder="Mail Username">
              </div>
              <div class="mb-4">
                <label for="product_title" class="form-label">Mail Password</label>
                <input type="hidden" name="types[]" value="MAIL_PASSWORD">
                <input type="text" class="form-control" name="MAIL_PASSWORD" value="{{env('MAIL_PASSWORD')}}" placeholder="Mail Password"> </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>

        </div>
    </form>
    </div>
  </section>
</main>

@endsection