@extends('frontend.main_master')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            @include('frontend.common1.user_sidebar')

            <div class="col-md-2">

            </div>

            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{Auth::user()->name}}</strong> Update Your Profile</h3>
                    <div class="card-body">

                        <form action="{{route('user.profile.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="info-title" for="name">Name <span></span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" >
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="name">Email <span></span></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" >
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="image">User Image <span></span></label>
                                <input type="file" class="form-control" id="image" name="profile_photo_path">
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