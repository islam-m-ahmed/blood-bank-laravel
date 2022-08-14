@extends('layouts.app')
@inject('client','App\Models\Client')
@inject('user','App\Models\User')
@inject('donation_request','App\Models\DonationRequest')
@inject('governorate','App\Models\Governorate')
@inject('city','App\Models\City')
@inject('category','App\Models\Category')
@inject('post','App\Models\Post')
@inject('contact','App\Models\Contact')

@section('title')
    Dashboard
@endsection
@section('content')

    <div class="row" >
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$client->count()}}</h3>

                    <p>Clients</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-lime">
                <div class="inner">
                    <h3>{{$user->count()}}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$donation_request->count()}}</h3>

                    <p>Donation Requests</p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$governorate->count()}}</h3>

                    <p>Governorates</p>
                </div>
                <div class="icon">
                    <i class="far fa-bookmark"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$city->count()}}</h3>

                    <p>City</p>
                </div>
                <div class="icon">
                    <i class="fa fa-city"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-white">
                <div class="inner">
                    <h3>{{$category->count()}}</h3>

                    <p>category</p>
                </div>
                <div class="icon">
                    <i class="fa fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-fuchsia">
                <div class="inner">
                    <h3>{{$post->count()}}</h3>

                    <p>posts</p>
                </div>
                <div class="icon">
                    <i class="far fa-flag"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$contact->count()}}</h3>

                    <p>messages</p>
                </div>
                <div class="icon">
                    <i class="far fa-envelope"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{ __('You are logged in!') }}
            </div>
            <div class="card-footer">
                Footer
            </div>
        </div>


    </section>


@endsection
