@extends('layouts.app')
@extends('firstapp')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div>
                <a href="{{asset('storehomepage')}}" class="btn btn-facebook btn-user btn-block">
                    Store Home Page
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('breadscrumb','Home page')