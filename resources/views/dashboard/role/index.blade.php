@extends('layouts.app')

@section('title')
    roles
@endsection
@section('content')

    @include('includes.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: white">
                        <a href="{{route('role.create')}}" class="btn btn-primary" style="float: right">Add Role</a>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Guard name</th>
                                <th scope="col">Permissions</th>
                                <th scope="col">Controls</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->guard_name}}</td>
                                    <td>
                                        @foreach($item->permissions as $permission)
                                            <span class="badge bg-warning" >{{$permission->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div>
                                            <a href="{{route('role.edit', $item->id)}}" class="d-inline-block" >
                                                <button class="btn btn-info d-inline-block"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <form action="{{route('role.destroy', $item->id)}}" class="d-inline-block" method="post" >
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger d-inline-block" onclick="return confirm('Are you sure you want to delete this role?') "><i class="fa fa-trash"></i></button>
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
