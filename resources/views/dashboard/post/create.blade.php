@extends('layouts.app')

@section('title')
    @if(isset($post))
        edite post
    @else
        add post
    @endif
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="@if(isset($post)) {{route('post.update',$post->id) }} @else {{ route('post.store') }} @endif" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(isset($post))
                                @method('PUT')
                            @endif

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">title</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text"
                                           value="@if(isset($post)) {{old('title',$post->title)}} @else {{old('title')}} @endif"
                                           id="title" name="title" required>
                                    @error('title')
                                    <span class="invalid-feedback" post="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">content</label>
                                    <input class="form-control @error('content') is-invalid @enderror" type="text"
                                           value="@if(isset($post)) {{old('content',$post->content)}} @else {{old('content')}} @endif"
                                           id="content" name="content" required>
                                    @error('content')
                                    <span class="invalid-feedback" post="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">categories</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
                                        @foreach($categories as $item)
                                            <option @if(isset( $post )) @if($post->category_id == $item->id) selected @endif @endif value="{{$item->id}}">
                                                {{$item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" post="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @if(isset($post))
                                    <div class="form-group row pt-6">
                                        <label for="room" class="col-sm-2 col-form-label">old image</label>
                                        <img style="height: 60px; width:100px" src="/images/posts/{{$post->image}}" alt="">
                                    </div>
                                @endif
                                <div class="form-group row pt-6 ">
                                    <label class=" col-sm-2  col-form-label "  for="">Choose image...</label>
                                    <input type="file" class="col-sm-10" name="image" id="" >
                                    @error('image')
                                    <span style="color: red; ">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: white">
                                <input class="btn btn-primary ml-3" type="submit" @if(isset($post)) value="{{ __("Edit") }}" @else value="{{ __('Add') }}" @endif>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
