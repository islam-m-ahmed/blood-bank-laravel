@extends('layouts.front_app')
@inject('blood_types','App\Models\BloodType')
@inject('governorates','App\Models\Governorate')

@section('content')
        <!--intro-->
        <div class="intro">
            <div id="slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider" data-slide-to="0" class="active"></li>
                    <li data-target="#slider" data-slide-to="1"></li>
                    <li data-target="#slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item carousel-1 active">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>Blood bank moving forward to better health</h3>
                                <p>
                                    {{\Illuminate\Support\Str::limit($settings->about_app,110, $end = ' .....')}}
                                </p>
                                <a href="{{url('/about_us')}}">more</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item carousel-2">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>Blood bank moving forward to better health</h3>
                                <p>
                                    {{\Illuminate\Support\Str::limit($settings->about_app,110, $end = ' .....')}}
                                </p>
                                <a href="{{url('/about_us')}}">more</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item carousel-3">
                        <div class="container info">
                            <div class="col-lg-5">
                                <h3>Blood bank moving forward to better health</h3>
                                <<p>
                                    {{\Illuminate\Support\Str::limit($settings->about_app,110, $end = ' .....')}}
                                </p>
                                <a href="{{url('/about_us')}}">more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--about-->
        <div class="about">
            <div class="container">
                <div class="col-lg-6 text-md-left">
                    <p>
                        <span>Blood Bank</span>
                        {{$settings->about_app}}
                    </p>
                </div>
            </div>
        </div>

        <!--articles-->
        <div class="articles">
            <div class="container title">
                <div class="head-text">
                    <h2>Articles</h2>
                </div>
            </div>
            <div class="view">
                <div class="container">
                    <div class="row">
                        <!-- Set up your HTML -->
                        <div class="owl-carousel articles-carousel">
                            @foreach($posts as $post)
                                <div class="card">
                                    <div class="photo">
                                        <img style="max-height: 20rem" src="{{asset('images/posts/'.$post->image)}}" class="card-img-top"  alt="...">
                                        <a href="{{route('article',$post->id)}}" class="click">more</a>
                                    </div>
                                    <a class="favourite">
                                        <i id="{{$post->id}}" onclick="toggleFavourite(this)" class="far fa-heart
                                        {{$post->is_favourite ? 'fas fa-heart' : 'far fa-heart'}}
                                            "></i>
                                    </a>

                                    <div class="card-body">
                                        <h5 class="card-title">{{$post->title}}</h5>
                                        <p class="card-text">
                                            {{$post->content}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--requests-->
        <div class="requests">
            <div class="container">
                <div class="head-text">
                    <h2 >Donation-requests</h2>
                </div>
            </div>
            <div class="content">
                <div class="container">
                    <form class="row filter" method="get" action="{{url('/')}}">
                        <div class="col-md-5 blood">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" id="exampleFormControlSelect1" name="search_blood_type">
                                        <option value="" class="form-select" disabled selected  >search with blood types</option>
                                        @foreach($blood_types->all() as $item)
                                            <option @if(request()->select == $item->id)   selected @endif class="form-select" value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 city">
                            <div class="form-group">
                                <div class="inside-select">
                                    <select class="form-control" id="exampleFormControlSelect1" name="search_governorate">
                                        <option value="" class="form-select" disabled selected  >search with blood governorates</option>
                                        @foreach($governorates->all() as $item)
                                            <option @if(request()->select == $item->id)   selected @endif class="form-select" value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 search">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="patients">
                        @if ($donations->count())
                            @foreach ($donations as $donation)

                            <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">{{$donation->bloodType->name}}</h2>
                            </div>
                            <ul>
                                <li><span>Patient name:</span> {{$donation->patient_name}}</li>
                                <li><span>Hospital:</span> {{$donation->hospital_address}}</li>
                                <li><span>City:</span> {{$donation->city->name}}</li>
                            </ul>
                            <a href="{{route('donation_request',$donation->id)}}">Details</a>
                        </div>

                    @endforeach
                    <div class="more">
                        <a href="{{route('donation_requests')}}">more</a>
                    </div>
                    @else
                        <p class="text text-center mb-5">sorry, we dont find donation</p>
                    @endif
                    </div>
                </div>
            </div>
        </div>

        <!--contact-->
        <div class="contact">
            <div class="container">
                <div class="col-md-7">
                    <div class="title">
                        <h3>Contact us</h3>
                    </div>
                    <p class="text">You can contact us to inquire about information and you will be answered</p>
                    <div class="row whatsapp">
                        <a href="#">
                            <img src="{{asset("front/imgs/whats.png")}}">
                            <p dir="ltr">{{$settings->phone}}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--app-->
        <div class="app">
            <div class="container">
                <div class="row">
                    <div class="info col-md-6">
                        <h3>Blood bank app</h3>
                        <p>
                            This text is an example of text that can be replaced in the same space. This text was generated from.
                        </p>
                        <div class="download">
                            <h4>Available on</h4>
                            <div class="row stores">
                                <div class="col-sm-6">
                                    <a href="https://play.google.com/store">
                                        <img src="{{asset("front/imgs/google.png")}}">
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="https://www.apple.com/eg-ar/app-store/">
                                        <img src="{{asset("front/imgs/ios.png")}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="screens col-md-6">
                        <img src="{{asset("front/imgs/App.png")}}">
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')

            <script type="text/javascript">
                function toggleFavourite(heart) {
                    var post_id = heart.id;
                    $.ajax({
                        url : '{{url(route('toggleFavourite'))}}',
                        type : 'post',
                        data : {_token:"{{csrf_token()}}",post_id: post_id},
                        success: function (data) {
                            if (data.status == 1) {
                                var currentClass = $(heart).attr('class');
                                if (currentClass.includes('fas')) {
                                    $(heart).removeClass('fas fa-heart').addClass('far fa-heart');
                                } else {
                                    $(heart).removeClass('far fa-heart').addClass('fas fa-heart');
                                }
                            }
                        },
                        error: function (jqkhr, textStauts, errorMessage) {
                            console.log(errorMessage); }
                    });

                }
            </script>

        @endpush
@endsection
