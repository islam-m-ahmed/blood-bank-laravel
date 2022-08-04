@extends('layouts.app')

@section('title')
    @if(isset($governorate))
        edite governorate
    @else
        add governorate
    @endif
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="@if(isset($governorate)) {{route('governorate.update',$governorate->id) }} @else {{ route('governorate.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($governorate))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           value="@if(isset($governorate)) {{old('name',$governorate->name)}} @else {{old('name')}} @endif"
                                           id="name" name="name" required>
                                    @error('name')
                                    <span class="invalid-feedback" governorate="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: white">
                                <input class="btn btn-primary ml-3" type="submit" @if(isset($governorate)) value="{{ __("Edit") }}" @else value="{{ __('Add') }}" @endif>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
