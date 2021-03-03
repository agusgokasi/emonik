@extends('layouts.backend') 

@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}"><i class="fas fa-fw fa-home"></i> Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users') }}">User</a>
    </li>
    <li class="breadcrumb-item active">
        Buat User
    </li>
</ol>


<div class="card">

    <div class="card-header text-center">Buat User</div>

    <div class="card-body">

        <form method="post" role="form" action="{{ route('usersStore') }}" enctype="multipart/form-data" id="myForm">
            
            {{ csrf_field() }}
            {{-- name --}}
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-left">{{ __('Nama User') }}</label>
                <div class="col-md-8">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus> 
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
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus> 
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
                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}">

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
                    <input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

        {{-- permission --}}
        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Permission') }}</label>

            <div class="col-md-8">
                <select name="permission" class="form-control{{ $errors->has('permission') ? ' is-invalid' : '' }}" id="permission" value="{{ old('permission') }}" required>
                    <option hidden disabled selected value>--Pilih Permission--</option>
                    @foreach($permissions as $permission)
                    <option value="{{$permission->id}}" {!! old('permission')==$permission->id ? "selected='selected'":"" !!} data-id="{{$permission->id}}">{{$permission->nama}}</option>
                    @endforeach
                </select>
                @if ($errors->has('permission'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('permission') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="unit" class="col-md-4 col-form-label text-md-left">{{ __('Unit') }}</label>

            <div class="col-md-8">
                <select name="unit" class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}" id="unit" value="{{ old('unit') }}">
                    <option hidden disabled selected value>--Pilih Unit--</option>
                    <option value="" {!! old('unit')=="" ? "selected='selected'":"" !!}>Tidak Punya Unit</option>
                    @foreach($units as $unit)
                    <option value="{{$unit->id}}" {!! old('unit')==$unit->id ? "selected='selected'":"" !!}>{{$unit->nama}}</option>
                    @endforeach
                </select>
                @if ($errors->has('unit'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('unit') }}</strong>
                    </span>
                @else
                <small>
                    <span class="text-danger" role="alert">
                        <strong>*unit untuk pemohon</strong>
                    </span>
                </small>
                @endif
            </div>
        </div>

            <div class="form-group-row">
                <br style="margin-bottom: 10px">
                <div class="form-group d-flex justify-content-end" style="margin-bottom: 50px">
                    <div>
                        <a class="btn btn-outline-secondary rounded" href="{{ route('users') }}">{{ __('Kembali') }}</a>
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
@endsection
@section('add_js')
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