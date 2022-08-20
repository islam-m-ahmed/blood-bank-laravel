@extends('layouts.front_app')
@inject('governorates',"App\Models\Governorate")
@inject('blood_types',"App\Models\BloodType")

@section('content')
    <!--form-->
    <div class="create">
        <!--form-->
        <div class="form">
            @include('includes.message')

            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">create new account</li>
                        </ol>
                    </nav>
                </div>
                <div class="account-form">
                    <form action="{{route('client.save')}}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <input type="text" class=" @error('name') is-invalid @enderror form-control" name="name" value="{{old('name')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name">
                        @error('name')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="email" class=" @error('email') is-invalid @enderror form-control" name="email" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email">
                        @error('email')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="text" name="phone"  class=" @error('phone') is-invalid @enderror form-control" value="{{old('phone')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="phone">
                        @error('phone')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <select class="form-control" name="governorate_id" id="governorate" required>
                            @foreach($governorates->all() as $item)
                                <option selected  value="{{$item->id}}">
                                    {{$item->name}}
                                </option>
                            @endforeach
                        </select>

                        <select placeholder="chose your city" class="form-control @error("city_id") is-invalid @enderror" id="cities" name="city_id" required>
{{--                        <option  class="">choose your city</option>--}}
                        </select>
                        @error('city_id')
                        <span class="invalid-feedback" city="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                        <input type="date" name="date_of_b" class=" @error('date_of_b') is-invalid @enderror form-control" value="{{old('date_of_b')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="date">
                        @error('date_of_b')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="date" name="last_donation_date" class=" @error('last_donation_date') is-invalid @enderror form-control" value="{{old('last_donation_date')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="last donation date">
                        @error('last_donation_date')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <select class="form-control" name="blood_type_id"  required>
                            @foreach($blood_types->all() as $item)
                                <option class="form-select" value="{{$item->id}}">
                                    {{$item->name}}
                                </option>
                            @endforeach
                        </select>
                           @error('blood_type_id')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="password"  name="password" class=" @error('password') is-invalid @enderror form-control" value="{{old('password')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="password">
                        @error('password')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="password" name="password_confirmation" class=" @error('password_confirmation') is-invalid @enderror form-control" value="{{old('password_confirmation')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="password confirmation">
                        @error('password_confirmation')
                        <span class="invalid-feedback" city="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="create-btn">
                            <input type="submit" value="Creat">
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>


    @push('scripts')

        <script type="text/javascript">
            $('#governorate').change(function (e){
                e.preventDefault()
                var governorate_id = $('#governorate').val();
                if(governorate_id){
                    $.ajax({
                        url : '{{url('api/v1/cities?governorate_id=')}}'+governorate_id,
                        type : 'get',
                        success: function (data) {
                            if (data.status == 1) {
                                $("#cities").empty();
                                $.each(data.data,function (index,city){
                                    $('#cities').append('<option value="'+city.id+'">'+city.name+'<option>');
                                })
                            }
                        },
                        error: function (jqkhr, textStauts, errorMessage) {
                            console.log(errorMessage); }
                    });
                }else {
                    $("#cities").empty();
                    $("#cities").append('<option value="">chose your city</option>');
                }


            })
        </script>

    @endpush
@endsection
