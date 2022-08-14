@extends('layouts.app')
@section('title')
    contacts
@endsection
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action=" {{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">facebook</label>
                                    <input class="form-control @error('fb_link') is-invalid @enderror" type="text"
                                           value="{{old('fb_link',$setting->fb_link)}} "
                                           id="name" name="fb_link" required>
                                    @error('fb_link')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">twitter</label>
                                    <input class="form-control @error('tw_link') is-invalid @enderror" type="text"
                                           value="{{old('tw_link',$setting->tw_link)}} "
                                           id="name" name="tw_link" required>
                                    @error('tw_link')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> <div class="form-group">
                                    <label for="name">instagram </label>
                                    <input class="form-control @error('insta_link') is-invalid @enderror" type="text"
                                           value="{{old('insta_link',$setting->insta_link)}} "
                                           id="name" name="insta_link" required>
                                    @error('insta_link')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">youtube</label>
                                    <input class="form-control @error('youtube_link') is-invalid @enderror" type="text"
                                           value="{{old('youtube_link',$setting->youtube_link)}} "
                                           id="name" name="youtube_link" required>
                                    @error('youtube_link')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">whats app</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                           value="{{old('phone',$setting->phone)}} "
                                           id="name" name="phone" required>
                                    @error('phone')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">phone</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                           value="{{old('phone',$setting->phone)}} "
                                           id="name" name="phone" required>
                                    @error('phone')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text"
                                           value="{{old('email',$setting->email)}} "
                                           id="name" name="email" required>
                                    @error('email')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> <div class="form-group">
                                    <label for="name">about app</label>
                                    <input class="form-control @error('about_app') is-invalid @enderror" type="text"
                                           value="{{old('about_app',$setting->about_app)}} "
                                           id="name" name="about_app" required>
                                    @error('about_app')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> <div class="form-group">
                                    <label for="name">notification text</label>
                                    <input class="form-control @error('notification_settings_text') is-invalid @enderror" type="text"
                                           value="{{old('notification_settings_text',$setting->notification_settings_text)}} "
                                           id="name" name="notification_settings_text" required>
                                    @error('notification_settings_text')
                                    <span class="invalid-feedback" contact="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer" style="background-color: white">
                                <input class="btn btn-primary ml-3" type="submit" value="edite">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
