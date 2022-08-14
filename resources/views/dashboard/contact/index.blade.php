@extends('layouts.app')

@section('title')
    contacts
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
                                <th scope="col">Title</th>
                                <th scope="col">Message</th>
                                <th scope="col">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($contacts as $item)
                                <tr>
                                    <td>{{$item->client->name}}</td>
                                    <td>{{$item->client->email}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->message}}</td>
                                    <td>
                                        <div>
                                            <form action="{{route('contact.destroy', $item->id)}}" class="d-inline-block" method="post" >
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger d-inline-block" onclick="return confirm('Are you sure you want to delete this contact?') ">delete</button>
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
