@extends('layouts.backend') 

@section('content')

<div class="container" style=" margin-bottom: 30px">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Profile User
        </li>
    </ol>

    
    <div class="card">

        <div class="card-header text-center">Edit Profile</div>

        <div class="card-body">

            <form method="post" role="form" action="{{ route('ProfileUpdate' , ['id' => $user->id]) }}" enctype="multipart/form-data" id="myForm">
                
                {{ csrf_field() }}
                {{-- name --}}
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nama User') }}</label>
                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus> 
                        @if ($errors->has('name'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span> 
                        @endif
                    </div>
                </div>

                {{-- email --}}
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Login Email') }}</label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required autofocus> 
                        @if ($errors->has('email'))
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span> 
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-left">{{ __('No. Telepon') }}</label>

                {{-- phone --}}
                <div class="col-md-8">
                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $user->phone }}">

                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-left">{{ __('Login Password') }}</label>

                    <div class="col-md-8">
                        <input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group-row">
                    <br style="margin-bottom: 10px">
                    <div class="form-group d-flex justify-content-end" style="margin-bottom: 50px">
                        <div>
                            <a class="btn btn-outline-secondary rounded" href="{{ route('home') }}">{{ __('Kembali') }}</a>
                            <span>&nbsp;&nbsp;</span>
                            <button type="submit" class="btn btn-primary rounded" style="padding-right: 30px; padding-left: 30px">
                                {{ __('Simpan' ) }}
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
</div>
@endsection
@section('add_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    // jQuery(function($){
    $(document).ready(function($){
    $("#phone").mask("0000 0000 0000 0000 0000", {reverse: true});
    $("#myForm").submit(function() {
        $("#phone").unmask();
        });
    });
</script>
@endsection