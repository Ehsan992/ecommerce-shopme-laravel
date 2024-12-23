@extends('layouts.admin')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePic = document.querySelector(".image img");
        const userFile = document.querySelector("#file-path");
        userFile.onchange = function() {
            profilePic.src = URL.createObjectURL(userFile.files[0]);
        }
    });
</script>
@section('admin_content')
<main class="main-wrap">
    <section class="content-main">
        <div class="card mb-4 ">
            <div class="card-header bg-primary" style="height:150px">
            </div>
            <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-xl col-lg flex-grow-0" style="flex-basis:210px">
                            <div class="image img-thumbnail shadow w-100 bg-white position-relative text-center" style="height:190px; width:190px; margin-top:-120px">
                                <img src="{{ asset(str_replace('/write', '', Auth::user()->user_photo)) }}" class="center-xy img-fluid" alt="avatar">
                                <label for="file-path">
                                    <span class="material-symbols-rounded" style="position: absolute; top: 15%; left: 58%; transform: translate(100%, -100%); background-color: #fff; border-radius: 50%; padding: 10px;">
                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                    </span>
                                </label>
                                <input type="file" accept="image/jpeg, image/png, image/jpg" id="file-path" class="user-file dropify" name="user_photo" style="display: none;">
                            </div>
                            <div class="d-flex justify-content-center w-100 mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                        <div class="col-xl col-lg">
                            <h3>{{ Auth::user()->name }}</h3>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="card col-lg-6">
                <div class="card-body">
                    <h5 class="card-title">Profile Settings</h5>
                    <div class="row">
                        <form role="form" action="{{route('profile.setting.update')}}" method="Post">
                            @csrf
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="product_title" class="form-label">Username</label>
                                    <input required="" class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ Auth::user()->name }}" placeholder="Enter new username">
                                </div>
                                <div class="mb-4">
                                    <label for="product_title" class="form-label">Email</label>
                                    <input required="" class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ Auth::user()->email }}" placeholder="Enter new email">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card col-lg-6">
                <div class="card-body">
                    <h5 class="card-title">Change Password</h5>
                    <div class="row">
                        <form role="form" action="{{route('password.setting.update')}}" method="Post">
                            @csrf
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="product_title" class="form-label">Current Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                                        <input required="" class="form-control" name="old_password" type="password" placeholder="Enter current password">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="product_title" class="form-label">New Password</label>
                                    <input required="" class="form-control @error('password') is-invalid @enderror" name="password" type="password" placeholder="Enter new password">
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input required="" class="form-control" name="password_confirmation" type="password" placeholder="re-type password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </section>
</main>
@endsection