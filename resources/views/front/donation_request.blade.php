@extends('layouts.front_app')
@section('content')
    <div class="inside-request">
    <div class="ask-donation">
    <div class="container">
        <div class="path">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Donation requsets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Donation requset: {{$donation->patient_name}} </li>
                </ol>
            </nav>
        </div>
        <div class="details">
            <div class="person">
                <div class="row">
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>Name</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->patient_name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>Blood type</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->bloodType->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>Age</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->patient_age}} years</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>Number of bags required</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->bags_number}}  bags</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>Hospital</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->hospital_address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="inside">
                            <div class="info">
                                <div class="dark">
                                    <p>Telephone number</p>
                                </div>
                                <div class="light">
                                    <p>{{$donation->patient_phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="inside">
                            <div class="info">
                                <div class="special-dark dark">
                                    <p>Hospital adress</p>
                                </div>
                                <div class="special-light light">
                                    <p>{{$donation->hospital_address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="details-button">
                    <a href="#">Details</a>
                </div>
            </div>
            <div class="text">
                <p>
                    {{$donation->notes}}
                </p>
            </div>
            <div class="location">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3418.0770797767814!2d31.409187284906096!3d31.051953681527007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79db9d4d56311%3A0x69ad97566dc9bd76!2z2YXYs9iq2LTZgdmJINin2YTYrtmK2LE!5e0!3m2!1sar!2seg!4v1597910005047!5m2!1sar!2seg" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
