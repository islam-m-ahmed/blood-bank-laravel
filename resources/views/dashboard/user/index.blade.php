@extends('layouts.app')

@section('title')
    users
@endsection
@section('content')

    @include('includes.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: white">
                        <a href="{{route('user.create')}}" class="btn btn-primary" style="float: right">Add user</a>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Controls</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users  as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        @foreach($item->roles as $role)
                                            <span class="badge badge-warning">{{$role->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{route('user.edit', $item->id)}}" class="d-inline-block" >
                                                <button class="btn btn-info d-inline-block">edit</button>
                                            </a>
                                            <form action="{{route('user.destroy', $item->id)}}" class="d-inline-block" method="post" >
                                                @csrf
                                                @method('delete')

                                                <button class="btn btn-danger d-inline-block" onclick="return confirm('Are you sure you want to delete this user?') ">delete</button>
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
