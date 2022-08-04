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

                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
{{--                                <th scope="col">Phone</th>--}}
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
{{--                                    <td>{{$item->phone}}</td>--}}
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

                                                <button class="btn btn-danger d-inline-block" onclick="confirm('{{ __("Are you sure you want to delete this committee?") }}') ? this.parentElement.submit() : ''">delete</button>
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
