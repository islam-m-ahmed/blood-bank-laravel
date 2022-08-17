@extends('layouts.front_app')
@inject('blood_types','App\Models\BloodType')
@inject('governorates','App\Models\Governorate')
@section('content')
    <div class="donation-requests">
        <!--inside-article-->
        <div class="all-requests">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Donation requests</li>
                        </ol>
                    </nav>
                </div>

                <!--requests-->
                <div class="requests">
                    <div class="head-text">
                        <h2>Donation requests</h2>
                    </div>
                    <div class="content">
                        <form class="row filter" method="get" action="{{route('donation_requests')}}">
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

                            @else
                                <p class="text text-center mb-5">sorry, we dont find donation</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
