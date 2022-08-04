@extends('layouts.app')

@section('title')
    posts
@endsection
@section('content')

    @include('includes.message')
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: white">
                        <a href="{{route('post.create')}}" class="btn btn-primary" style="float: right">Add post</a>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Controle</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $item)
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->content}}</td>
                                    <td><img src="/images/posts/{{$item->image}}"class="img-fluid img-thumbnail" style="width:100px; max-height: 100px"></td>
                                    <td>{{$item->category->name}}</td>
                                    <td>
                                        <div>
                                            <a href="{{route('post.edit', $item->id)}}" class="d-inline-block" >
                                                <button class="btn btn-info d-inline-block">edit</button>
                                            </a>
                                            <form action="{{route('post.destroy', $item->id)}}" class="d-inline-block" method="post" >
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
