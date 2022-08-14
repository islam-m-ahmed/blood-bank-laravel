@extends('layouts.app')

@section('title')
    clients
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
                        <form action="{{route('client.index')}}" class="d-inline-block col-sm-5 ml-2" method="get" enctype="multipart/form-data" >
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
                        <form style="margin-left: 0" action="{{route('client.index')}}" class="d-inline-block col-sm-5 " method="get" enctype="multipart/form-data" >
                            <div class="row mt-2 ml-3 p-0">
                                <input type="text" class="form-control" name="search" placeholder="search with name or phone or city or email">
                                <button  aria-hidden="true" id="search_btn" hidden   type="submit" class="btn  btn-danger col-1 mr-5">
                                    filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Blood Type</th>
{{--                                <th scope="col">Date Of Birth</th>--}}
                                <th scope="col">City</th>
{{--                                <th scope="col">Last Donation</th>--}}
                                <th scope="col">Status</th>
                                <th scope="col">Controle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->bloodType->name}}</td>
{{--                                    <td>{{$item->date_of_b}}</td>--}}
                                    <td>{{$item->city->name}}</td>
{{--                                    <td>{{$item->last_donation_date}}</td>--}}
                                    <td>
                                        @if($item->status == 1)
                                            <div class="text-center">
                                                <a href="{{route('client.status',['id' => $item->id, 'status' => 0])}}" class="">
                                                    <button class="btn btn-danger "><i class="fa fa-ban"></i></button>
                                                </a>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <a href="{{route('client.status',['id' => $item->id, 'status' => 1])}}" >
                                                    <button class="btn btn-success text-center"><i class="fa fa-check"></i></button>
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{route('client.show', $item->id)}}" class="d-inline-block" >
                                                <button class="btn btn-info d-inline-block">View</button>
                                            </a>
                                            <form action="{{route('client.destroy', $item->id)}}" class="d-inline-block" method="post" >
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger d-inline-block" onclick="return confirm('Are you sure you want to delete this client?') ">delete</button>
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
