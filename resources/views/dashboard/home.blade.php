@extends('layouts.app')
@inject('client','App\Models\Client')
@inject('donation_request','App\Models\DonationRequest')

@section('title')
    Dashboard
@endsection
@section('content')

    <div class="row" >
        <div class="col-lg-3 col-6 ml-2">
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
        <div class="col-lg-3 col-6 ml-2">
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
