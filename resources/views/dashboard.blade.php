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
                    <h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{Auth::user()->name}}</strong> Welcome to Ecommerce</h3>
                </div>

            </div>

        </div> {{--  end row --}}
    </div>
</div>
@endsection