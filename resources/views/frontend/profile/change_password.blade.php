@extends('frontend.main_master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common1.user_sidebar')

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