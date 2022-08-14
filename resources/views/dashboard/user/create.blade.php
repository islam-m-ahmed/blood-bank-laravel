@extends('layouts.app')

@section('title')

    @if(isset($user))
        edite user
    @else
        add user
    @endif

@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="@if(isset($user)) {{route('user.update',$user->id) }} @else {{ route('user.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($user))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           value="@if(isset($user)) {{old('name',$user->name)}} @else {{old('name')}} @endif"
                                           id="name" name="name" required>
                                    @error('name')
                                    <span class="invalid-feedback" user="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                           value="@if(isset($user)) {{old('email',$user->email)}} @else {{old('email')}} @endif"
                                           id="name" name="email" required>
                                    @error('email')
                                    <span class="invalid-feedback" user="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">roles</label>
                                    <select class="form-control text-black-50 js-example-basic-multiple" name="roles[]" multiple="multiple">
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}"
                                        @if(isset($user))
                                            @if($user->hasRole($role))
                                                selected
                                            @endif
                                        @endif
                                        >{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('roles')
                                    <span class="invalid-feedback" user="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           value="{{old('password')}}"
                                           id="password" name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" user="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">password confirmation</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" value="{{old('password_confirmation')}}"
                                           id="name" name="password_confirmation" >
                                    @error('password')
                                    <span class="invalid-feedback" user="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: white">
                                <input class="btn btn-primary ml-3" type="submit" @if(isset($user)) value="{{ __("Edit") }}" @else value="{{ __('Add') }}" @endif>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
