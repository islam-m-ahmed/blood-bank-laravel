@extends('layouts.app')

@section('title')
    governorates
@endsection
@section('content')

    @include('includes.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: white">
                        <a href="{{route('governorate.create')}}" class="btn btn-primary" style="float: right">Add Governorate</a>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Controls</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($governorates as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <div>
                                            <a href="{{route('governorate.edit', $item->id)}}" class="d-inline-block" >
                                                <button class="btn btn-info d-inline-block">edit</button>
                                            </a>
                                            <form action="{{route('governorate.destroy', $item->id)}}" class="d-inline-block" method="post" >
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
