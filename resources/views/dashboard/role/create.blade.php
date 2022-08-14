@extends('layouts.app')

@section('title')

    @if(isset($role))
        edite role
    @else
        add role
    @endif

@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="@if(isset($role)) {{route('role.update',$role->id) }} @else {{ route('role.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($role))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           value="@if(isset($role)) {{old('name',$role->name)}} @else {{old('name')}} @endif"
                                           id="name" name="name" required>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">guard name</label>
                                    <input class="form-control @error('guard_name') is-invalid @enderror" type="text"
                                           value="@if(isset($role)) {{old('guard_name',$role->guard_name)}} @else {{old('guard_name')}} @endif"
                                           id="name" name="guard_name" required>
                                    @error('guard_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">permissions</label>
                                    <div class="row border-1 border">
                                        <div  class="form-control bold border border-0 col-12">
                                            <label >
                                                <input type="checkbox" id="select_all" class="" >
                                                select all</label>
                                        </div>
                                        @foreach($permissions as $item)
                                            <div class="col-sm-3 m-2">
                                                <label class="checkbox text-gray-dark">
                                                    <input  value="{{$item->id}}" class="checkbox @error('permissions') is-invalid @enderror"
                                                           @if(isset($role))
                                                                @if($role->hasPermissionTo($item))
                                                                    checked
                                                                @endif
                                                            @endif
                                                            type="checkbox" id="permissions" name="permissions[]" >
                                                    {{$item->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    @error('permissions')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: white">
                                <input class="btn btn-primary ml-3" type="submit" @if(isset($role)) value="{{ __("Edit") }}" @else value="{{ __('Add') }}" @endif>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>

@push('scripts')



@endpush
@endsection
