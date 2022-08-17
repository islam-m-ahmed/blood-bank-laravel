@extends('layouts.front_app')
@section('content')
    <!--inside-article-->
    <div class="who-are-us">
    <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Who are us</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="logo">
                    <img src="{{asset('front/imgs/logo-ltr.png')}}">
                </div>
                <div class="text">
                    <p class="">
                        {{$settings->about_app}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

