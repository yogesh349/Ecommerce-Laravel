@extends('frontend.main_master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <br>
                <img class="card-img-top" src="{{(!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg')}}" alt="" style="border-radius:50%;" height="100%" width="100%"> <br> <br>
                <ul class="list-group list-group-flush">
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>

                </ul>

            </div>

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <div class="card mt-5">
                    <h3 class="text-center mt-5"><span class="text-danger">Change Password</span><strong></strong></h3>
                    <div class="card-body mt-5">

                        <form action="{{route('user.change.password')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="current_password">Current Password <span></span></label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="password">New Password <span></span></label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="current_password">Confirm Password <span></span></label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>


                            

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>

                            

                           

                        </form>
                    </div>
                </div>

            </div>

        </div> {{--  end row --}}
    </div>
</div>
@endsection