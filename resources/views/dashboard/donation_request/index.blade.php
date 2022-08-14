@extends('layouts.app')

@section('title')
    donation requests
@endsection
@section('content')

    @include('includes.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div>
                        {{--select to search with blood types--}}
                        <label class="ml-4">filter...</label>
                        <form action="{{route('donation_request.index')}}" class="d-inline-block col-sm-5 ml-2" method="get" enctype="multipart/form-data" >
                            <div class="row mt-2 ">
                                <select class="form-control d-inline-block  "  placeholder="search with blood types"  onchange="this.form.submit()" name="select">
                                    <option value="" class="form-select" disabled selected  >search with blood types</option>
                                    @foreach($blood_types as $item)
                                        <option @if(request()->select == $item->id)   selected @endif class="form-select" value="{{$item->id}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                    <option @if(request()->select == "all")  selected @endif class="form-select" value="all">all</option>
                                </select>
                            </div>
                        </form>
                        <label class="ml-4">search....</label>
                        <form style="margin-left: 0" action="{{route('donation_request.index')}}" class="d-inline-block col-sm-5 " method="get" enctype="multipart/form-data" >
                            <div class="row mt-2 ml-3 p-0">
                                <input type="text" class="form-control" name="search" placeholder="search with patient name or age or city or phone or bags num ">
                                <button  aria-hidden="true" id="search_btn" hidden   type="submit" class="btn  btn-danger col-1 mr-5">
                                    filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered table-responsive" style="width:100%">
                            <thead>
                            <tr>
{{--                                <th scope="col">By Who</th>--}}
                                <th scope="col">Patient Name</th>
                                <th scope="col">Patient Age</th>
                                <th scope="col">Blood Type</th>
                                <th scope="col">Hospital Address</th>
                                <th scope="col">Governorate</th>
                                <th scope="col">City</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Notes</th>
                                <th scope="col">pages</th>
                                <th scope="col">delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($donation_requests as $item)
                                <tr>
{{--                                    <td>{{auth()->user()->name}}</td>--}}
                                    <td>{{$item->patient_name}}</td>
                                    <td>{{$item->patient_age}}</td>
                                    <td>{{$item->bloodType->name}}</td>
                                    <td>{{$item->hospital_address}}</td>
                                    <td>{{$item->city->governorate->name}}</td>
                                    <td>{{$item->city->name}}</td>
                                    <td>{{$item->patient_phone}}</td>
                                    <td>{{$item->notes}}</td>
                                    <td>{{$item->bags_num}}</td>
                                    <td>
                                        <div>
{{--                                            <a href="{{route('donation_request.edit', $item->id)}}" class="d-inline-block" >--}}
{{--                                                <button class="btn btn-info d-inline-block">edit</button>--}}
{{--                                            </a>--}}
                                            <form action="{{route('donation_request.destroy', $item->id)}}" class="d-inline-block" method="post" >
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger d-inline-block" onclick="return confirm('Are you sure you want to delete this donation_request?') "><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </section>


@endsection
