@extends('layouts.adminApp')


@section('content')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">{{__('messages.Home')}}</a></li>
          <li class="breadcrumb-item active">{{__('messages.Profile')}}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      @include('includes.flashmessage')


      <section class="section profile">
      <div class="row">

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">{{__('messages.Overview')}}</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">{{__('messages.Edit Profile')}}</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">{{__('messages.Change Password')}}</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">{{__('messages.Profile Information')}}</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">{{__('messages.Name')}}</div>
                    <div class="col-lg-9 col-md-8">{{$admin->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.E-Mail')}}</div>
                    <div class="col-lg-9 col-md-8">{{$admin->email}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.Phone')}}</div>
                    <div class="col-lg-9 col-md-8">{{$admin->phone}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">{{__('messages.Address')}}</div>
                    <div class="col-lg-9 col-md-8">{{$admin->address}}</div>
                  </div>



                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{route('admins.update',Auth::id())}}" method="post" >
                      @csrf
                      @method('PUT')
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Name')}}</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName" value="{{$admin->name}}">
                      </div>
                    </div>

                      <div class="row mb-3">
                          <label for="Address" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Address')}}</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="address" type="text" class="form-control" id="Address" value="{{$admin->address}}">
                          </div>
                      </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Phone')}}</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="company" value="{{$admin->phone}}">
                      </div>
                    </div>



                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">{{__('messages.Save Changes')}}</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="post" action="{{route('admins.changePassword',Auth::id())}}">
                      @csrf
                      @method('PUT')
                      <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Current Password')}}</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">{{__('messages.New Password')}}</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">{{__('messages.Re-enter New Password')}}</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">{{__('messages.Change Password')}}</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
 @endsection
