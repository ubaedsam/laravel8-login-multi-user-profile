@extends('dashboard.user.layouts.user-dash-layout')
@section('title','Profile')
    
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle user_picture"
                       src="{{ Auth::user()->picture }}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center user_name">{{ Auth::user()->name }}</h3>

                <p class="text-muted text-center">User</p>

                <input type="file" name="user_image" id="user_image" style="opacity: 0; height:1px; display:none;">
                <a href="javasript:void(0)" class="btn btn-primary btn-block" id="change_picture_btn"><b>Ubah Foto Profile</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#personal_info" data-toggle="tab">Personal Information</a></li>
                  <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Change Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="personal_info">
                    <form class="form-horizontal" method="POST" action="{{ route('userUpdateInfo') }}" id="UserInfoForm">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="{{ Auth::user()->name }}">
                          <span class="text-danger error-text name_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                          <span class="text-danger error-text email_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputFavorite Color" class="col-sm-2 col-form-label">Favorite Color</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="favoritecolor" name="favoritecolor" placeholder="Name" value="{{ Auth::user()->favoriteColor }}">
                          <span class="text-danger error-text favoritecolor_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="change_password">
                    <form class="form-horizontal" action="{{ route('userChangePassword') }}" method="POST" id="changePasswordUserForm">
                      <div class="form-group row">
                        <label for="Password Lama" class="col-sm-2 col-form-label">Password Lama</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="oldpassword" placeholder="Masukan password lama">
                          <span class="text-danger error-text oldpassword_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Password Baru" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Masukan password baru">
                          <span class="text-danger error-text newpassword_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="Konfirmasi Password Baru" class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="cnewpassword" name="cnewpassword" placeholder="Masukan kembali password baru">
                          <span class="text-danger error-text cnewpassword_error"></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Ubah Password</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection