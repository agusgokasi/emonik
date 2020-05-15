@extends('layouts.backend') 

@section('content')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('users') }}">User</a>
    </li>
    <li class="breadcrumb-item active">
        Edit User
    </li>
</ol>


<div class="card">

    <div class="card-header text-center">Edit User</div>

    <div class="card-body">

        <form method="post" role="form" action="{{ route('usersUpdate' , ['id' => $user->id]) }}" enctype="multipart/form-data" id="myForm">
            
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

        {{-- permission --}}
        <div class="form-group row">
            <label for="role" class="col-md-4 col-form-label text-md-left">{{ __('Permission') }}</label>

            <div class="col-md-8">
                <select name="permission" id="permission" required class="form-control">
                    @foreach($permissions as $permission)
                    <option value="{{$permission->id}}" {!! ($user->permission_id==$permission->id) ? "selected='selected'":"" !!}>{{$permission->nama}}</option>
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
                <select name="unit" id="unit" class="form-control">
                    <option value="" {!! (!$user->unit_id) ? "selected='selected'":"" !!}>Tidak Punya Unit</option>
                    @foreach($units as $unit)
                    <option value="{{$unit->id}}" {!! ($user->unit_id==$unit->id) ? "selected='selected'":"" !!}>{{$unit->nama}}</option>
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

        {{-- status --}}
            <div class="form-group row">
                <label for="status" class="col-md-4 col-form-label text-md-left">{{ __('Status') }}</label>

                <div class="col-md-8">
                    <div class="form-check form-check-inline">
                        <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class=" form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="1" {{ $user->status == '1' ? 'checked' : '' }} required>
                        <label> Aktif</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input id="status" style="border: 0px;width: 15px;margin-bottom: 0px;margin-right: 5px;height: 15px;" type="radio" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="0" {{ $user->status == '0' ? 'checked' : '' }} required>
                        <label> Tidak Aktif</label>
                    </div>

                    @if ($errors->has('status'))
                        <div role="alert">
                            <small>
                                <strong class="text-danger">{{ $errors->first('status') }}</strong>
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group-row">
                <br style="margin-bottom: 10px">
                <div class="form-group d-flex justify-content-end" style="margin-bottom: 50px">
                    <div>
                        <button type="submit" class="btn btn-primary rounded" style="padding-right: 30px; padding-left: 30px">
                            {{ __('Simpan' ) }}
                        </button>
                        <span>&nbsp;&nbsp;</span>
                        <a class="btn btn-light border border-dark rounded" href="{{ route('users') }}">{{ __('Kembali') }}</a>
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