@extends('layouts.app')

@section('title')
    clients
@endsection
@section('content')

    @include('includes.message')
    <section class="content">
        <div class="row " >
            <div class="card col-10 m-auto card-primary">
                <div class="card-header">
                    <h3 class="card-title">details</h3>
                </div>
                <div class="card-body">
                    <strong>name</strong>
                    <p class="text-muted">
                        {{$client->name}}
                    </p>
                    <hr>
                    <strong>email</strong>
                    <p class="text-muted">
                        {{$client->email}}
                    </p>
                    <hr><strong>phone</strong>
                    <p class="text-muted">
                        {{$client->phone}}
                    </p>
                    <hr>
                    <strong>blood type</strong>
                    <p class="text-muted">
                        {{$client->bloodType->name}}
                    </p>
                    <hr>
                    <strong>date of birth</strong>
                    <p class="text-muted">
                        {{$client->date_of_b}}
                    </p>
                    <hr>
                    <strong>city</strong>
                    <p class="text-muted">
                        {{$client->city->name}}
                    </p>
                    <hr>
                    <strong>last donation date</strong>
                    <p class="text-muted">
                        {{$client->last_donation_date}}
                    </p>
                    <hr>
                    <strong>status</strong>
                    <p class="text-muted">
                    @if($client->status == 1)
                        <div >
                            <a href="{{route('client.status',['id' => $client->id, 'status' => 0])}}" class="">
                            <button class="btn btn-danger ">deactivate</button>
                        </a>
                        </div>
                    @else
                        <div >
                            <a href="{{route('client.status',['id' => $client->id, 'status' => 1])}}" >
                                <button class="btn btn-success text-center">activate</button>
                            </a>
                        </div>
                    @endif
                    </p>
                    <hr>
                    <strong>delete</strong>
                    <p class="text-muted">
                        <div>
                            <form action="{{url('client.destroy',$client->id)}}" method="POST" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <input onclick="return confirm('are you sure to delete this')" value="delete" type="submit" name="delete" class="btn btn-danger ">
                            </form>
                        </div>
                    </p>
                    <hr>


                </div>
                <!-- /.card-body -->
            </div>
        </div>

    </section>
{{----}}

@endsection
