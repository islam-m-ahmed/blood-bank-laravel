@extends('layouts.app')

@section('title')
    @if(isset($city))
        edite city
    @else
        add city
    @endif
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="@if(isset($city)) {{route('city.update',$city->id) }} @else {{ route('city.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($city))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           value="@if(isset($city)) {{old('name',$city->name)}} @else {{old('name')}} @endif"
                                           id="name" name="name" required>
                                    @error('name')
                                    <span class="invalid-feedback" city="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">governorates</label>
                                    <select class="form-control @error('governorate_id') is-invalid @enderror" name="governorate_id" required>
                                        @foreach($governorates as $item)
                                            <option @if(isset( $city )) @if($city->governorate_id == $item->id) selected @endif @endif value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('governorate_id')
                                    <span class="invalid-feedback" city="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: white">
                                <input class="btn btn-primary ml-3" type="submit" @if(isset($city)) value="{{ __("Edit") }}" @else value="{{ __('Add') }}" @endif>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
